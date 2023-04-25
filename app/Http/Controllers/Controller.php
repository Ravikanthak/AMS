<?php

namespace App\Http\Controllers;

use App\Models\EstablishmentArmory;
use App\Models\LogsModel;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Spatie\Permission\Models\Role;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function test(){
        return view('test');
    }

    public function login(){
        return view('login');
    }

    public function register(){
        return view('register');
    }

    public function dashboard(){
        if (Auth::check()) {

            if (auth()->user()->user_type == '1') { // 1 = Admin
                auth()->user()->assignRole('admin');
            }
            if (auth()->user()->user_type == '2') { // 2 = User
                auth()->user()->assignRole('user');
            }
            $username = auth()->user()->username;
            return view('dashboard' , compact('username'));
        }
        return view('login');
    }

    


    public function logout(){

        // Save Logs
        $LogsLogins = new LogsModel;
        $LogsLogins->user = auth()->user()->username;
        $LogsLogins->status = 'logout success';
        $LogsLogins->save();

        Session::flush();
        Auth::logout();
        return redirect('login');
    }

    public function auth_req_lttr(){
        return view('auth_req_lttr');
    }

    public function create_user(){

        $establishments = EstablishmentArmory::all();
        // $user_type = DB::table('user_type')
        // ->select('*')
        // ->where('user_type','!=','1')
        // ->get();
        return view("create_user" ,compact('establishments'));
    } 

    

    public function login_func(Request $req){

        $timeNow = Carbon::now();

        $validator = Validator::make($req->all(), [
            'username' => 'required',
            'password' => 'required',
        ],
        [
            'username' => 'username is Needed',
            'password' => 'Password is Needed',
        ]);
        
        if ($validator->fails()) { // Validation Fail
            return response()->json(['status' => 1 , 'error' => $validator->errors()->toArray()]);
        }

        elseif ($validator->passes()) { // Validation Pass
            
            $credentials = $req->only('username','password'); 
            // $credentials['status'] = 1;
            // $credentials = $req->only('username');

            if (Auth::attempt($credentials)) { // Credentials correct // Login Success

                User::where('username', $req->username)->update(['last_login' => $timeNow]); 
        
                Cookie::queue('username', $req->username , 60*24); // Set Cookie // 24 hours

                // Save Logs // Success
                $LogsLogins = new LogsModel;
                $LogsLogins->user = $req->username;
                $LogsLogins->status = 'login success';
                $LogsLogins->save();

                return response()->json(['status' => 0 , 'msg' => 'Login Success' ]);

            }
            else{ // Credentials incorrect // Login Fail

                // Save Logs // Fail
                $LogsLogins = new LogsModel;
                $LogsLogins->user = $req->username;
                $LogsLogins->status = 'login fail';
                $LogsLogins->save();

                return response()->json(['status' => 2 , 'msg' => 'Login Fail' ]);
            }
        }

        else{
            echo 'System Error';
        }

    }



    public function register_func(Request $req){

        $validator = Validator::make($req->all(), [
            'fname' => 'required|min:2|max:20',
            'email' => 'required|email|unique:users,email',
        ],
        [
            'fname' => 'First Name is Needed',
            'email' => 'Email Address is Incorrect or You have already Registered with this Email Address',
        ]);
        
        if ($validator->fails()) { 
            return response()->json(['status' => 1 , 'error' => $validator->errors()->toArray()]);
        }
        elseif ($validator->passes()) {

            $user = new User();
            $user->name = $req->fname;
            $user->email = $req->email;
            $user->status = "1";
            $user->password = Hash::make("123");
            $user->save();

            return response()->json(['status' => 0 , 'msg' => 'Registration Success' ]);
        }
        else{
            echo 'System Error';
        }

        // $timeNow = Carbon::now();
        // $date1 = Carbon::parse($timeNow)->format("Y/m/d H:i");
        // echo $date1;
    }



    public function add_establishment_func(Request $req){
        dd('es');
    }
    


    public function create_admin_user_func(Request $req){
        $validator = Validator::make($req->all(), [
            'location_name' => 'required|min:2|max:50',
            'account_type' => 'required|min:2|max:50',
            'username' => 'required|min:2|max:20',
            'password' => 'required|min:2|max:20',
        ],
        [
            'location_name' => 'Location is Needed',
        ]);

        if ($validator->fails()) { 
            return response()->json(['status' => 1 , 'error' => $validator->errors()->toArray()]);
        }
        elseif ($validator->passes()) {
            
            $auth_req_lttr = new User();
            $auth_req_lttr->name = $req->location_name;
            $auth_req_lttr->user_type = $req->account_type;
            $auth_req_lttr->username = $req->username;
            $auth_req_lttr->password = $req->password;
            $auth_req_lttr->added_by = auth()->user()->username;
            $auth_req_lttr->save();

            return response()->json(['status' => 0 , 'msg' => 'Registration Success' ]);
        }
        else{
            echo 'System Error';
        }
    }





    //// DATA TABLE ////

    public function add_org(){
        $suppplier_data = User::all();
        return view('add_org' , ['supplier' => $suppplier_data ]);
    }
    
    public function delete_sup_func($id){
        $DeleteData = User::find($id)->delete();
        session()->flash('success' , 'Data has been deleted success');
        return redirect('/datatable');
    }

    public function datatable_edit_func(Request $req){

        $UpdateData = DB::table('suppliers')->where('id' , $req->id)->update([
            'name' => $req->name,
            'code' => $req->code,
            'mobile' => $req->mobile,
            'address' => $req->address,
            'category' => $req->category,
        ]);
        session()->flash('success' , 'Data has been updated success');
        return redirect('/datatable');

    }

    public function datatable_edit($id){
        $suppplier_data = User::find($id);
        return view('datatable_edit' , ['supplier' => $suppplier_data ]);
    }

    //// DATA TABLE ////





}

