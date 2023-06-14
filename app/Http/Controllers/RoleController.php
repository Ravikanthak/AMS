<?php

namespace App\Http\Controllers;

use App\Models\OrganizationArmory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $orgId = isset(Auth::user()->OrganizationUsers[0]['organization_id'])?Auth::user()->OrganizationUsers[0]['organization_id']:0;
        $roles = Role::where('organization_id',$orgId)
            ->orderBy('id','DESC')->paginate(5);

        return view('roles.index',compact('roles','orgId'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $orgType = OrganizationArmory::where('id', Auth::user()->OrganizationUsers[0]['organization_id'])
            ->get(['organization_type']);

        $permission = Permission::get();

        return view('roles.create',compact('permission','orgType'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'permission' => 'required',
            'name' =>[
                'required',
                Rule::unique('roles')
                    ->where('organization_id', Auth::user()->OrganizationUsers[0]['organization_id'])
            ],

        ]);

        $role = Role::create([
            'name' => $request->input('name'),
            'organization_id' => Auth::user()->OrganizationUsers[0]['organization_id']
            ]);
        $role->syncPermissions($request->input('permission'));

        return redirect()->route('roles.index')
            ->with('success','Role created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$id)
            ->get();

        return view('roles.show',compact('role','rolePermissions'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();

        $orgType = OrganizationArmory::where('id', Auth::user()->OrganizationUsers[0]['organization_id'])
            ->get(['organization_type']);

        return view('roles.edit',compact('role','permission','rolePermissions','orgType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);

        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();

        $role->syncPermissions($request->input('permission'));

        return redirect()->route('roles.index')
            ->with('success','Role updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::table("roles")->where('id',$id)->delete();
        return redirect()->route('roles.index')
            ->with('success','Role deleted successfully');
    }
}
