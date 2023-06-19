<!DOCTYPE html>
<html lang="en">
<head>
  @include('inc/header')
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
            <h1>Create Authority Request (Weapon & Ammo/Explosive) </h1>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">

          <form class="form" action="#">
            
          <div class="row">

            <section class="col-lg-12 connectedSortable ui-sortable">
             
              <div class="card auth_req_lttr_form">
                  
                  <div class="col-md-12 ">
                      <div class="form-group mb-3">
                      <label for="req_made_location" class="form-label">1. Request made by (location)</label>
                        <select class="selectpicker form-control" id="req_made_location" data-container="body" data-live-search="true" title="Select the Location" data-hide-disabled="true">
                            @if (isset($request_made_by))
                              @foreach($organizations as $org)
                                <option value="{{$org->id}}" @if($org->id == $request_made_by) selected @endif>{{$org->organization}}</option>
                              @endforeach
                            @else 
                              @foreach($organizations as $org)
                                <option value="{{$org->id}}">{{$org->organization}}</option>
                              @endforeach
                            @endif
                        </select>
                    </div>
                  </div>

                  <div class="col-md-12 ">
                    <div class="form-group mb-3">
                      <label for="incharge" class="form-label">2. In charge Offr</label>
                      <select class="selectpicker form-control" id="incharge" data-container="body" data-live-search="true" title="Select the In charge Offr" data-hide-disabled="true">
                            @if (isset($incharge))
                              @foreach($organization_users as $user)

                                  @if (substr($user->service_no, 0, 1) === 'O')
                                    <option value="{{$user->service_no}}" @if($user->service_no == $incharge) selected @endif>{{$user->service_no}} {{$user->full_name}}</option>
                                  @endif          

                              @endforeach
                            @else 
                              @foreach($organization_users as $user)

                                  @if (substr($user->service_no, 0, 1) === 'O')
                                    <option value="{{$user->service_no}}">{{$user->service_no}} {{$user->full_name}}</option>
                                  @endif 
                                
                              @endforeach
                            @endif
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
                      <input class="transport_date form-control" id="transport_date" type="text" value="@if (isset($transport_date)){{ $transport_date }}@endif">
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
                        <select class="selectpicker form-control" id="location_from" data-container="body" data-live-search="true" title="Select the Location" data-hide-disabled="true">
                            @if (isset($location_from))
                              @foreach($organizations as $org)
                                <option value="{{$org->id}}" @if($org->id == $location_from) selected @endif>{{$org->organization}}</option>
                              @endforeach
                            @else 
                              @foreach($organizations as $org)
                                <option value="{{$org->id}}">{{$org->organization}}</option>
                              @endforeach
                            @endif
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6 m-0 float-left pr-0">
                      <div class="form-group">
                        <label for="location_to" class="form-label">(To)</label>
                        <select class="selectpicker form-control" id="location_to" data-container="body" data-live-search="true" title="Select the Location" data-hide-disabled="true">
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
                      <input id="no_of_wpn" name="no_of_wpn" type="text" placeholder="" class="form-control" value="@if (isset($no_of_wpn)){{ $no_of_wpn }}@endif">
                    </div>
                  </div>

                  <div class="col-md-12 ">
                    <div class="form-group mb-3">
                      <label for="wpn_details" class="form-label">Wpn details (wpn nos)</label>
                      <textarea id="wpn_details" name="wpn_details" class="form-control"  rows="3">@if (isset($wpn_details)){{ $wpn_details }}@endif</textarea>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="col-md-6 m-0 float-left pl-0">
                      <div class="form-group">
                        <label for="type_of_veh" class="form-label">8. (i) Type of vehicle</label>
                        <select class="selectpicker form-control" id="type_of_veh" data-container="body" data-live-search="true" title="Select the Type of Vehicle" data-hide-disabled="true">
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
                      <select class="selectpicker form-control" id="driver" data-container="body" data-live-search="true" title="Select the Driver Name" data-hide-disabled="true">
                            @if (isset($driver))
                              @foreach($organization_users as $user)

                                @if (substr($user->service_no, 0, 1) === 'S')
                                  <option value="{{$user->service_no}}" @if($user->service_no == $driver) selected @endif>{{$user->service_no}} {{$user->full_name}}</option>
                                @endif

                              @endforeach
                            @else 
                              @foreach($organization_users as $user)

                                @if (substr($user->service_no, 0, 1) === 'S')
                                  <option value="{{$user->service_no}}">{{$user->service_no}} {{$user->full_name}}</option>
                                @endif

                              @endforeach
                            @endif
                        </select>
                    </div>
                  </div>

                  <div class="col-md-12 ">
                    <div class="form-group mb-3">
                      <label for="escort" class="form-label">10. Escort</label>
                      <select class="selectpicker form-control" id="escort" data-container="body" data-live-search="true" title="Select the Escort Name" data-hide-disabled="true">
                            @if (isset($escort))
                              @foreach($organization_users as $user)

                                @if (substr($user->service_no, 0, 1) === 'S')
                                  <option value="{{$user->service_no}}" @if($user->service_no == $escort) selected @endif>{{$user->service_no}} {{$user->full_name}}</option>
                                @endif

                              @endforeach
                            @else 
                              @foreach($organization_users as $user)

                                @if (substr($user->service_no, 0, 1) === 'S')
                                  <option value="{{$user->service_no}}">{{$user->service_no}} {{$user->full_name}}</option>
                                @endif

                              @endforeach
                            @endif
                        </select>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="col-md-4 m-0 float-left pl-0">
                      <div class="form-group">
                        <label for="escort_weapon_no" class="form-label">11. (i) Escort weapon no</label>
                        <input id="escort_weapon_no" name="escort_weapon_no" type="text" placeholder="" class="form-control" value="@if (isset($escort_weapon_no)){{ $escort_weapon_no }}@endif">
                      </div>
                    </div>
                    <div class="col-md-4 m-0 float-left">
                      <div class="form-group">
                        <label for="no_of_magazins" class="form-label">(ii) No of magazins</label>
                        <input id="no_of_magazins" name="no_of_magazins" type="text" placeholder="" class="form-control" value="@if (isset($no_of_magazins)){{ $no_of_magazins }}@endif">
                      </div>
                    </div>
                    <div class="col-md-4 m-0 float-left pr-0">
                      <div class="form-group">
                        <label for="no_of_ammo" class="form-label">(iii) Ammo</label>
                        <input id="no_of_ammo" name="no_of_ammo" type="text" placeholder="" class="form-control" value="@if (isset($no_of_ammo)){{ $no_of_ammo }}@endif">
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
                      <label for="request_forward" class="form-label">16. Request Forward to</label>
                      <select name="request_forward" class="selectpicker form-control" id="request_forward" data-container="body" data-live-search="true" title="Select the Org Name" data-hide-disabled="true">
                        </select>
                    </div>
                  </div>             

                  <div class="col-md-12">
                    <div class="alert alert-success" role="alert"></div>
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

