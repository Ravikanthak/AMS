<!DOCTYPE html>
<html lang="en">
<head>
  @include('inc/header')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <style>
        .select2-container--default .select2-selection--single {
            height: 38px !important;
        }
        .weapon-list {
            height: 35px !important;
        }

        .select2-container--default .select2-dropdown .select2-search__field:focus, .select2-container--default .select2-search--inline .select2-search__field:focus {
            outline: none !important;
            border: none !important;
            color: #fff;

        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #007bff;
            border-color: #006fe6;
            margin-left: 5px;
            margin-right: -2px;
            color: #fff;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__display {
            cursor: default;
            padding-left: 10px;
            padding-right: 10px;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">

<div class="wrapper">

  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    @include('inc/topnavbar')
  </nav>

  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      @include('inc/sidebar')
  </aside>
  
  
  
  <div class="content-wrapper create_authority_request">

    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>Create Authority Request (Weapon & Ammo/Explosive)</h1>
              <input type="hidden" value="{{$thisOrg[0]->organization_api_id}}" id="org_api_id">
              <input type="hidden" value="{{$thisOrg[0]->armory_api_id}}" id="armory_api_id">
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">

          <form class="form" action="#">
          @csrf
          <div class="row">

            <section class="col-lg-12 connectedSortable ui-sortable">
             
              <div class="card auth_req_lttr_form">
                  
                  <div class="col-md-12 ">
                      <div class="form-group mb-3">
                      <label for="req_made_location" class="form-label">1. Request made by (location)</label>
                        <select name="req_made_location" class="selectpicker form-control" id="req_made_location" data-container="body" data-live-search="true" title="Select the Location" data-hide-disabled="true">
                            {{--@if (isset($request_made_by))--}}
                              {{--@foreach($organizations as $org)--}}
                                {{--<option value="{{$org->id}}" @if($org->id == $request_made_by) selected @endif>{{$org->organization}}</option>--}}
                              {{--@endforeach--}}
                            {{--@else --}}
                              {{--@foreach($organizations as $org)--}}
                                {{--<option value="{{$org->id}}">{{$org->organization}}</option>--}}
                              {{--@endforeach--}}
                            {{--@endif--}}
                            <option selected="selected" value="{{$thisOrg[0]->id}}">{{$thisOrg[0]->organization}}</option>
                        </select>
                    </div>
                  </div>

                  <div class="col-md-12 ">
                    <div class="form-group mb-3">
                      <label for="incharge" class="form-label">2. In charge Offr</label>
                      <input type="hidden" id="selected_incharge" value="{{isset($incharge)?$incharge:''}}">
                      <select name="incharge" class="form-control" id="incharge" data-container="body" data-live-search="true" data-hide-disabled="true">
                            {{--@if (isset($incharge))--}}
                              {{--@foreach($organization_users as $user)--}}

                                  {{--@if (substr($user->service_no, 0, 1) === 'O')--}}
                                    {{--<option value="{{$user->service_no}}" @if($user->service_no == $incharge) selected @endif>{{$user->service_no}} {{$user->full_name}}</option>--}}
                                  {{--@endif          --}}

                              {{--@endforeach--}}
                            {{--@else --}}
                              {{--@foreach($organization_users as $user)--}}

                                  {{--@if (substr($user->service_no, 0, 1) === 'O')--}}
                                    {{--<option value="{{$user->service_no}}">{{$user->service_no}} {{$user->full_name}}</option>--}}
                                  {{--@endif --}}
                                {{----}}
                              {{--@endforeach--}}
                            {{--@endif--}}
                      </select>
                    </div>
                  </div>

                  <div class="col-md-12 ">
                    <div class="form-group mb-3">
                      <label for="auth_given_by" class="form-label">3. Auth given by (ref of the ltr/msg)</label>
                      <input id="auth_given_by" name="auth_given_by" type="text" placeholder="" class="form-control" value="@if (isset($auth_given_by)){{ $auth_given_by }}@endif">
                    </div>
                  </div>

                  <div class="col-md-12 ">
                    <div class="form-group mb-3">
                      <label for="transport_date" class="form-label">4. Date of transportation</label>
                      <input name="transport_date" class="transport_date form-control" id="transport_date" type="text" value="@if (isset($transport_date)){{ $transport_date }}@endif">
                      <script>
                          var today_date = new Date();
                          var dd = String(today_date.getDate()).padStart(2, '0');
                          var mm = String(today_date.getMonth() + 1).padStart(2, '0');
                          var yyyy = today_date.getFullYear();

                          const picker = MCDatepicker.create({
                              el: '#transport_date',
                              dateFormat: 'yyyy-mm-dd',
                              theme: {
                                  theme_color: '#000024'
                              },
                              minDate: new Date(yyyy, mm-1, dd),
                              jumpOverDisabled: false,
                          });
                      </script>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="col-md-6 m-0 float-left pl-0">
                      <div class="form-group">
                        <label for="location_from" class="form-label">5. Location to be transported : (From)</label>
                        <select name="location_from" class="selectpicker form-control" id="location_from" data-container="body" data-live-search="true" title="Select the Location" data-hide-disabled="true">
                            {{--@if (isset($location_from))--}}
                              {{--@foreach($organizations as $org)--}}
                                {{--<option value="{{$org->id}}" @if($org->id == $location_from) selected @endif>{{$org->organization}}</option>--}}
                              {{--@endforeach--}}
                            {{--@else --}}
                              {{--@foreach($organizations as $org)--}}
                                {{--<option value="{{$org->id}}">{{$org->organization}}</option>--}}
                              {{--@endforeach--}}
                            {{--@endif--}}
                            <option selected="selected" value="{{$thisOrg[0]->id}}">{{$thisOrg[0]->organization}}</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6 m-0 float-left pr-0">
                      <div class="form-group">
                        <label for="location_to" class="form-label">(To)</label>
                        <select name="location_to" class="selectpicker form-control" id="location_to" data-container="body" data-live-search="true" title="Select the Location" data-hide-disabled="true">
                            @if (isset($location_to))
                              @foreach($organizations as $org)
                                <option value="{{$org->id}}" @if($org->id == $location_to) selected @endif>{{$org->organization}}</option>
                              @endforeach
                            @else 
                              @foreach($organizations as $org)
                                <option value="{{$org->id}}">{{$org->organization}}</option>
                              @endforeach
                            @endif
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-12 ">
                    <div class="form-group mb-3">
                      <label for="route" class="form-label">6. Route</label>
                      <input id="route" name="route" type="text" placeholder="" class="form-control" value="@if (isset($route)){{ $route }}@endif">
                    </div>
                  </div>

                  <div class="col-md-12 ">
                    <div class="form-group mb-3">
                      <label for="no_of_wpn" class="form-label">7. No of wpn, ammo and explosives</label>
                      <input id="no_of_wpn" name="no_of_wpn" type="number" placeholder="" class="form-control" value="@if (isset($no_of_wpn)){{ $no_of_wpn }}@endif">
                    </div>
                  </div>

                  <div class="col-md-12 ">
                    <div class="form-group mb-3">
                      <label for="wpn_details" class="form-label">Wpn details (wpn nos)</label>
                        <input type="hidden" id="selected_weapon" value="{{isset($wpn_details)?$wpn_details:''}}">
                            <select name="wpn_details[]" class="form-control" id="wpn_details" data-container="body"
                                  multiple="multiple"  data-live-search="true" title="Select the Escort Name" data-hide-disabled="true">

                        </select>
                    </div>
                      <div class="button-container mt-2 mb-2">
                          <button type="button" class="btn btn-outline-dark" id="selectAll">Select All</button>
                          <button type="button" class="btn btn-outline-dark" id="deselectAll">Deselect All
                          </button>
                      </div>
                  </div>

                  <div class="col-md-12">
                    <div class="col-md-6 m-0 float-left pl-0">
                      <div class="form-group">
                        <label for="type_of_veh" class="form-label">8. (i) Type of vehicle</label>
                        <select name="type_of_veh" class="selectpicker form-control" id="type_of_veh" data-container="body" data-live-search="true" title="Select the Type of Vehicle" data-hide-disabled="true">
                            @if (isset($type_of_veh))
                              @foreach($vehicle_types as $veh)
                                <option value="{{$veh->vehicle}}" @if($veh->vehicle == $type_of_veh) selected @endif>{{$veh->vehicle}}</option>
                              @endforeach
                            @else 
                              @foreach($vehicle_types as $veh)
                                <option value="{{$veh->vehicle}}">{{$veh->vehicle}}</option>
                              @endforeach
                            @endif
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6 m-0 float-left pr-0">
                      <div class="form-group">
                        <label for="vehicle_no" class="form-label">(ii) Vehicle No</label>
                        <input id="vehicle_no" name="vehicle_no" type="text" placeholder="" class="form-control" value="@if (isset($vehicle_no)){{ $vehicle_no }}@endif">
                      </div>
                    </div>
                  </div>

                  <div class="col-md-12 ">
                    <div class="form-group mb-3">
                      <label for="driver" class="form-label">9. Driver</label>
                        <input type="hidden" id="selected_driver" value="{{isset($driver)?$driver:''}}">
                      <select name="driver[]" multiple="multiple" class="form-control" id="driver" data-container="body" data-live-search="true" title="Select the Driver Name" data-hide-disabled="true">
                            {{--@if (isset($driver))--}}
                              {{--@foreach($organization_users as $user)--}}

                                {{--@if (substr($user->service_no, 0, 1) === 'S')--}}
                                  {{--<option value="{{$user->service_no}}" @if($user->service_no == $driver) selected @endif>{{$user->service_no}} {{$user->full_name}}</option>--}}
                                {{--@endif--}}

                              {{--@endforeach--}}
                            {{--@else --}}
                              {{--@foreach($organization_users as $user)--}}

                                {{--@if (substr($user->service_no, 0, 1) === 'S')--}}
                                  {{--<option value="{{$user->service_no}}">{{$user->service_no}} {{$user->full_name}}</option>--}}
                                {{--@endif--}}

                              {{--@endforeach--}}
                            {{--@endif--}}
                        </select>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group mb-3">
                      <label for="escort" class="form-label">10. Escort</label>
                        <input type="hidden" id="selected_escort" value="{{isset($escort)?$escort:''}}">
                      <select name="escort[]" class="form-control" id="escort" data-container="body"
                              multiple="multiple" data-live-search="true" title="Select the Escort Name" data-hide-disabled="true">
                            {{--@if (isset($escort))--}}
                              {{--@foreach($organization_users as $user)--}}

                                {{--@if (substr($user->service_no, 0, 1) === 'S')--}}
                                  {{--<option value="{{$user->service_no}}" @if($user->service_no == $escort) selected @endif>{{$user->service_no}} {{$user->full_name}}</option>--}}
                                {{--@endif--}}

                              {{--@endforeach--}}
                            {{--@else --}}
                              {{--@foreach($organization_users as $user)--}}

                                {{--@if (substr($user->service_no, 0, 1) === 'S')--}}
                                  {{--<option value="{{$user->service_no}}">{{$user->service_no}} {{$user->full_name}}</option>--}}
                                {{--@endif--}}

                              {{--@endforeach--}}
                            {{--@endif--}}
                        </select>
                    </div>
                  </div>

                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="escort_weapon_no" class="form-label">11. (i) Escort weapon no</label>
                          <input type="hidden" id="escort_weapon" value="{{isset($escort_weapon_no)?$escort_weapon_no:''}}">
                        {{--<input id="" name="escort_weapon_no" type="text" placeholder="" class="form-control" value="@if (isset($escort_weapon_no)){{ $escort_weapon_no }}@endif">--}}
                          <select name="escort_weapon_no[]" class="form-control" id="escort_weapon_no" data-container="body"
                                  multiple="multiple" data-live-search="true" title="Select the Escort Name" data-hide-disabled="true">
                          </select>
                      </div>
                    </div>
                   <div class="col-md-12">
                       <div class="col-md-6 m-0 float-left pl-0">
                           <div class="form-group">
                               <label for="no_of_magazins" class="form-label">(ii) No of magazins</label>
                               <input id="no_of_magazins" name="no_of_magazins" type="number" placeholder="" class="form-control" value="@if (isset($no_of_magazins)){{ $no_of_magazins }}@endif">
                           </div>
                       </div>
                       <div class="col-md-6 m-0 float-left pl-0">
                           <div class="form-group">
                               <label for="no_of_ammo" class="form-label">(iii) Ammo</label>
                               <input id="no_of_ammo" name="no_of_ammo" type="number" placeholder="" class="form-control" value="@if (isset($no_of_ammo)){{ $no_of_ammo }}@endif">
                           </div>
                       </div>
                   </div>

                  <div class="col-md-12 ">
                    <div class="form-group mb-3">
                      <label for="ref_of_ltr1" class="form-label">12. If wpn and ammo/explosives are stationed at night, ref of the ltr/msg</label>
                      <input id="ref_of_ltr1" name="ref_of_ltr1" type="text" placeholder="" class="form-control" value="@if (isset($ref_of_ltr1)){{ $ref_of_ltr1 }}@endif">
                    </div>
                  </div>

                  <div class="col-md-12 ">
                    <div class="form-group mb-3">
                      <label for="att1" class="form-label">13. Docs att (Q5/AFG 3-copy no 4/ AFG 2) (PDF Format)</label>
                      <input id="att1" name="att1" type="file" placeholder="" class="form-control" value="">
                    </div>
                  </div>


                  <div class="col-md-12 ">
                    <div class="form-group mb-3">
                      <label for="ref_of_ltr2" class="form-label">14. Ref of ltr/msg of "hiring auth to the Ay" for veh which use civil no plates</label>
                      <input id="ref_of_ltr2" name="ref_of_ltr2" type="text" placeholder="" class="form-control" value="@if (isset($no_of_magazins)){{ $no_of_magazins }}@endif">
                    </div>
                  </div>

                  <div class="col-md-12 ">
                    <div class="form-group mb-3">
                      <label for="att2" class="form-label">15. Any other relevant docs att (PDF Format)</label>
                      <input id="att2" name="att2" type="file" placeholder="" class="form-control" value="-">
                    </div>
                  </div>


                  <div class="col-md-12 ">
                    <div class="form-group mb-3">
                      <label for="request_forward_by" class="form-label">16. Request Forward by</label>
                      <select name="request_forward_by" class="selectpicker form-control" id="request_forward_by"
                              data-container="body" title="Select the Org Name" data-hide-disabled="true">
                          {{--@if (isset($req_fwd_by))--}}
                            {{--@foreach($organization_types as $type)--}}

                                {{--@if (!in_array($type->id, [1,2,5,8,11,17]))--}}
                                    {{--<option value="{{$type->id}}" @if($type->id == $req_fwd_by) selected @endif>{{$type->name}}</option>--}}
                                {{--@endif--}}
                            {{----}}
                            {{--@endforeach--}}
                          {{--@else --}}
                            {{--@foreach($organization_types as $type)--}}

                                {{--@if (!in_array($type->id, [1,2,5,8,11,17]))--}}
                                    {{--<option value="{{$type->id}}">{{$type->name}}</option>--}}
                                {{--@endif--}}

                            {{--@endforeach--}}
                          {{--@endif--}}
                          <option selected="selected"
                                  value="{{$loggedInUSer[0]->userId}}">{{$loggedInUSer[0]->userName}}
                              - {{ $loggedInUSer[0]->userAppointment}}</option>
                      </select>
                    </div>
                  </div>


                  <div class="col-md-12 ">
                    <div class="form-group mb-3">
                      <label for="request_forward_to" class="form-label">17. Request Forward to</label>
                      <select name="request_forward_to" class="selectpicker form-control" id="request_forward_to" data-container="body" data-live-search="true" title="Select the Org Name" data-hide-disabled="true">
                          {{--@if (isset($req_fwd_to))--}}
                            {{--@foreach($organization_types as $type)--}}

                                {{--@if (!in_array($type->id, [1,2,5,8,11,17]))--}}
                                    {{--<option value="{{$type->id}}" @if($type->id == $req_fwd_to) selected @endif>{{$type->name}}</option>--}}
                                {{--@endif--}}
                            {{----}}
                            {{--@endforeach--}}
                          {{--@else --}}
                            {{--@foreach($organization_types as $type)--}}

                                {{--@if (!in_array($type->id, [1,2,5,8,11,17]))--}}
                                    {{--<option value="{{$type->id}}">{{$type->name}}</option>--}}
                                {{--@endif--}}

                            {{--@endforeach--}}
                          {{--@endif--}}
                          @foreach($orgAppointments as $orgAppointment)
                              <option selected="{{isset($req_fwd_to)? ($req_fwd_to==$orgAppointment->userId)?'selected':'':''}}"
                                      value="{{$orgAppointment->userId}}">{{$orgAppointment->userName}}
                                  - {{ $orgAppointment->userAppointment}}</option>
                          @endforeach
                      </select>
                    </div>
                  </div>            

                  <div class="col-md-12">
                    <div class="alert alert-danger" role="alert"></div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group text-right">
                      <button id="create_event_bill" type="submit" class="btn btn-primary">Submit</button>
                    </div>
                  </div>

           

                </div>

            </section>
          </div>

          </form>


      </div>
    </section>

  </div>

  <footer class="main-footer">
    @include('inc/footer')
  </footer>


</div>

@include('inc/footer_assets')

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>


$(document).ready(function() {


    //API Data

    $('#selectAll').on('click', function () {
        selectAll()
    });
    $('#deselectAll').on('click', function () {
        deselectAll()
    });
    function selectAll() {
        $("#wpn_details > option").prop("selected", true);
        $("#wpn_details").trigger("change");
    }
    function deselectAll() {
        $("#wpn_details > option").prop("selected", false);
        $("#wpn_details").trigger("change");
    }

    let estbApiID = $('#org_api_id').val();
    let armouryId = $('#armory_api_id').val();

    //Officers
    $.ajax({
        url: 'https://172.16.60.51/beta/api/get_estab_persons/?id=' + estbApiID + '&type=1',
        method: 'GET',
        cache: false,
        async: false,
        dataType: 'json',
        data: {
            "str-token": "1189d8dde195a36a9c4a721a390a74e6"
        },
        success: function (data) {

            var offcrStrengthArray = [];
            $.each(data, function (id, name) {
                offcrStrengthArray.push({id: name.e_no, text: name.abb_rank + ' - ' + name.name});
            });
            $('#incharge').select2({
                data: offcrStrengthArray,
                // placeholder: "Select an Officer",
            });

            $selected_incharge = $('#selected_incharge').val();
            $('#incharge').val($selected_incharge).trigger('change');
        },
        error: function (e) {
            // console.log(e)
        }
    });
    //OR's
    $.ajax({
        url: 'https://172.16.60.51/beta/api/get_estab_persons/?id=' + estbApiID + '&type=2',
        method: 'GET',
        cache: false,
        async: false,
        dataType: 'json',
        data: {
            "str-token": "1189d8dde195a36a9c4a721a390a74e6"
        },
        success: function (data) {
            var orStrengthArray = [];
            $.each(data, function (id, name) {
                orStrengthArray.push({id: name.e_no, text: name.abb_rank + ' - ' + name.name});
            });
            $('#escort').select2({
                data: orStrengthArray,
                placeholder: "Select an OR",
            });

            $('#driver').select2({
                data: orStrengthArray,
                placeholder: "Select an OR",
            });


            $selected_escort = JSON.parse($('#selected_escort').val());
            $('#escort').val($selected_escort).trigger('change');

            $selected_driver = JSON.parse($('#selected_driver').val());
            $('#driver').val($selected_driver).trigger('change');
        },
        error: function (e) {
            // console.log(e)
        }
    });
    //weapons
    $.ajax({
        url: 'http://10.7.113.86/wims/api/location_wpn/get_location_wpn.php?id=' + armouryId,
        method: 'GET',
        cache: false,
        dataType: 'json',
        // data: {
        //     "str-token": "1189d8dde195a36a9c4a721a390a74e6"
        // },
        success: function (data) {
            var weaponArray = [];
            // console.log(data)
            $.each(data.data, function (id, name) {
                weaponArray.push({
                    id:  name.current_wpn_number + ' ; ' + name.wpn_name,
                    text: name.current_wpn_number + ' - ' + name.wpn_name
                });
            });
            $('#wpn_details').select2({
                data: weaponArray,
                placeholder: "Select weapons"
            });
            $('#escort_weapon_no').select2({
                data: weaponArray,
                placeholder: "Select weapons"
            });

            $selected_weapon = JSON.parse($('#selected_weapon').val());
            $('#wpn_details').val($selected_weapon).trigger('change');

            $escort_weapon = JSON.parse($('#escort_weapon').val());
            $('#escort_weapon_no').val($escort_weapon).trigger('change');
        },
        error: function (e) {
            // console.log(e)
        }
    });


    //END API DATA

    $('.alert-danger').hide()

    parameter_id = '{{$id}}' // id value in url parameter

    $("form").submit(function (event) {
        event.preventDefault(); 

        var insert_or_update = null
        if (parameter_id != '') { // has parameter // update page
          insert_or_update = 'update'
        }
        else{ // no parameter // insert page
          insert_or_update = 'insert'
        }

        var formData = new FormData(this); // Create a new FormData object
        formData.append('parameter_id', parameter_id); // Add id value in url parameter
        formData.append('insert_or_update', insert_or_update); // Add id value in url parameter
    
        $.ajax({
          url:"{{ url('') }}/auth_req_ltr_weapons_form_func",
            type: 'POST',
            data: formData,
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
              if (data.status == 0) { // save success
                  $('.alert-danger').hide()
                  if (insert_or_update == 'insert') {

                    // $('#req_made_location').selectpicker('val', '');
                    // $('#reason').val('');
                    // $('#no_of_troops').val('');
                    // $('#transport_date').val('');
                    // $('#location_from').selectpicker('val', '');
                    // $('#location_to').selectpicker('val', '');
                    // $('#auth_given_by').val('');
                    // $('#route').val('');
                    // $('#type_of_veh').selectpicker('val', '');
                    // $('#no_of_seat').val('');
                    // $('#convoy').selectpicker('val', '');
                    // $('#escort').selectpicker('val', '');
                    // $('#escort_weapon_no').val('');
                    // $('#no_of_magazins').val('');
                    // $('#no_of_ammo').val('');
                    // $('#driver').selectpicker('val', '');
                    // $('#measures_taken').val('');
                    // $('#ref_of_ltr').val('');
                    // $('#request_forward_by').selectpicker('val', '');
                    // $('#request_forward_to').selectpicker('val', '');           

                    Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      title: 'Authority Request Created Successfully',
                      showConfirmButton: false,
                      timer: 2500
                    })
                  }
                  else{
                    Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      title: 'Authority Request Updated Successfully',
                      showConfirmButton: false,
                      timer: 2500
                    })
                  }         
              }
              else{ // validation error

                  var error_list = '<ul>';
                  $.each(data.errors, function(key, value) {
                      error_list += '<li>' + value + '</li>';
                  });
                  error_list += '</ul>';

                  $('.alert-danger').show()
                  $('.alert-danger').html(error_list)

              }
            },
            error: function(xhr, status, error) {

            }
        });
    });
});
</script>


</body>
</html>
