<?php

namespace App\Http\Controllers;

use App\Models\AuthReqTroopsModel;
use App\Models\AuthReqWeaponModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class AuthReqController extends Controller
{




    public function auth_req_lttr_troops($id = null){
        
        $organizations = DB::table('organization_armories')
        ->select( 'id','organization')
        ->get();

        $organization_users = DB::table('organization_users')
        ->select( 'full_name','service_no','rank')
        ->where('is_active_service', 'Yes')
        ->get();

        $vehicle_types = DB::table('vehicle_types')
        ->select( 'id','vehicle')
        ->get();

        $organization_types = DB::table('user_types')
        ->select( 'id','name')
        ->whereNotIn('user_type_sub_cat', ['1_1','2_1','3_1','4_1','5_1','6_1'])
        ->get();

        $auth_req_lttr_troops = DB::table('auth_req_lttr_troops')
        ->select( '*')
        ->where('id',$id)
        ->get();

        $id = null;
        $request_made_by_id = null;
        $reason = null;
        $no_of_troops = null;
        $transport_date = null;
        $location_from = null;
        $location_to = null;
        $auth_given_by = null;
        $route = null;
        $vehicle_type_name = null;
        $no_of_seat = null;
        $convoy_comd = null;
        $escort = null;
        $escort_weapon_no = null;
        $no_of_magazins = null;
        $no_of_ammo = null;
        $driver = null;
        $measures = null;
        $ref_of_ltr = null;
        $attachment = null;

        foreach($auth_req_lttr_troops as $dt){

            $id = $dt->id;
            $request_made_by_id = $dt->request_made_by;
            $reason = $dt->reason;
            $no_of_troops = $dt->no_of_troops;
            $transport_date = $dt->transport_date;
            $location_from = $dt->location_from;
            $location_to = $dt->location_to;
            $auth_given_by = $dt->auth_given_by;
            $route = $dt->route;
            $vehicle_type_name = $dt->type_of_veh;
            $no_of_seat = $dt->no_of_seat;
            $convoy_comd = $dt->convoy_comd;
            $escort = $dt->escort;
            $escort_weapon_no = $dt->escort_weapon_no;
            $no_of_magazins = $dt->no_of_magazins;
            $no_of_ammo = $dt->no_of_ammo;
            $driver = $dt->driver;
            $measures = $dt->measures;
            $ref_of_ltr = $dt->ref_of_ltr;
            $attachment = $dt->attachment;
        }

        return view('auth_req_lttr_troops' , compact('organizations','organization_users','vehicle_types', 'organization_types' , 'id','request_made_by_id','reason','no_of_troops' ,'transport_date','location_from','location_to','auth_given_by','route','vehicle_type_name','no_of_seat','convoy_comd','escort','escort_weapon_no','no_of_magazins','no_of_ammo','driver','measures','ref_of_ltr','attachment'));
    }
    public function auth_req_lttr_troops_view(){
        $auth_req_lttr_troops = DB::table('auth_req_lttr_troops')
        ->select( 'auth_req_lttr_troops.id', 'auth_req_lttr_troops.created_at', 'auth_req_lttr_troops.ref_of_ltr', 'auth_req_lttr_troops.no_of_troops', 'auth_req_lttr_troops.transport_date', 'organization_armories.organization', 'auth_req_lttr_troops.auth_given_by')
        ->join('organization_armories','auth_req_lttr_troops.request_made_by','=','organization_armories.id')
        ->get();
        return view('auth_req_lttr_troops_view' , ['supplier' => $auth_req_lttr_troops ]);
    }



    public function auth_req_lttr_weapon(){
        $organizations = DB::table('organization_armories')
        ->select( 'id','organization')
        ->get();
        return view('auth_req_lttr_weapon' , compact('organizations'));
    }
    public function auth_req_lttr_weapon_view(){
        $organizations = DB::table('organization_armories')
        ->select( 'id','organization')
        ->get();
        return view('auth_req_lttr_weapon_view' , compact('organizations'));
    }
    



    public function upload (Request $request)
    {  
        dd($request->all());
        $image_name = $request->file('profile_pic');
        dd($image_name);
        $image_rename = time().'.'.$image_name->extension();
        $image_name->move(public_path('uploads'), $image_rename);
    
    
        $data = $request->all();
        $data['profile_pic'] = $image_rename;
        // Nco::create($data);
        // return redirect()->route(index')->with('message', 'Success');
    }    


    



    public function auth_req_lttr_troops_form_func(Request $req){

        $validator = Validator::make($req->all(), [
            'req_made_location' => 'required|min:1|max:50',
            'reason' => 'required|min:2|max:100',
            'no_of_troops' => 'required|numeric|digits_between:1,4',
            'transport_date' => 'required|min:2|max:20',
            'location_from' => 'required|min:1|max:50',
            'location_to' => 'required|min:1|max:50',
            'auth_given_by' => 'required|min:2|max:50',
            'route' => 'required|min:2|max:300',
            'type_of_veh' => 'required|min:2|max:20',
            'no_of_seat' => 'required|numeric|digits_between:1,4',
            'convoy' => 'required|min:2|max:50',
            'escort' => 'required|min:2|max:50',
            'escort_weapon_no' => 'required|min:2|max:30',
            'no_of_magazins' => 'required|numeric|digits_between:1,4',
            'no_of_ammo' => 'required|numeric|digits_between:1,4',
            'driver' => 'required|min:1|max:50',
            'measures_taken' => 'max:100',
            'ref_of_ltr' => 'max:100',
            'image' => 'mimes:jpeg,jpg,png,pdf|max:2048'
        ],
        [
            'req_made_location' => 'Select request made by (location)',
            'reason' => 'Enter Reason for transportation',
            'no_of_troops' => 'Enter No of troops to be transported',
            'transport_date' => 'Select Date of transportation',
            'location_from' => 'Select Location to be transported : (From)',
            'location_to' => 'Select Location to be transported : (To)',
            'auth_given_by' => 'Enter Auth given by (ref of the ltr/msg)',
            'route' => 'Enter Route',
            'type_of_veh' => 'Select Type of vehicle',
            'no_of_seat' => 'Enter No of seat available (Numbers Only)',
            'convoy' => 'Select Vehicle/Convoy comd name',
            'escort' => 'Select Escort name',
            'escort_weapon_no' => 'Enter Escort weapon no',
            'no_of_magazins' => 'Enter No of magazins (Numbers Only)',
            'no_of_ammo' => 'Enter No of Ammo (Numbers Only)',
            'driver' => 'Enter Driver name',
            'measures_taken' => 'Error in Measures taken Input',
            'ref_of_ltr' => 'Error in Ref of ltr/msg Input',
            'image' => 'Document Type must be PDF, JPEG, JPG, PNG and Maximum file size is 2MB',
            'image.uploaded' => 'The :attribute failed to upload',
        ]);

        if ($validator->fails()) { 
            return response()->json(['status' => 1 , 'errors' => $validator->errors()]);
        }

        elseif ($validator->passes()) {

            $imageName = null;
            if ($req->hasFile('image')) { 
                $image = $req->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads'), $imageName);
            }
        
            $UpdateOrInsertData = AuthReqTroopsModel::updateOrInsert(
                [ 'id' => $req->parameter_id ] ,
                [ 'request_made_by' => $req->req_made_location,
                    'reason' => $req->reason,
                    'no_of_troops' => $req->no_of_troops,
                    'transport_date' => $req->transport_date,
                    'location_from' => $req->location_from,
                    'location_to' => $req->location_to,
                    'auth_given_by' => $req->auth_given_by,
                    'route' => $req->route,
                    'type_of_veh' => $req->type_of_veh,
                    'no_of_seat' => $req->no_of_seat,
                    'convoy_comd' => $req->convoy,
                    'escort' => $req->escort,
                    'escort_weapon_no' => $req->escort_weapon_no,
                    'no_of_magazins' => $req->no_of_magazins,
                    'no_of_ammo' => $req->no_of_ammo,
                    'driver' => $req->driver,
                    'measures' => $req->measures_taken,
                    'ref_of_ltr' => $req->ref_of_ltr,
                    'attachment' => $imageName,
                    'added_by' => auth()->user()->username,
                    'ip' => $_SERVER['REMOTE_ADDR'],
                    'created_at' => Carbon::now(),
                ]);

                return response()->json(['status' => 0 , 'msg' => 'Success' ]);

        }
        else{
            echo 'System Error';
        }
    }

 

    // Edit 
    public function auth_req_lttr_troops_view_btn(Request $req){

        $data = DB::table('auth_req_lttr_troops')
        ->select('auth_req_lttr_troops.*', 'organization_armories.*')
        ->join('organization_armories','auth_req_lttr_troops.request_made_by','=','organization_armories.id')
        ->where('auth_req_lttr_troops.id',$req->leaveID)
        ->get();

        $html = "";

        foreach($data as $dt){

            $location_from = DB::table('organization_armories')
            ->select('organization')
            ->where('id', $dt->location_from)
            ->first();

            $location_to = DB::table('organization_armories')
            ->select('organization')
            ->where('id', $dt->location_to)
            ->first();

            // if ($dt->solder_type == 1) {
            //     $html .= "<p>Name of the applicant : <span>{$dt->serviceno} {$dt->rank_abb} {$dt->Initials} {$dt->name} {$dt->LastName}</span> </p>";
            // }else{
            //     $html .= "<p>Name of the applicant : <span>{$dt->serviceno} {$dt->rank_abb} {$dt->name} {$dt->LastName} {$dt->Initials} </span> </p>";
            // }

            $html .= "<p>1. Request made by (location) : <span>{$dt->organization}</span> </p>
            <p>2. Reason for transportation : <span>{$dt->reason}</span> </p>
            <p>3. No of troops to be transported : <span>{$dt->no_of_troops}</span> </p>
            <p>4. Date of transportation : <span>{$dt->transport_date}</span> </p>
            <p>5. Location to be transported : <span>{$location_from->organization} To {$location_to->organization}</span> </p>
            <p>6. Auth given by (ref of the ltr/msg) : <span>{$dt->auth_given_by}</span> </p>
            <p>7. Route : <span>{$dt->route}</span> </p>
            <p>8. (i) Type of vehicle : <span>{$dt->type_of_veh}</span>8. (ii) No of seat available : <span>{$dt->no_of_seat}</span> </p>
            <p>9. Vehicle/Convoy comd name : <span>{$dt->convoy_comd}</span></p>
            <p>10. Escort name : <span>{$dt->escort}</span></p>
            <p>11. (i) Escort weapon no : <span>{$dt->escort_weapon_no}</span>11. (ii) No of magazins : <span>{$dt->no_of_magazins}</span>11. (iii) Ammo : <span>{$dt->no_of_ammo}</span> </p>
            <p>12. Driver name : <span>{$dt->driver}</span></p>
            <p>13. Measures taken for the sy of tps to be transported : <span>{$dt->measures}</span></p>
            <p>14. Ref of ltr/msg of 'hiring auth to the Ay' for veh which use civil no plates : <span>{$dt->ref_of_ltr}</span></p>
            ";
        }
        print_r($html);

    }



    public function auth_req_lttr_troops_loaddata_tofields(Request $req){

        $auth_req_lttr_troops = DB::table('auth_req_lttr_troops')
        ->select( '*')
        ->where('id', $req->ID)
        ->get();

    
    }










    


    public function auth_req_lttr_weapon_form_func(Request $req){

        $validator = Validator::make($req->all(), [
            'req_made_location' => 'required|min:1|max:50',
            'incharge' => 'required|min:2|max:50',
            'auth_given_by' => 'required|min:2|max:30',
            'transport_date' => 'required|min:2|max:20',
            'location_from' => 'required|min:1|max:50',
            'location_to' => 'required|min:1|max:50',
            'route' => 'required|min:2|max:100',  
            'no_of_wpn' => 'required|min:1|max:20',
            'wpn_details' => 'required|min:1',
            'type_of_veh' => 'required|min:2|max:20',
            'vehicle_no' => 'required|min:1|max:20',
            'driver' => 'required|min:1|max:50',
            'escort' => 'required|min:2|max:50',
            'escort_weapon_no' => 'required|min:2|max:30',
            'no_of_magazins' => 'required|min:1|max:20',
            'no_of_ammo' => 'required|min:1|max:20',
            'ref_of_ltr1' => 'max:100',
            'att1' => 'max:100',
            'ref_of_ltr2' => 'max:100',
            'att' => 'max:100',
            'att2' => 'max:100',
        ],
        [
            'req_made_location' => 'Select request made by (location)',
            'incharge' => 'Select In Charge Name',
            'auth_given_by' => 'Enter Auth given by (ref of the ltr/msg)',
            'transport_date' => 'Select Date of transportation',
            'location_from' => 'Select Location to be transported : (From)',
            'location_to' => 'Select Location to be transported : (To)',
            'route' => 'Enter Route',
            'no_of_wpn' => 'Enter No of Wpn to be transported',
            'wpn_details' => 'Enter Wpn details',
            'type_of_veh' => 'Select Type of vehicle',
            'vehicle_no' => 'Enter Vehicle No',
            'driver' => 'Enter Driver name',
            'escort' => 'Select Escort name',
            'escort_weapon_no' => 'Enter Escort weapon no',
            'no_of_magazins' => 'Enter No of magazins',
            'no_of_ammo' => 'Enter No of Ammo',
            'ref_of_ltr1' => 'Error in Ref of ltr/msg Input',
            'att1' => 'Error in Attachment Input',
            'ref_of_ltr2' => 'Error in Ref of ltr/msg Input',
            'att2' => 'Error in Attachment Input',
        ]);

        if ($validator->fails()) { 
            return response()->json(['status' => 1 , 'errors' => $validator->errors()]);
        }
        elseif ($validator->passes()) {
            
            $auth_req_lttr = new AuthReqWeaponModel();
            $auth_req_lttr->request_made_by = $req->req_made_location;
            $auth_req_lttr->incharge = $req->incharge;
            $auth_req_lttr->auth_given_by = $req->auth_given_by;
            $auth_req_lttr->transport_date = $req->transport_date;
            $auth_req_lttr->location_from = $req->location_from;
            $auth_req_lttr->location_to = $req->location_to;
            $auth_req_lttr->route = $req->route;
            $auth_req_lttr->no_of_wpn = $req->no_of_wpn;
            $auth_req_lttr->wpn_details = $req->wpn_details;
            $auth_req_lttr->type_of_veh = $req->type_of_veh;
            $auth_req_lttr->vehicle_no = $req->vehicle_no;
            $auth_req_lttr->driver = $req->driver;
            $auth_req_lttr->escort = $req->escort;
            $auth_req_lttr->escort_weapon_no = $req->escort_weapon_no;
            $auth_req_lttr->no_of_magazins = $req->no_of_magazins;
            $auth_req_lttr->no_of_ammo = $req->no_of_ammo;
            $auth_req_lttr->ref_of_ltr1 = $req->ref_of_ltr1;
            $auth_req_lttr->attachment1 = $req->att1;
            $auth_req_lttr->ref_of_ltr2 = $req->ref_of_ltr2;
            $auth_req_lttr->attachment2 = $req->att2;
            $auth_req_lttr->added_by = auth()->user()->username;
            $auth_req_lttr->ip = $_SERVER['REMOTE_ADDR'];
            $auth_req_lttr->save();

            return response()->json(['status' => 0 , 'msg' => 'Registration Success' ]);
        }
        else{
            echo 'System Error';
        }
    }








}