<script>

    $('.alert-success').hide()
    $('.alert-danger').hide()

    $("form").submit(function (event) {

        var req_made_location = $("#req_made_location").val();
        var incharge = $("#incharge").val();
        var auth_given_by = $("#auth_given_by").val();
        var transport_date = $("#transport_date").val();
        var location_from = $("#location_from").val();
        var location_to = $("#location_to").val();
        var route = $("#route").val();
        var no_of_wpn = $("#no_of_wpn").val();
        var wpn_details = $("#wpn_details").val();
        var type_of_veh = $("#type_of_veh").val();
        var vehicle_no = $("#vehicle_no").val();
        var driver = $("#driver").val();
        var escort = $("#escort").val();
        var escort_weapon_no = $("#escort_weapon_no").val();
        var no_of_magazins = $("#no_of_magazins").val();
        var no_of_ammo = $("#no_of_ammo").val();
        var ref_of_ltr1 = $("#ref_of_ltr1").val();
        var att1 = $("#att1").val();
        var ref_of_ltr2 = $("#ref_of_ltr2").val();
        var att2 = $("#att2").val();
        
        // var lname = $("#lname").val();
        // var email = $("#email").val(); 

        // if ($("#country").val() == "Select country") { 
        //     //alert('Select Country');  
        // }
        // els

        // var mobile = $("#country_code").val() + $("#mobile").val(); 
        // var password = $("#password").val(); 

        $.ajax({
            type: "POST",
            url:"{{ url('') }}/auth_req_ltr_weapon_form_func",
            data: { "_token": "{{ csrf_token() }}" , req_made_location:req_made_location , incharge:incharge , auth_given_by:auth_given_by , transport_date:transport_date , location_from:location_from , location_to:location_to , route:route , no_of_wpn:no_of_wpn , wpn_details:wpn_details , type_of_veh:type_of_veh , vehicle_no:vehicle_no , driver:driver , escort:escort , escort_weapon_no:escort_weapon_no , no_of_magazins:no_of_magazins , no_of_ammo:no_of_ammo , ref_of_ltr1:ref_of_ltr1 , att1:att1 , ref_of_ltr2:ref_of_ltr2 , att2:att2 },
            dataType: "json",
            encode: true,
        }).done(function (data) {

            if (data.status == 0) { // save success
                $('.alert-success').show()
                $('.alert-success').html('Authority Request Created Successfully')
                $('.alert-danger').hide()
                setTimeout(hideMsg, 2500);
                function hideMsg() { 
                    $('.alert-success').fadeOut()
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


      
        });
        event.preventDefault();

    });

</script>


</body>
</html>
