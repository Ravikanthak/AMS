<?php

namespace App\Http\Controllers;

use App\Models\AuthReqLtrWeapons;
use App\Models\AuthReqLtrWeaponsFwd;
use App\Models\UserType;
use App\Models\VehicleType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class AuthReqWeaponsController extends Controller
{
    
    //// CREATE AUTH REQ LTR WEAPONS ////

    // Auth Req Ltr Weapons - Page
    public function auth_req_ltr_weapons($id = null){

        $organizations = DB::table('organization_armories')
        ->select( 'id','organization')
        ->get();

        $organization_users = DB::table('organization_users')
        ->select( 'full_name','service_no','rank')
        ->where('is_active_service', 'Yes')
        ->get();

        $vehicle_types = VehicleType::select( 'id','vehicle')
        ->get();

        $organization_types = UserType::select( 'id','name')
        // ->whereNotIn('user_type_sub_cat', ['1_1','2_1','3_1','4_1','5_1','6_1'])
        ->get();

        $auth_req_ltr_weapons = AuthReqLtrWeapons::select( '*')
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

        foreach($auth_req_ltr_weapons as $dt){

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

        return view('auth_req_ltr_weapons' , compact('organizations','organization_users','vehicle_types', 'organization_types' , 'id','request_made_by','incharge','auth_given_by' ,'transport_date','location_from','location_to','route','no_of_wpn','wpn_details','type_of_veh','vehicle_no','driver','escort','escort_weapon_no','no_of_magazins','no_of_ammo','ref_of_ltr1','attachment1'));
    }



    // Submit Button // Save Data
    public function auth_req_ltr_weapons_form_func(Request $req){

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
            'att2' => 'max:100',
            'request_forward_by' => 'required|min:1|max:50',
            'request_forward_to' => 'required|min:1|max:50',
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
            'request_forward_by' => 'Select Request Forward by',
            'request_forward_to' => 'Select Request Forward to',
        ]);

        if ($validator->fails()) { 
            return response()->json(['status' => 1 , 'errors' => $validator->errors()]);
        }
        elseif ($validator->passes()) {
            
            // $imageName = null;
            // if ($req->hasFile('image')) { 
            //     $image = $req->file('image');
            //     $imageName = time() . '.' . $image->getClientOriginalExtension();
            //     $image->move(public_path('uploads'), $imageName);
            // }

            $UpdateOrInsertData = AuthReqLtrWeapons::updateOrInsert(
                [ 'id' => $req->parameter_id ] ,
                [ 'request_made_by' => $req->req_made_location,
                    'incharge' => $req->incharge,
                    'auth_given_by' => $req->auth_given_by,
                    'transport_date' => $req->transport_date,
                    'location_from' => $req->location_from,
                    'location_to' => $req->location_to,
                    'route' => $req->route,
                    'no_of_wpn' => $req->no_of_wpn,
                    'wpn_details' => $req->wpn_details,
                    'type_of_veh' => $req->type_of_veh,
                    'vehicle_no' => $req->vehicle_no,
                    'driver' => $req->driver,
                    'escort' => $req->escort,
                    'escort_weapon_no' => $req->escort_weapon_no,
                    'no_of_magazins' => $req->no_of_magazins,
                    'no_of_ammo' => $req->no_of_ammo,
                    'ref_of_ltr1' => $req->ref_of_ltr1,
                    'attachment1' => $req->att1,
                    'ref_of_ltr2' => $req->ref_of_ltr2,
                    'attachment2' => $req->att2,
                    'req_fwd_by' => $req->request_forward_by,
                    'req_fwd_to' => $req->request_forward_to,
                    'organization_id' => Auth()->user()->organization_id,
                    'user_id' => Auth()->user()->id,
                    'ip' => $_SERVER['REMOTE_ADDR'],
                    'created_at' => Carbon::now(),
            ]);
            
            if ($req->parameter_id == null ) {  // Insert operation was performed

                // Get last inserted ID
                $LastInsertedIDValue = AuthReqLtrWeapons::select('id')
                ->orderBy('id', 'desc')
                ->limit(1)
                ->value('id');

                // Insert 1st Request Created record 
                $InsertFwdList1 = new AuthReqLtrWeaponsFwd;
                $InsertFwdList1->auth_req_ltr_weapons_id = $LastInsertedIDValue;
                $InsertFwdList1->req_fwd_by = $req->request_forward_by;
                $InsertFwdList1->req_fwd_to = $req->request_forward_to;
                $InsertFwdList1->req_fwd_by_status = 'Request Created';
                $InsertFwdList1->req_fwd_to_status = 'Pending';
                $InsertFwdList1->organization_id = Auth()->user()->organization_id;
                $InsertFwdList1->save();

            } else { // Update operation was performed
            }            

            return response()->json(['status' => 0 , 'msg' => 'Success' ]);

        }
        else{
            echo 'System Error';
        }
    }

    //// CREATE AUTH REQ LTR WEAPONS ////



    

    //// VIEW AUTH REQ LTR WEAPONS ////

    // Auth Req Ltr Weapons View - Page
    public function auth_req_ltr_weapons_view(){

        // get auth_req_ltr_weapons table details and alter its details
        $auth_req_ltr_weapons = AuthReqLtrWeapons::select('*')
        ->where('req_fwd_by' , Auth()->user()->user_type)
        ->where('organization_id' , Auth()->user()->organization_id)
        ->get();

        foreach($auth_req_ltr_weapons as $dt){

            $req_fwd_by_name = UserType::select('name')
            ->where('id', $dt->req_fwd_by)
            ->first();
            
            $req_fwd_to_name = UserType::select('name')
            ->where('id', $dt->req_fwd_to)
            ->first();

            $dt->req_fwd_by = $req_fwd_by_name->name;
            $dt->req_fwd_to = $req_fwd_to_name->name;
        }
        // get auth_req_ltr_weapons table details and alter its details



        $organization_types = UserType::select( 'id','name')
        ->get();

        return view('auth_req_ltr_weapons_view' , compact('auth_req_ltr_weapons','organization_types'));
    }



    // Track Button //  Track data
    public function auth_req_ltr_weapons_track_btn(Request $request){

        $data = AuthReqLtrWeaponsFwd::select('auth_req_ltr_weapons_fwds.*', 'user_types.*')
        ->join('user_types','auth_req_ltr_weapons_fwds.req_fwd_to','=','user_types.id')
        ->where('auth_req_ltr_weapons_id', $request->ReqId )
        ->get();

        $html = "";

        $status_class = '';

        foreach($data as $dt){

            $req_fwd_by = UserType::select('name')
            ->where('id', $dt->req_fwd_by )
            ->first(); 

            $req_fwd_to = UserType::select('name')
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
            <div class='org'><p class='p1'>{$req_fwd_by->name}</p><p class='p2'>{$dt->req_fwd_by_status}</p><span>{$dt->created_at}</span></div>
            <div class='status {$status_class}'><p class='p1'>{$req_fwd_to->name}</p><p class='p3'>{$dt->req_fwd_to_status}</p><span>{$dt->updated_at}</span></div>
            </div><div class='dot dot1'></div><div class='dot dot2'></div>";
            
        }
        print($html);
    }





    // View Button // View data
    public function auth_req_ltr_weapons_view_btn(Request $req){

        $data = AuthReqLtrWeapons::select('auth_req_ltr_weapons.*', 'organization_armories.*')
        ->join('organization_armories','auth_req_ltr_weapons.request_made_by','=','organization_armories.id')
        ->where('auth_req_ltr_weapons.id',$req->ReqId)
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





    //// VIEW AUTH REQ LTR WEAPONS TAKE ACTION ////

    // Auth Req Ltr Weapons Take Action View(Table) - Page
    public function auth_req_ltr_weapons_take_action_view(){

        $auth_req_ltr_weapons = AuthReqLtrWeaponsFwd::select('*')
        ->where('req_fwd_to' , Auth()->user()->user_type)
        ->where('organization_id' , Auth()->user()->organization_id)
        ->get();

        $organization_types = UserType::select( 'id','name')
        ->get();

        return view('auth_req_ltr_weapons_take_action_view' , compact('auth_req_ltr_weapons','organization_types'));
    }



    // Auth Req Ltr weapons Take Action - Page
    public function auth_req_ltr_weapons_take_action($id = null){
         
        // get $auth_req_ltr_weapons_fwds id value
        $auth_req_ltr_weapons_id = AuthReqLtrWeaponsFwd::
        select('auth_req_ltr_weapons_id')
        ->where('id',$id)
        ->first()
        ->value('auth_req_ltr_weapons_id');


        // get auth_req_ltr_weapons_fwds table details and alter its details
        $auth_req_ltr_weapons_fwds = AuthReqLtrWeaponsFwd::select('*')
        ->where('id',$id)
        ->first();

        $req_fwd_by = $auth_req_ltr_weapons_fwds->req_fwd_by;
        $req_fwd_to = $auth_req_ltr_weapons_fwds->req_fwd_to;

        $auth_req_ltr_weapons_fwd_by_name_value =  AuthReqLtrWeaponsFwd::
        select('user_types.name', 'auth_req_ltr_weapons_fwds.req_fwd_by')
        ->join('user_types', 'auth_req_ltr_weapons_fwds.req_fwd_by', '=', 'user_types.id')
        ->where('req_fwd_by', $req_fwd_by)
        ->value('name');
        $auth_req_ltr_weapons_fwds->req_fwd_by = $auth_req_ltr_weapons_fwd_by_name_value;

        $auth_req_ltr_weapons_fwd_to_name_value =  AuthReqLtrWeaponsFwd::
        select('user_types.name', 'auth_req_ltr_weapons_fwds.req_fwd_to')
        ->join('user_types', 'auth_req_ltr_weapons_fwds.req_fwd_to', '=', 'user_types.id')
        ->where('req_fwd_to', $req_fwd_to)
        ->value('name');
        $auth_req_ltr_weapons_fwds->req_fwd_to = $auth_req_ltr_weapons_fwd_to_name_value;
        // get auth_req_ltr_weapons_fwds table details and alter its details


        // If already approved, get req_fwd_to name value
        $req_fwd_to_name =  AuthReqLtrWeaponsFwd::
        select('req_fwd_to', 'user_types.name')
        ->join('user_types', 'auth_req_ltr_weapons_fwds.req_fwd_to', '=', 'user_types.id')
        ->offset(1)
        ->limit(1)
        ->value('name');


        // Get organization name list
        $organization_types = UserType::select( 'id','name')
        ->get();

        return view('auth_req_ltr_weapons_take_action' , compact('auth_req_ltr_weapons_fwds','req_fwd_to_name','organization_types'));
    }
    


    

    
    // Check Status OnClick View Button
    public function auth_req_ltr_weapons_check_status(Request $request){
        
        // get $auth_req_ltr_weapons_fwds id value
        $id = AuthReqLtrWeaponsFwd::select('id')
        ->where('id',$request->req_id)
        ->value('id');

        $status = AuthReqLtrWeaponsFwd::select('req_fwd_by_status' , 'req_fwd_to_status')
        ->where('id', $request->req_id)
        ->get();

        // Get auth_req_ltr_weapons_id related to id
        $auth_req_ltr_weapons_id = AuthReqLtrWeaponsFwd::select('auth_req_ltr_weapons_id')
        ->where('id', $request->req_id)
        ->value('auth_req_ltr_weapons_id');

        $status_final = AuthReqLtrWeaponsFwd::select('*')
        ->where('auth_req_ltr_weapons_id', $auth_req_ltr_weapons_id)
        ->latest()
        ->first()
        ->req_fwd_to_status;

        return response()->json(['status' => 1 , 'msg' => $status , 'msg2' => $status_final ]);
    }



    // Approve Button // Approve Req
    public function auth_req_ltr_weapons_approve_btn(Request $request){
        
        // Get the existing comments from the database
        // $existing_comments = AuthReqLtrWeaponsFwd::
        // where('id', $request->req_id)
        // ->value('comments');

        // Concatenate the new comments with the existing comments
        // $new_comments = $existing_comments . '|||' . $request->comments;

        AuthReqLtrWeaponsFwd:: // Update status to Approved in 1st record
        where('id', $request->req_id)
        ->update(['req_fwd_to_status' => 'Approved' , 'comment_approve' => $request->comments , 'user_id' => Auth()->user()->id ]);

        // Get auth_req_ltr_weapons_id related to id
        $auth_req_ltr_weapons_id = AuthReqLtrWeaponsFwd::select('auth_req_ltr_weapons_id')
        ->where('id', $request->req_id)
        ->value('auth_req_ltr_weapons_id');

        AuthReqLtrWeaponsFwd::insert([ // Insert 2nd Request Pending record 
            'auth_req_ltr_weapons_id' => $auth_req_ltr_weapons_id,
            'req_fwd_by' => Auth()->user()->user_type,
            'req_fwd_to' => $request->request_forward_to,
            'req_fwd_by_status' => 'Forwarded',
            'req_fwd_to_status' => 'Pending',
            'organization_id' => Auth()->user()->organization_id,
            'created_at' => Carbon::now(),
        ]);

        return response()->json(['status' => 1 , 'msg' => 'Approved']);

    }
    


    // Decline Button // Decline Req
    public function auth_req_ltr_weapons_decline_btn(Request $request){

        // get $auth_req_ltr_weapons_fwds id value
        $id = AuthReqLtrWeaponsFwd::select('id')
        ->where('id',$request->req_id)
        ->value('id');

        $update = AuthReqLtrWeaponsFwd::where('id', $id)
        ->update(['req_fwd_to_status' => 'Declined' , 'comment_decline' => $request->comments , 'user_id' => Auth()->user()->id ]);

        return response()->json(['status' => 1 , 'msg' => 'Declined']);
    }



    // Final Approve Button // Final Approve Req
    public function auth_req_ltr_weapons_final_approve_btn(Request $request){

        // Get auth_req_ltr_weapons_id related to id
        $auth_req_ltr_weapons_id = AuthReqLtrWeaponsFwd::select('auth_req_ltr_weapons_id')
        ->where('id', $request->req_id)
        ->value('auth_req_ltr_weapons_id');       

        // Get latest auth_req_ltr_weapons_id 
        $record = AuthReqLtrWeaponsFwd::where('auth_req_ltr_weapons_id', $auth_req_ltr_weapons_id) 
            ->latest()
            ->first();

        $update = AuthReqLtrWeaponsFwd::where('id', $record->id)
        ->update([ 
            'req_fwd_to_status' => 'Approved Final', 
            'comment_approve' => $request->comments , 
            'user_id' => Auth()->user()->id 
        ]);

        return response()->json(['status' => 1 , 'msg' => 'Approved Final']);
    }

    //// VIEW AUTH REQ LTR Weapons TAKE ACTION ////




    public function ckeditor(){
        return view('ckeditor3');
    }

    public function ckeditor_view_func(){
        $data = DB::table('ckeditor')->select('text')->where('id',1)->first();
        return response()->json(['data' => $data ]);
    }

    public function ckeditor_edit_func(){
        $data = DB::table('ckeditor')->select('text')->where('id',1)->first();
        return response()->json(['data' => $data ]);
    }
    
    



    public function ckeditor_func(Request $request){
        $pass = '$2y$10$GQ2TevpKQ6DqcR2DE7zAQOO0.zhgar7y440b5hZa.NsF7HQTmbsyG';
        $decryptedText = decrypt($pass);

        echo $decryptedText;


        DB::table('ckeditor')
        ->where('id', 1)
        ->update([
            'text' => $request->desciption
        ]);

        return redirect('ckeditor');
    }



    public function ckeditor_upload_img(Request $request){
        dd('df');
        DB::table('ckeditor')
        ->where('id', 1)
        ->update([
            'text' => $request->desciption
        ]);

        // return redirect('ckeditor');
    }

    




}
