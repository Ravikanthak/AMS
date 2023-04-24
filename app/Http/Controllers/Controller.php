<?php

namespace App\Http\Controllers;

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
use App\Models\AuthReqLttrModel;
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
        Session::flush();
        Auth::logout();
        return redirect('login');
    }

    public function auth_req_lttr(){
        return view('auth_req_lttr');
    }

    public function create_user(){
        $user_type = DB::table('user_type')
        ->select('*')
        ->where('user_type','!=','1')
        ->get();
        return view("create_user" , compact('user_type') );
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

                return response()->json(['status' => 0 , 'msg' => 'Login Success' ]);

            }
            else{ // Credentials incorrect // Login Fail
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



    public function auth_req_lttr_form_func(Request $req){

        $validator = Validator::make($req->all(), [
            'req_made_location' => 'required|min:2|max:50',
            'reason' => 'required|min:2|max:50',
            'no_of_troops' => 'required|min:2|max:20',
            'transport_date' => 'required|min:2|max:20',
            'location_from' => 'required|min:2|max:50',
            'location_to' => 'required|min:2|max:50',
            'auth_given_by' => 'required|min:2|max:30',
            'route' => 'required|min:2|max:100',
            'type_of_veh' => 'required|min:2|max:20',
            'no_of_seat' => 'required|min:1|max:20',
            'convoy' => 'required|min:2|max:50',
            'escort' => 'required|min:2|max:50',
            'escort_weapon_no' => 'required|min:2|max:30',
            'no_of_magazins' => 'required|min:1|max:20',
            'no_of_ammo' => 'required|min:1|max:20',
            'driver' => 'required|min:1|max:50',
            'measures_taken' => 'required|min:1|max:50',
            'ref_of_ltr' => 'required|min:1|max:50',
            'att' => 'required|min:1|max:100',
        ],
        [
            'reason' => 'Reason is Needed',
        ]);

        if ($validator->fails()) { 
            return response()->json(['status' => 1 , 'error' => $validator->errors()->toArray()]);
        }
        elseif ($validator->passes()) {
            
            $auth_req_lttr = new AuthReqLttrModel();
            $auth_req_lttr->request_made_by = $req->req_made_location;
            $auth_req_lttr->reason = $req->reason;
            $auth_req_lttr->no_of_troops = $req->no_of_troops;
            $auth_req_lttr->transport_date = $req->transport_date;
            $auth_req_lttr->location_from = $req->location_from;
            $auth_req_lttr->location_to = $req->location_to;
            $auth_req_lttr->auth_given_by = $req->auth_given_by;
            $auth_req_lttr->route = $req->route;
            $auth_req_lttr->type_of_veh = $req->type_of_veh;
            $auth_req_lttr->no_of_seat = $req->no_of_seat;
            $auth_req_lttr->convoy_comd = $req->convoy;
            $auth_req_lttr->escort = $req->escort;
            $auth_req_lttr->escort_weapon_no = $req->escort_weapon_no;
            $auth_req_lttr->no_of_magazins = $req->no_of_magazins;
            $auth_req_lttr->no_of_ammo = $req->no_of_ammo;
            $auth_req_lttr->driver = $req->driver;
            $auth_req_lttr->measures = $req->measures_taken;
            $auth_req_lttr->ref_of_ltr = $req->ref_of_ltr;
            $auth_req_lttr->attachment = $req->att;
            $auth_req_lttr->added_by = auth()->user()->username;
            $auth_req_lttr->ip = $_SERVER['REMOTE_ADDR'];
            $auth_req_lttr->save();

            return response()->json(['status' => 0 , 'msg' => 'Registration Success' ]);
        }
        else{
            echo 'System Error';
        }
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





    // public function auth_req_lttr_form_func(Request $req){


        
    // }
    



}

