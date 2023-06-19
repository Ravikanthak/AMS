<?php

namespace App\Http\Controllers;

use App\Models\LogsModel;
use App\Models\OrganizationArmory;
use App\Models\OrganizationUsers;
use App\Models\Role;
use App\Models\User;
use App\Models\UserType;
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
            $admins = User::leftJoin('organization_armories','organization_armories.id','=','users.organization_id')
                ->where('users.id','!=',Auth::user()->id)
                ->get(['users.name','users.id','organization_armories.organization']);

            $orgId = null;
        }
        //For others
        if (Auth::user()->user_type !=1)
        {
            $roles = Role::where('organization_id',Auth::user()->OrganizationUsers[0]['organization_id'])
                ->pluck('name','id')->all();

            $orgId = Auth::user()->organization_id;


            $admins = User::join('organization_armories','organization_armories.id','=','users.organization_id')
                ->leftJoin('model_has_roles','model_has_roles.model_id','=','users.id')
                ->leftJoin('roles','roles.id','=','model_has_roles.role_id')
                ->where('users.organization_id', Auth::user()->OrganizationUsers[0]['organization_id'])
                ->where('users.id','!=',Auth::user()->id)
                ->orWhere('roles.organization_id', Auth::user()->OrganizationUsers[0]['organization_id'])
                ->get(['users.name','users.id','organization_armories.organization','roles.name as role']);

        }

        return view("create_user" ,compact('organizations','roles','admins','orgId'));
    }


    public function getAdminUserType(Request $request)
    {
        $data = OrganizationArmory::where('id',$request->orgId)
            ->get();

        $array =[];

        if($data[0]->organization_type == 'estb')
        {
            if (Auth::user()->user_type ==1)
            {
                $array =[
                    0 => array (
                        "id" => 2,
                        "name" => 'Establishment Admin',
                    )
                ];
            }
            else
            {
                $array =[
                    0 => array (
                        "id" => 3,
                        "name" => 'Establishment Head',
                    ),
                    1 => array (
                        "id" => 4,
                        "name" => 'Establishment Subject Clerk',
                    ),
                    2 => array (
                        "id" => 26,
                        "name" => 'Other',
                    ),
                ];
            }

        }
        elseif($data[0]->organization_type == 'bde')
        {
            if (Auth::user()->user_type ==1)
            {
                $array =[
                    0 => array (
                        "id" => 5,
                        "name" => 'Bde Admin',
                    )
                ];
            }
            else
            {
                $array =[
                    0 => array (
                        "id" => 6,
                        "name" => 'Bde Comd',
                    ),
                    1 => array (
                        "id" => 7,
                        "name" => 'BM',
                    ),
                    2 => array (
                        "id" => 26,
                        "name" => 'Other',
                    ),
                ];
            }

        }
        elseif($data[0]->organization_type == 'div')
        {
            if (Auth::user()->user_type ==1)
            {
                $array =[
                    0 => array (
                        "id" => 8,
                        "name" => 'Div Admin',
                    ),
                ];
            }
            else
            {
                $array =[
                    0 => array (
                        "id" => 9,
                        "name" => 'Div Comd',
                    ),
                    1 => array (
                        "id" => 10,
                        "name" => 'Div Col GS',
                    ),
                    2 => array (
                        "id" => 26,
                        "name" => 'Other',
                    ),
                ];
            }

        }
        elseif($data[0]->organization_type == 'sfhq')
        {
            if (Auth::user()->user_type ==1)
            {
                $array =[
                    0 => array (
                        "id" => 11,
                        "name" => 'SFHQ Admin',
                    )
                ];
            }
            else
            {
                $array =[
                    0 => array (
                        "id" => 12,
                        "name" => 'SFHQ BGS',
                    ),
                    1 => array (
                        "id" => 13,
                        "name" => 'SFHQ Col GS',
                    ),
                    2 => array (
                        "id" => 14,
                        "name" => 'SFHQ GSO I',
                    ),
                    3 => array (
                        "id" => 15,
                        "name" => 'SFHQ GSO II',
                    ),
                    4 => array (
                        "id" => 16,
                        "name" => 'SFHQ Subject Clerk',
                    ),
                    5 => array (
                        "id" => 26,
                        "name" => 'Other',
                    ),
                ];
            }


        }
        elseif($data[0]->organization_type == 'dops')
        {
            if (Auth::user()->user_type ==1)
            {
                $array =[
                    0 => array (
                        "id" => 17,
                        "name" => 'D-Ops Admin',
                    )
                ];
            }
            else
            {
                $array =[
                    0 => array (
                        "id" => 18,
                        "name" => 'D-Ops Director',
                    ),
                    1 => array (
                        "id" => 19,
                        "name" => 'D-Ops SO (Special Ops)',
                    ),
                    2 => array (
                        "id" => 20,
                        "name" => 'D-Ops SO (Coordination Ops)',
                    ),
                    3 => array (
                        "id" => 21,
                        "name" => 'D-Ops Subject Clerk (Special Ops)',
                    ),
                    4 => array (
                        "id" => 22,
                        "name" => 'D-Ops Subject Clerk (Coordination Ops)',
                    ),
                    5 => array (
                        "id" => 26,
                        "name" => 'Other',
                    ),
                ];
            }


        }
        elseif($data[0]->organization_type == 'dte')
        {
            if (Auth::user()->user_type ==1)
            {
                $array =[
                    0 => array (
                        "id" => 23,
                        "name" => 'Dte Admin',
                    )
                ];
            }
            else
            {
                $array =[
                    0 => array (
                        "id" => 24,
                        "name" => 'Dte Head',
                    ),
                    1 => array (
                        "id" => 25,
                        "name" => 'Dte Subject Clerk',
                    ),
                    2 => array (
                        "id" => 26,
                        "name" => 'Other',
                    ),
                ];
            }


        }
        else
        {
            $array =[];
        }

        return $array;

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

        $orgId = isset($request->organization)?$request->organization:Auth::user()->organization_id;

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
            $input['user_type'] = $request->user_type;
            $input['username'] = $request->e_number;
            $input['status'] = 1;
            $input['password'] = $password;
            $input['email'] = $request->e_number;
            $input['organization_id'] = $orgId;

//            dd($request->input('roles'));
            $newUser = User::create($input);
            $newUser->assignRole([$request->input('roles')]);

            OrganizationUsers::create([
                'user_id' => $newUser['id'],
                'organization_id' => $orgId,
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
