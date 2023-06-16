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

    // Auth Req Lttr Troops Page
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
        // ->whereNotIn('user_type_sub_cat', ['1_1','2_1','3_1','4_1','5_1','6_1'])
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
        $request_fwd_to = null;
        $added_by = null;

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
            $request_fwd_to = $dt->request_fwd_to;
            $added_by = $dt->added_by;
        }

        return view('auth_req_lttr_troops' , compact('organizations','organization_users','vehicle_types', 'organization_types' , 'id','request_made_by_id','reason','no_of_troops' ,'transport_date','location_from','location_to','auth_given_by','route','vehicle_type_name','no_of_seat','convoy_comd','escort','escort_weapon_no','no_of_magazins','no_of_ammo','driver','measures','ref_of_ltr','attachment','request_fwd_to','added_by'));
    }




    // View Page
    public function auth_req_lttr_troops_view(){

        $login_user_type_id = Auth()->user()->user_type; 
        session(['user_type_id' => $login_user_type_id]);  // Save current user_type in session

        $auth_req_lttr_troops = DB::table('auth_req_lttr_troops_fwd')
        ->select( '*')
        // ->join('organization_armories','auth_req_lttr_troops.request_made_by','=','organization_armories.id')
        ->where('req_fwd_to' , $login_user_type_id)
        ->get();

        // $auth_req_lttr_troops = DB::table('auth_req_lttr_troops')
        // ->select( 'auth_req_lttr_troops.id', 'auth_req_lttr_troops.created_at', 'auth_req_lttr_troops.ref_of_ltr', 'auth_req_lttr_troops.no_of_troops', 'auth_req_lttr_troops.transport_date', 'organization_armories.organization', 'auth_req_lttr_troops.auth_given_by')
        // ->join('organization_armories','auth_req_lttr_troops.request_made_by','=','organization_armories.id')
        // ->where('request_fwd_to' , $login_user_type_id)
        // ->get();

        $organization_types = DB::table('user_types')
        ->select( 'id','name')
        ->get();

        return view('auth_req_lttr_troops_view' , compact('auth_req_lttr_troops','organization_types'));
    }


    
    public function auth_req_lttr_troops_take_action_view(){
        $login_user_type_id = Auth()->user()->user_type; 
        session(['user_type_id' => $login_user_type_id]);  // Save current user_type in session

        $auth_req_lttr_troops = DB::table('auth_req_lttr_troops_fwd')
        ->select('*')
        ->where('req_fwd_to' , $login_user_type_id)
        ->get();

        $organization_types = DB::table('user_types')
        ->select( 'id','name')
        ->get();

        return view('auth_req_lttr_troops_take_action_view' , compact('auth_req_lttr_troops','organization_types'));
    }


    // Approve Page
    public function auth_req_lttr_troops_take_action($id = null){

        $login_user_type_id = Auth()->user()->user_type; 
        session(['user_type_id' => $login_user_type_id]);  // Save current user_type in session

        $auth_req_lttr_troops = DB::table('auth_req_lttr_troops_fwd')
        ->select('*')
        ->where('req_fwd_to' , $login_user_type_id)
        ->get();

        $organization_types = DB::table('user_types')
        ->select( 'id','name')
        ->get();

        return view('auth_req_lttr_troops_take_action' , compact('auth_req_lttr_troops','organization_types'));
    }
    
    

    // Submit Button // Save Data
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
            'image' => 'mimes:jpeg,jpg,png,pdf|max:2048',
            'request_forward_by' => 'required|min:1|max:50',
            'request_forward_to' => 'required|min:1|max:50'
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
            'request_forward_by' => 'Select Request Forward by',
            'request_forward_to' => 'Select Request Forward to',
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
                    'request_fwd_to' => $req->request_forward_to,
                    'added_by' => $req->request_forward_by,
                    'ip' => $_SERVER['REMOTE_ADDR'],
                    'created_at' => Carbon::now(),
                ]);


                if ($req->parameter_id == null ) {  // Insert operation was performed

                    // Get last inserted ID
                    $LastInsertedIDValue = AuthReqTroopsModel::select('id')
                    ->orderBy('id', 'desc')
                    ->limit(1)
                    ->value('id');

                    // Insert 1st Request Created record 
                    $InsertFwdList1 = DB::table('auth_req_lttr_troops_fwd')->insert([
                        'auth_req_lttr_troops_id' => $LastInsertedIDValue,
                        'req_fwd_by' => $req->request_forward_by,
                        'req_fwd_to' => $req->request_forward_to,
                        'req_fwd_by_status' => 'Request Created',
                        'req_fwd_to_status' => 'Pending',
                        'date' => Carbon::now(),
                    ]);
                
                    // Insert 2nd Request Pending record 
                    // $InsertFwdList2 = DB::table('auth_req_lttr_troops_fwd')->insert([
                    //     'auth_req_lttr_troops_id' => $LastInsertedIDValue,
                    //     'req_count' => 2,
                    //     'user_type' => $req->request_forward_to,
                    //     'status' => 'Pending',
                    //     'action_taken_by' => '',
                    //     'date' => Carbon::now(),
                    // ]);

                } else { // Update operation was performed
                    dd('Update operation was performed');
                }            

                return response()->json(['status' => 0 , 'msg' => 'Success' ]);

        }
        else{
            echo 'System Error';
        }
    }


 

    // Track Button //  Track data
    public function auth_req_lttr_troops_track_btn(Request $request){

        $data = DB::table('auth_req_lttr_troops_fwd')
        ->select('auth_req_lttr_troops_fwd.*', 'user_types.*')
        ->join('user_types','auth_req_lttr_troops_fwd.req_fwd_to','=','user_types.id')
        ->where('auth_req_lttr_troops_id', $request->ReqId )
        ->get();

        $html = "";

        $status_class = '';

        foreach($data as $dt){

            $req_fwd_by = DB::table('user_types')
            ->select('name')
            ->where('id', $dt->req_fwd_by )
            ->first(); 

            $req_fwd_to = DB::table('user_types')
            ->select('name')
            ->where('id', $dt->req_fwd_to )
            ->first(); 

            if ($dt->req_fwd_to_status == 'Approved' || $dt->req_fwd_to_status == 'Request Created') {
                $status_class = 'status_approved';
            }
            if ($dt->req_fwd_to_status == 'Declined') {
                $status_class = 'status_declined';
            }
            if ($dt->req_fwd_to_status == 'Pending') {
                $status_class = 'status_pending';
            }

            $html .= "<div class='box'>
            <div class='org'><p class='p1'>{$req_fwd_by->name}</p><p class='p2'>{$dt->req_fwd_by_status}</p><span>({$dt->date})</span></div>
            <div class='status {$status_class}'><p class='p1'>{$req_fwd_to->name}</p><p class='p3'>{$dt->req_fwd_to_status}</p><span>({$dt->date})</span></div>
            </div><div class='dot dot1'></div><div class='dot dot2'></div>";
            
        }
        print($html);
    }




    // View Button // View Data
    public function auth_req_lttr_troops_view_btn(Request $req){

        $data = DB::table('auth_req_lttr_troops AS atl')
        ->select( 'atl.request_made_by', 'atl.reason', 'atl.no_of_troops', 'atl.transport_date', 'atl.location_from', 'atl.location_to', 'atl.auth_given_by', 'atl.route', 'atl.type_of_veh', 'atl.no_of_seat', 'atl.convoy_comd', 'atl.escort', 'atl.escort_weapon_no', 'atl.no_of_magazins', 'atl.no_of_ammo', 'atl.driver', 'atl.measures', 'atl.ref_of_ltr', 'atl.attachment', 'atl.request_fwd_to', 'atl.added_by', 'atl.id', 'oa.organization', 'oa.organization_type', 'oa.armory' )
        ->join('organization_armories AS oa', 'atl.request_made_by', '=', 'oa.id')
        ->where('atl.id', $req->ReqId)
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

            $link = route('auth_req_lttr_troops_take_action') . '/' . $dt->id;

            $html .= "
            <div class='modal-body view_auth_req_lttr_troops_details'>
            <p>1. Request made by (location) : <span>{$dt->organization}</span> </p>
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
            </div>
            <div class='modal-footer'>
            <a target='_blank' href='{$link}' id='{$dt->id}' class='btn btn-success edit'>Take Action</a>
            <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
            </div>
            ";
        }
        print_r($html);

    }




    // Approve Button // Approve Req
    public function auth_req_lttr_troops_approve_btn(Request $request){

        $update_status = DB::table('auth_req_lttr_troops_fwd') // Update status to Approved in 1st record
        ->where('auth_req_lttr_troops_id', $request->req_id)
        ->where('req_fwd_to', Auth()->user()->user_type)
        // ->where(function ($query) {
        //     $query->where('status', 'like', '%Pending%')
        //         ->orWhere('status', 'like', '%Declined%');
        // })
        // ->orderBy('id', 'desc')
        // ->limit(1)
        ->update(['req_fwd_to_status' => 'Approved' , 'date' => Carbon::now() ]);

        $insert_pending_record = DB::table('auth_req_lttr_troops_fwd')->insert([ // Insert 2nd Request Pending record 
            'auth_req_lttr_troops_id' => $request->req_id,
            'req_fwd_by' => $request->request_forward_by,
            'req_fwd_to' => $request->request_forward_to,
            'req_fwd_by_status' => 'Forwarded',
            'req_fwd_to_status' => 'Pending',
            'date' => Carbon::now(),
        ]);

        return response()->json(['status' => 1 , 'msg' => 'Approved']);

    }
    



    // Decline Button // Decline Req
    public function auth_req_lttr_troops_decline_btn(Request $request){

        $result = DB::table('auth_req_lttr_troops_fwd')
        ->where('auth_req_lttr_troops_id', $request->req_id)
        ->where('req_fwd_to', Auth()->user()->user_type)
        // ->where(function ($query) {
        //     $query->where('status', 'like', '%Pending%')
        //         ->orWhere('status', 'like', '%Approved%');
        // })
        // ->orderBy('id', 'desc')
        // ->limit(1)
        ->update(['req_fwd_to_status' => 'Declined' , 'date' => Carbon::now() ]);

        return response()->json(['status' => 1 , 'msg' => 'Declined']);
    }

    


    // Check Status OnClick View Button
    public function auth_req_lttr_troops_check_status(Request $request){
        
        $status = DB::table('auth_req_lttr_troops_fwd')
        ->select('req_fwd_by_status' , 'req_fwd_to_status')
        ->where('auth_req_lttr_troops_id', $request->req_id)
        ->where('req_fwd_to', Auth()->user()->user_type)
        ->get();

        return response()->json(['status' => 1 , 'msg' => $status ]);
    }
    



    
    ////////////////////////////////////////////////
    //////////////////// WEAPON ////////////////////
    ////////////////////////////////////////////////



    
    // Auth Req Lttr Weapon Page
    public function auth_req_lttr_weapon($id = null){
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

        $auth_req_lttr_weapon = DB::table('auth_req_lttr_weapon')
        ->select( '*')
        ->where('id',$id)
        ->get();

        $id = null;
        $request_made_by = null;
        $incharge = null;
        $auth_given_by = null;
        $transport_date = null;
        $location_from = null;
        $location_to = null;
        $route = null;
        $no_of_wpn = null;
        $wpn_details = null;
        $type_of_veh = null;
        $vehicle_no = null;
        $driver = null;
        $escort = null;
        $escort_weapon_no = null;
        $no_of_magazins = null;
        $no_of_ammo = null;
        $ref_of_ltr1 = null;
        $attachment1 = null;

        foreach($auth_req_lttr_weapon as $dt){

            $id = $dt->id;
            $request_made_by = $dt->request_made_by;
            $incharge = $dt->incharge;
            $auth_given_by = $dt->auth_given_by;
            $transport_date = $dt->transport_date;
            $location_from = $dt->location_from;
            $location_to = $dt->location_to;
            $route = $dt->route;
            $no_of_wpn = $dt->no_of_wpn;
            $wpn_details = $dt->wpn_details;
            $type_of_veh = $dt->type_of_veh;
            $vehicle_no = $dt->vehicle_no;
            $driver = $dt->driver;
            $escort = $dt->escort;
            $escort_weapon_no = $dt->escort_weapon_no;
            $no_of_magazins = $dt->no_of_magazins;
            $no_of_ammo = $dt->no_of_ammo;
            $ref_of_ltr1 = $dt->ref_of_ltr1;
            $attachment1 = $dt->attachment1;
        }

        return view('auth_req_lttr_weapon' , compact('organizations','organization_users','vehicle_types', 'organization_types' , 'id','request_made_by','incharge','auth_given_by' ,'transport_date','location_from','location_to','route','no_of_wpn','wpn_details','type_of_veh','vehicle_no','driver','escort','escort_weapon_no','no_of_magazins','no_of_ammo','ref_of_ltr1','attachment1'));
    }




    // View Page
    public function auth_req_lttr_weapon_view(){
        $auth_req_lttr_weapon = DB::table('auth_req_lttr_weapon')
        ->select( 'auth_req_lttr_weapon.id', 'auth_req_lttr_weapon.created_at', 'auth_req_lttr_weapon.ref_of_ltr1', 'auth_req_lttr_weapon.no_of_wpn', 'auth_req_lttr_weapon.transport_date', 'organization_armories.organization', 'auth_req_lttr_weapon.auth_given_by')
        ->join('organization_armories','auth_req_lttr_weapon.request_made_by','=','organization_armories.id')
        ->get();
        return view('auth_req_lttr_weapon_view' , ['auth_req_lttr_weapon' => $auth_req_lttr_weapon ]);
    }




    // Submit Button // Save Data
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



    
    // View Button // View data
    public function auth_req_lttr_weapons_view_btn(Request $req){

        $data = DB::table('auth_req_lttr_weapon')
        ->select('auth_req_lttr_weapon.*', 'organization_armories.*')
        ->join('organization_armories','auth_req_lttr_weapon.request_made_by','=','organization_armories.id')
        ->where('auth_req_lttr_weapon.id',$req->ReqId)
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
            <p>2. In charge Offr : <span>{$dt->incharge}</span> </p>
            <p>3. Auth given by (ref of the ltr/msg) : <span>{$dt->auth_given_by}</span> </p>
            <p>4. Date of transportation : <span>{$dt->transport_date}</span> </p>
            <p>5. Location to be transported : <span>{$location_from->organization} To {$location_to->organization}</span> </p>
            <p>6. Route : <span>{$dt->route}</span> </p>
            <p>7. (i) No of wpn, ammo and explosives : <span>{$dt->no_of_wpn}</span>7. (ii) Wpn details (wpn nos) : <span>{$dt->wpn_details}</span></p>

            <p>8. (i) Type of vehicle : <span>{$dt->type_of_veh}</span>8. (ii) Vehicle No : <span>{$dt->vehicle_no}</span></p>
            <p>9. Driver : <span>{$dt->driver}</span></p>
            <p>10. Escort name : <span>{$dt->escort}</span></p>

            <p>11. (i) Escort weapon no : <span>{$dt->escort_weapon_no}</span>11. (ii) No of magazins : <span>{$dt->no_of_magazins}</span>11. (iii) Ammo : <span>{$dt->no_of_ammo}</span> </p>


            <p>12. If wpn and ammo/explosives are stationed at night, ref of the ltr/msg : <span>{$dt->ref_of_ltr1}</span></p>
            <p>13. Ref of ltr/msg of 'hiring auth to the Ay' for veh which use civil no plates : <span>{$dt->ref_of_ltr2}</span></p>
            ";
        }
        print_r($html);

    }

}
