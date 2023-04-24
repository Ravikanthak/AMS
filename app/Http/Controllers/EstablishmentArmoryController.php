<?php

namespace App\Http\Controllers;

use App\Models\EstablishmentArmory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
class EstablishmentArmoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('establishment_armory.index');
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
        EstablishmentArmory::create([
            'establishment'=> $request->establishment,
            'armory'=> $request->armory,
            'created_by'=> Auth::user()->id,
        ]);

        return redirect()->route('estb_armoury.index')->with('success','Record saved successfully');
    }

    public function getEstablishmentArmoryDt(Request $request)
    {
        $data =  EstablishmentArmory::get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {

                $btnEdit = '<a class="btn btn-sm btn-warning" href="'.route('estb_armoury.edit',$row->id).'">Edit</a>';
                $btnDelete ='<form method="POST" action="'.route('estb_armoury.destroy',$row->id).'" onsubmit="return confirm(\'Delete the Record?\');" class="d-inline" >
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
    public function show(EstablishmentArmory $establishmentArmory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EstablishmentArmory $establishmentArmory, $id)
    {
        $selectedMapData = EstablishmentArmory::where('id',$id)
            ->get();

        return view('establishment_armory.index', compact('selectedMapData'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        EstablishmentArmory::where('id',$id)
            ->update([
                'establishment'=> $request->establishment,
                'armory'=> $request->armory,
                'updated_by'=> Auth::user()->id,
            ]);

        return redirect()->route('estb_armoury.index')->with('success','Record updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EstablishmentArmory $establishmentArmory, $id)
    {
        EstablishmentArmory::find($id)->delete();
        return redirect()->route('estb_armoury.index')->with('success','Record deleted successfully');
    }
}
