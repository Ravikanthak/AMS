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
                        "name" => 'Establishment Subject Clerk',
                    ),
                    1 => array (
                        "id" => 4,
                        "name" => 'Establishment Adjutant',
                    ),
                    2 => array (
                        "id" => 5,
                        "name" => 'Establishment 2 In Command',
                    ),
                    3 => array (
                        "id" => 6,
                        "name" => 'Establishment Head (Commanding Officer)',
                    ),
                    4 => array (
                        "id" => 31,
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
                        "id" => 7,
                        "name" => 'Bde Admin',
                    )
                ];
            }
            else
            {
                $array =[
                    0 => array (
                        "id" => 8,
                        "name" => 'Bde Subject Clerk',
                    ),
                    1 => array (
                        "id" => 9,
                        "name" => 'Bde Major',
                    ),
                    2 => array (
                        "id" => 10,
                        "name" => 'Bde SSO',
                    ),
                    3 => array (
                        "id" => 11,
                        "name" => 'Bde Commander',
                    ),
                    4=> array (
                        "id" => 31,
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
                        "id" => 12,
                        "name" => 'Div Admin',
                    ),
                ];
            }
            else
            {
                $array =[
                    0 => array (
                        "id" => 13,
                        "name" => 'Div Subject Clerk',
                    ),
                    1 => array (
                        "id" => 14,
                        "name" => 'Div GSO 2 - OPS',
                    ),
                    2 => array (
                        "id" => 15,
                        "name" => 'Div GSO 1 - OPS',
                    ),
                    3 => array (
                        "id" => 16,
                        "name" => 'Div Col GS',
                    ),
                    4 => array (
                        "id" => 17,
                        "name" => 'Div Commander',
                    ),
                    5 => array (
                        "id" => 31,
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
                        "id" => 18,
                        "name" => 'SFHQ Admin',
                    )
                ];
            }
            else
            {
                $array =[
                    0 => array (
                        "id" => 19,
                        "name" => 'SFHQ Subject Clerk',
                    ),
                    1 => array (
                        "id" => 20,
                        "name" => 'SFHQ GSO 2 - OPS',
                    ),
                    2 => array (
                        "id" => 21,
                        "name" => 'SFHQ GSO 1 - OPS',
                    ),
                    3 => array (
                        "id" => 22,
                        "name" => 'SFHQ Col GS',
                    ),
                    4 => array (
                        "id" => 23,
                        "name" => 'SGHQ BGS',
                    ),
                    5 => array (
                        "id" => 24,
                        "name" => 'SFHQ Commander',
                    ),
                    6 => array (
                        "id" => 31,
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
                        "id" => 25,
                        "name" => 'D-Ops Admin',
                    )
                ];
            }
            else
            {
                $array =[
                    0 => array (
                        "id" => 26,
                        "name" => 'D-Ops Subject Clerk',
                    ),
                    1 => array (
                        "id" => 27,
                        "name" => 'D-Ops G 2 - OPS',
                    ),
                    2 => array (
                        "id" => 28,
                        "name" => 'D-Ops G 1 - OPS',
                    ),
                    3 => array (
                        "id" => 29,
                        "name" => 'D-Ops Col GS',
                    ),
                    4 => array (
                        "id" => 30,
                        "name" => 'D-Ops DOPS',
                    ),
                    5 => array (
                        "id" => 31,
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
                        "id" => 31,
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

            if (Auth::user()->user_type == 1)
            {
                $OrgType = OrganizationArmory::where('id',$orgId)
                    ->get('organization_type');

                if($OrgType[0]->organization_type =='estb')
                {
                    $user_type = 2;
                }
                if ($OrgType[0]->organization_type =='bde')
                {
                    $user_type = 7;
                }
                if ($OrgType[0]->organization_type =='div')
                {
                    $user_type = 12;
                }
                if ($OrgType[0]->organization_type =='sfhq')
                {
                    $user_type = 18;
                }
                if ($OrgType[0]->organization_type =='dops')
                {
                    $user_type = 25;
                }

            }
            else
            {
                $user_type = $request->user_type;
            }

            $password = Hash::make($request['e_number']);

            $input['name'] = $request->full_name;
            $input['user_type'] = $user_type;
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
    public function edit($id)
    {


        $editUser = User::join('organization_users','organization_users.user_id','=','users.id')
            ->join('organization_armories','organization_armories.id','=','organization_users.organization_id')
            ->join('user_types','user_types.id','=','users.user_type')
            ->where('users.id',$id)
            ->get(['organization_users.full_name','organization_users.gender','organization_users.is_active_service','organization_users.e_number',
                'organization_users.service_no','organization_users.rank','organization_users.regiment','organization_users.unit','organization_users.nic',
                'organization_users.is_active_account','organization_armories.id as orgId','organization_armories.organization',
                'user_types.id as userTypeId','user_types.name as userType']);

//        dd($editUser[0]->full_name);
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


        return view('create_user',compact('organizations','roles','admins','orgId','editUser','id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
