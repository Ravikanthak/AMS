<?php

namespace App\Http\Controllers;

use App\Models\EstablishmentArmory;
use App\Models\OrganizationArmory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
class OrganizationArmoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('organization_armory.index');
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
//        dd($request);
        OrganizationArmory::create([
            'organization'=> $request->organization,
            'organization_type'=> $request->organization_type,
            'armory'=> $request->selected_armoury,
            'armory_api_id'=> $request->armoury,
            'created_by'=> Auth::user()->id,
        ]);

        return redirect()->route('org_armoury.index')->with('success','Record saved successfully');
    }

    public function getEstabligetOrganizationArmoryDt(Request $request)
    {
        $data =  OrganizationArmory::get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {

                $btnEdit = '<a class="btn btn-sm btn-warning" href="'.route('org_armoury.edit',$row->id).'">Edit</a>';
                $btnDelete ='<form method="POST" action="'.route('org_armoury.destroy',$row->id).'" onsubmit="return confirm(\'Delete the Record?\');" class="d-inline" >
                             '.csrf_field().'
                             '.method_field('DELETE').'
                            <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                        </form>';
                return $btnEdit.' '.$btnDelete;
            })
            ->rawColumns(['action'])
            ->setRowId('id')
            ->make(true);
    }
    /**
     * Display the specified resource.
     */
    public function show(OrganizationArmory $organizationArmory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OrganizationArmory $organizationArmory, $id)
    {
        $selectedMapData = OrganizationArmory::where('id',$id)
            ->get();
//        dd($selectedMapData[0]->armory);
        return view('organization_armory.index', compact('selectedMapData'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        OrganizationArmory::where('id',$id)
            ->update([
                'organization'=> $request->organization,
                'organization_type'=> $request->organization_type,
                'armory'=> $request->selected_armoury,
                'armory_api_id'=> $request->armoury,
                'updated_by'=> Auth::user()->id,
            ]);

        return redirect()->route('org_armoury.index')->with('success','Record updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrganizationArmory $organizationArmory, $id)
    {
        OrganizationArmory::find($id)->delete();
        return redirect()->route('org_armoury.index')->with('success','Record deleted successfully');
    }
}
