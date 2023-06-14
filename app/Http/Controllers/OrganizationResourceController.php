<?php

namespace App\Http\Controllers;

use App\Models\OrganizationArmory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrganizationResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

            $orgId = isset(Auth::user()->OrganizationUsers[0]['organization_id'])?Auth::user()->OrganizationUsers[0]['organization_id']:0;

            $orgArmoury = OrganizationArmory::where('id', $orgId)
                ->get(['armory','organization','armory_api_id','organization_api_id']);

            return view('organization_resources.index', compact('orgArmoury'));

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
        //
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
