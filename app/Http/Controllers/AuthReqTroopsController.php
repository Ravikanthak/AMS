<?php

namespace App\Http\Controllers;

use App\Models\AuthReqLtrTroops;
use App\Models\AuthReqLtrTroopsFwd;
use App\Models\OrganizationArmory;
use App\Models\User;
use App\Models\UserType;
use App\Models\VehicleType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class AuthReqTroopsController extends Controller
{


    //AE

    public function searchPerson($id)
    {
        $url = 'https://str.army.lk/api/get_person/?str-token=1189d8dde195a36a9c4a721a390a74e6&service_no=o/11666';
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

    public function searchWeapon($id)
    {
        $url = 'https://str.army.lk/api/get_person/?str-token=1189d8dde195a36a9c4a721a390a74e6&service_no=o/11666';
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

    //END AE

    //// CREATE AUTH REQ LTR TROOPS ////

    // Auth Req Ltr Troops - Page
    public function auth_req_ltr_troops($id = null){


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

        $auth_req_ltr_troops = AuthReqLtrTroops::select( '*')
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
        $req_fwd_by = null;
        $req_fwd_to = null;
        

        foreach($auth_req_ltr_troops as $dt){

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
            $req_fwd_by = $dt->req_fwd_by;
            $req_fwd_to = $dt->req_fwd_to;
            
        }

        //AE
        $loggedInUSer = User::join('user_types','user_types.id','=','users.user_type')
            ->where('users.id', Auth::user()->id)
            ->get(['users.id as userId','user_types.name as userAppointment','users.name as userName']);

        $orgAppointments = User::join('user_types','user_types.id','=','users.user_type')
            ->where('users.organization_id', Auth::user()->organization_id)
            ->where('users.id','!=', Auth::user()->id)
            ->get(['users.id as userId','user_types.name as userAppointment','users.name as userName']);
        $thisOrg = OrganizationArmory::where('id', Auth::user()->organization_id)->get();
        //END AE

        return view('auth_req_ltr_troops' , compact('organizations','organization_users','vehicle_types',
            'organization_types' , 'id','request_made_by_id','reason','no_of_troops' ,'transport_date','location_from',
            'location_to','auth_given_by','route','vehicle_type_name','no_of_seat','convoy_comd','escort',
            'escort_weapon_no','no_of_magazins','no_of_ammo','driver','measures','ref_of_ltr','attachment',
            'req_fwd_by','req_fwd_to','loggedInUSer','orgAppointments','thisOrg'));
    }




    // Submit Button // Save Data
    public function auth_req_ltr_troops_form_func(Request $req){

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
        
            $UpdateOrInsertData = AuthReqLtrTroops::updateOrInsert(
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
                    'escort' => json_encode($req->escort),
                    'escort_weapon_no' => json_encode($req->escort_weapon_no),
                    'no_of_magazins' => $req->no_of_magazins,
                    'no_of_ammo' => $req->no_of_ammo,
                    'driver' => json_encode($req->driver),
                    'measures' => $req->measures_taken,
                    'ref_of_ltr' => $req->ref_of_ltr,
                    'attachment' => $imageName,
                    'req_fwd_by' => $req->request_forward_by,
                    'req_fwd_to' => $req->request_forward_to,
                    'organization_id' => Auth()->user()->organization_id, 
                    'user_id' => Auth()->user()->id,
                    'ip' => $_SERVER['REMOTE_ADDR'],
                    'created_at' => Carbon::now(),
                ]);


                if ($req->parameter_id == null ) {  // Insert operation was performed

                    // Get last inserted ID
                    $LastInsertedIDValue = AuthReqLtrTroops::select('id')
                    ->orderBy('id', 'desc')
                    ->limit(1)
                    ->value('id');

                    // Insert 1st Request Created record 
                    $InsertFwdList1 = new AuthReqLtrTroopsFwd;
                    $InsertFwdList1->auth_req_ltr_troops_id = $LastInsertedIDValue;
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

    //// CREATE AUTH REQ LTR TROOPS ////




    //// VIEW AUTH REQ LTR TROOPS ////

    // Auth Req Ltr Troops View - Page
    public function auth_req_ltr_troops_view(){

        // get auth_req_ltr_troops table details and alter its details
        $auth_req_ltr_troops = AuthReqLtrTroops::select('*')
        ->where('req_fwd_by' , Auth()->user()->id)
        ->where('organization_id' , Auth()->user()->organization_id)
        ->get();

        foreach($auth_req_ltr_troops as $dt){

            $req_fwd_by_name = UserType::select('name')
            ->where('id', $dt->req_fwd_by)
            ->first();
            
            $req_fwd_to_name = UserType::select('name')
            ->where('id', $dt->req_fwd_to)
            ->first();

            $dt->req_fwd_by = $req_fwd_by_name->name;
            $dt->req_fwd_to = $req_fwd_to_name->name;
        }
        // get auth_req_ltr_troops table details and alter its details



        $organization_types = UserType::select( 'id','name')
        ->get();

        return view('auth_req_ltr_troops_view' , compact('auth_req_ltr_troops','organization_types'));
    }



    // Track Button //  Track data
    public function auth_req_ltr_troops_track_btn(Request $request){

        $data = AuthReqLtrTroopsFwd::select('auth_req_ltr_troops_fwds.*', 'user_types.*')
        ->join('user_types','auth_req_ltr_troops_fwds.req_fwd_to','=','user_types.id')
        ->where('auth_req_ltr_troops_id', $request->ReqId )
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



    // View Button // View Data
    public function auth_req_ltr_troops_view_btn(Request $req){

        $data = DB::table('auth_req_ltr_troops AS atl')
        ->select( 'atl.request_made_by', 'atl.reason', 'atl.no_of_troops', 'atl.transport_date', 'atl.location_from', 'atl.location_to', 'atl.auth_given_by', 'atl.route', 'atl.type_of_veh', 'atl.no_of_seat', 'atl.convoy_comd', 'atl.escort', 'atl.escort_weapon_no', 'atl.no_of_magazins', 'atl.no_of_ammo', 'atl.driver', 'atl.measures', 'atl.ref_of_ltr', 'atl.attachment', 'atl.req_fwd_to', 'atl.req_fwd_by', 'atl.id', 'oa.organization', 'oa.organization_type', 'oa.armory' )
        ->join('organization_armories AS oa', 'atl.request_made_by', '=', 'oa.id')
        ->where('atl.id', $req->ReqId)
        ->get();

        $html = "";

        foreach($data as $dt){

            $auth_req_ltr_troops_fwds_id = AuthReqLtrTroopsFwd::select('id')
            ->where('auth_req_ltr_troops_id', $dt->id)
            // ->first()
            ->value('id');

            $location_from = DB::table('organization_armories')
            ->select('organization')
            ->where('id', $dt->location_from)
            ->first();

            $location_to = DB::table('organization_armories')
            ->select('organization')
            ->where('id', $dt->location_to)
            ->first();


            $link = route('auth_req_ltr_troops_take_action') . '/' . $auth_req_ltr_troops_fwds_id;
            
            $take_action_btn = "";
            if (Auth()->user()->user_type != 4 ) { // 4 = Subject Clerk
                $take_action_btn = "<a target='_blank' href='{$link}' id='{$auth_req_ltr_troops_fwds_id}' class='btn btn-success edit'>Take Action</a>";
            }
            else{
            }
            

            $html .= "
            <div class='modal-body view_auth_req_ltr_troops_details'>
            <p>1. Auth Request Ltr ID : <span>{$dt->id}</span> </p>
            <p>2. Request made by (location) : <span>{$dt->organization}</span> </p>
            <p>3. Reason for transportation : <span>{$dt->reason}</span> </p>
            <p>4. No of troops to be transported : <span>{$dt->no_of_troops}</span> </p>
            <p>5. Date of transportation : <span>{$dt->transport_date}</span> </p>
            <p>6. Location to be transported : <span>{$location_from->organization} To {$location_to->organization}</span> </p>
            <p>7. Auth given by (ref of the ltr/msg) : <span>{$dt->auth_given_by}</span> </p>
            <p>8. Route : <span>{$dt->route}</span> </p>
            <p>9. (i) Type of vehicle : <span>{$dt->type_of_veh}</span>9. (ii) No of seat available : <span>{$dt->no_of_seat}</span> </p>
            <p>10. Vehicle/Convoy comd name : <span>{$dt->convoy_comd}</span></p>
            <p>11. Escort name : <span>{$dt->escort}</span></p>
            <p>12. (i) Escort weapon no : <span>{$dt->escort_weapon_no}</span>12. (ii) No of magazins : <span>{$dt->no_of_magazins}</span>12. (iii) Ammo : <span>{$dt->no_of_ammo}</span> </p>
            <p>13. Driver name : <span>{$dt->driver}</span></p>
            <p>14. Measures taken for the sy of tps to be transported : <span>{$dt->measures}</span></p>
            <p>15. Ref of ltr/msg of 'hiring auth to the Ay' for veh which use civil no plates : <span>{$dt->ref_of_ltr}</span></p>
            </div>
            <div class='modal-footer'>{$take_action_btn}<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
            </div>
            ";
        }

        print_r($html);
    }
    //// VIEW AUTH REQ LTR TROOPS ////




    //// VIEW AUTH REQ LTR TROOPS TAKE ACTION ////

    // Auth Req Ltr Troops Take Action View(Table) - Page
    public function auth_req_ltr_troops_take_action_view(){

        $auth_req_ltr_troops = AuthReqLtrTroopsFwd::select('*')
        ->where('req_fwd_to' , Auth()->user()->id)
        // ->where('organization_id' , Auth()->user()->organization_id)
        ->get();

        foreach ($auth_req_ltr_troops as $auth_req_ltr_troop)
        {

            $req_fwd_by = User::join('user_types','user_types.id','=','users.user_type')
                ->where('users.id', $auth_req_ltr_troop->req_fwd_by)->first('user_types.name');

            $req_fwd_to = User::join('user_types','user_types.id','=','users.user_type')
                ->where('users.id', $auth_req_ltr_troop->req_fwd_to)->first('user_types.name');

            $auth_req_ltr_troop->req_fwd_to = $req_fwd_to->name;
            $auth_req_ltr_troop->req_fwd_by = $req_fwd_by->name;
        }

        $organization_types = UserType::select( 'id','name')
        ->get();


        return view('auth_req_ltr_troops_take_action_view' , compact('auth_req_ltr_troops','organization_types'));
    }



    // Auth Req Ltr Troops Take Action - Page
    public function auth_req_ltr_troops_take_action($id = null){
         
        // get $auth_req_ltr_troops_fwds id value
        $auth_req_ltr_troops_id = AuthReqLtrTroopsFwd::
        select('auth_req_ltr_troops_id')
        ->where('id',$id)
        ->first()
        ->value('auth_req_ltr_troops_id');


        // get auth_req_ltr_troops_fwds table details and alter its details
        $auth_req_ltr_troops_fwds = AuthReqLtrTroopsFwd::select('*')
        ->where('id',$id)
        ->first();

        $req_fwd_by = $auth_req_ltr_troops_fwds->req_fwd_by;
        $req_fwd_to = $auth_req_ltr_troops_fwds->req_fwd_to;

        $auth_req_ltr_troops_fwd_by_name_value =  AuthReqLtrTroopsFwd::
        select('user_types.name', 'auth_req_ltr_troops_fwds.req_fwd_by')
        ->join('user_types', 'auth_req_ltr_troops_fwds.req_fwd_by', '=', 'user_types.id')
        ->where('req_fwd_by', $req_fwd_by)
        ->value('name');
        $auth_req_ltr_troops_fwds->req_fwd_by = $auth_req_ltr_troops_fwd_by_name_value;

        $auth_req_ltr_troops_fwd_to_name_value =  AuthReqLtrTroopsFwd::
        select('user_types.name', 'auth_req_ltr_troops_fwds.req_fwd_to')
        ->join('user_types', 'auth_req_ltr_troops_fwds.req_fwd_to', '=', 'user_types.id')
        ->where('req_fwd_to', $req_fwd_to)
        ->value('name');
        $auth_req_ltr_troops_fwds->req_fwd_to = $auth_req_ltr_troops_fwd_to_name_value;
        // get auth_req_ltr_troops_fwds table details and alter its details


        // If already approved, get req_fwd_to name value
        $req_fwd_to_name =  AuthReqLtrTroopsFwd::
        select('req_fwd_to', 'user_types.name')
        ->join('user_types', 'auth_req_ltr_troops_fwds.req_fwd_to', '=', 'user_types.id')
        ->offset(1)
        ->limit(1)
        ->value('name');


        // Get organization name list
        $organization_types = UserType::select( 'id','name')
        ->get();

        return view('auth_req_ltr_troops_take_action' , compact('auth_req_ltr_troops_fwds','req_fwd_to_name','organization_types'));
    }
    


    

    
    // Check Status OnClick View Button
    public function auth_req_ltr_troops_check_status(Request $request){
        
        // get $auth_req_ltr_troops_fwds id value
        $id = AuthReqLtrTroopsFwd::select('id')
        ->where('id',$request->req_id)
        ->value('id');

        $status = AuthReqLtrTroopsFwd::select('req_fwd_by_status' , 'req_fwd_to_status')
        ->where('id', $request->req_id)
        ->get();

        // Get auth_req_ltr_troops_id related to id
        $auth_req_ltr_troops_id = AuthReqLtrTroopsFwd::select('auth_req_ltr_troops_id')
        ->where('id', $request->req_id)
        ->value('auth_req_ltr_troops_id');

        $status_final = AuthReqLtrTroopsFwd::select('*')
        ->where('auth_req_ltr_troops_id', $auth_req_ltr_troops_id)
        ->latest()
        ->first()
        ->req_fwd_to_status;

        return response()->json(['status' => 1 , 'msg' => $status , 'msg2' => $status_final ]);
    }



    // Approve Button // Approve Req
    public function auth_req_ltr_troops_approve_btn(Request $request){

        AuthReqLtrTroopsFwd:: // Update status to Approved in 1st record
        where('id', $request->req_id)
        ->update(['req_fwd_to_status' => 'Approved' , 'comment_approve' => $request->comments , 'user_id' => Auth()->user()->id ]);

        // Get auth_req_ltr_troops_id related to id
        $auth_req_ltr_troops_id = AuthReqLtrTroopsFwd::select('auth_req_ltr_troops_id')
        ->where('id', $request->req_id)
        ->value('auth_req_ltr_troops_id');

        AuthReqLtrTroopsFwd::insert([ // Insert 2nd Request Pending record 
            'auth_req_ltr_troops_id' => $auth_req_ltr_troops_id,
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
    public function auth_req_ltr_troops_decline_btn(Request $request){

        // get $auth_req_ltr_troops_fwds id value
        $id = AuthReqLtrTroopsFwd::select('id')
        ->where('id',$request->req_id)
        ->value('id');

        $update = AuthReqLtrTroopsFwd::where('id', $id)
        ->update(['req_fwd_to_status' => 'Declined' , 'comment_decline' => $request->comments , 'user_id' => Auth()->user()->id]);

        return response()->json(['status' => 1 , 'msg' => 'Declined']);
    }



    // Final Approve Button // Final Approve Req
    public function auth_req_ltr_troops_final_approve_btn(Request $request){
        
        // Get auth_req_ltr_troops_id related to id
        $auth_req_ltr_troops_id = AuthReqLtrTroopsFwd::select('auth_req_ltr_troops_id')
        ->where('id', $request->req_id)
        ->value('auth_req_ltr_troops_id');       

        // Get latest auth_req_ltr_troops_id 
        $record = AuthReqLtrTroopsFwd::where('auth_req_ltr_troops_id', $auth_req_ltr_troops_id) 
        ->orderBy('id', 'desc')
        ->first();

        $update = AuthReqLtrTroopsFwd::where('id', $record->id)
        ->update([ 
            'req_fwd_to_status' => 'Approved Final', 
            'comment_approve' => $request->comments , 
            'user_id' => Auth()->user()->id 
        ]);
        
        return response()->json(['status' => 1 , 'msg' => 'Approved Final']);
    }

    //// VIEW AUTH REQ LTR TROOPS TAKE ACTION ////
    

}
