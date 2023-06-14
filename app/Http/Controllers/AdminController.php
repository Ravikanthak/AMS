<?php

namespace App\Http\Controllers;

use App\Models\LogsModel;
use App\Models\OrganizationArmory;
use App\Models\OrganizationUsers;
use App\Models\Role;
use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    public function create_user(){

        $organizations = OrganizationArmory::all();



        //For Super User
        if (Auth::user()->user_type ==1)
        {
            $roles = '';
            $admins = User::join('organization_armories','organization_armories.id','=','users.organization_id')
                ->get(['users.name','users.id','organization_armories.organization']);
        }
        //For Orgs Admins
        if (Auth::user()->user_type ==2)
        {
            $roles = Role::where('organization_id',Auth::user()->OrganizationUsers[0]['organization_id'])
                ->pluck('name','id')->all();

//            $admins = User::join('organization_armories','organization_armories.id','=','users.organization_id')
//                ->where('users.organization_id', Auth::user()->OrganizationUsers[0]['organization_id'])
//                ->get(['users.name','users.id','organization_armories.organization']);

            $admins = User::join('organization_armories','organization_armories.id','=','users.organization_id')

                ->leftJoin('model_has_roles','model_has_roles.model_id','=','users.id')

                ->leftJoin('roles','roles.id','=','model_has_roles.role_id')

                ->where('roles.organization_id', Auth::user()->OrganizationUsers[0]['organization_id'])
                ->where('users.organization_id', Auth::user()->OrganizationUsers[0]['organization_id'])
                ->get(['users.name','users.id','organization_armories.organization','roles.name as role']);
        }


        return view("create_user" ,compact('organizations','roles','admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $userType =0;


        if (Auth::user()->user_type == 1)
        {
            $userType = 2;
        }
        if (Auth::user()->user_type == 2)
        {
            $request->organization = Auth::user()->organization_id;
            $userType = 3;
        }
        if (Auth::user()->user_type == 3)
        {
            $userType = 3;
        }



        DB::beginTransaction();
        try{


            $userExist = User::where('email',$request['e_number'])
                ->get('id');

            if (isset($userExist[0]->id))
            {
                return to_route('create_user')->with('error',' User already added');
            }

            $password = Hash::make($request['e_number']);

            $input['name'] = $request->full_name;
            $input['user_type'] = $userType;
            $input['username'] = $request->e_number;
            $input['status'] = 1;
            $input['password'] = $password;
            $input['email'] = $request->e_number;
            $input['organization_id'] = $request->organization;

//            dd($request->input('roles'));
            $newUser = User::create($input);
            $newUser->assignRole([$request->input('roles')]);

            OrganizationUsers::create([
                'user_id' => $newUser['id'],
                'organization_id' => $request->organization,
                'full_name' => $request->full_name,
                'gender' => $request->gender,
                'is_active_service' => $request->active_service,
                'e_number' => $request->e_number,
                'service_no' => $request->service_number,
                'rank' => $request->rank,
                'regiment' => $request->regiment,
                'unit' => $request->unit,
                'nic' => $request->nic,
                'is_active_account' => $request->active,
                'created_by' => Auth::user()->id,
            ]);

            DB::commit();
            return to_route('create_user')->with('success','Organization admin created');
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            dd($e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
