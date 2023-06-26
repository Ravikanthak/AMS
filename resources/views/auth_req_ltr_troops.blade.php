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
            <h1>Create Authority Request (Troops Transportation) </h1>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">

          <form class="form" enctype="multipart/form-data" action="#" >
          @csrf
          <div class="row">

            <section class="col-lg-12 connectedSortable ui-sortable">
             
              <div class="card auth_req_lttr_form">
                  
                  <div class="col-md-12 ">
                      <div class="form-group mb-3">
                      <label for="req_made_location" class="form-label">1. Request made by (location)</label>
                        <select name="req_made_location" class="selectpicker form-control" id="req_made_location" data-container="body" data-live-search="true" title="Select the Location" data-hide-disabled="true">
                            @if (isset($request_made_by_id))
                              @foreach($organizations as $org)
                                <option value="{{$org->id}}" @if($org->id == $request_made_by_id) selected @endif>{{$org->organization}}</option>
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
                      <label for="reason" class="form-label">2. Reason for transportation</label>
                      <input id="reason" name="reason" type="text" placeholder="" class="form-control" value="@if (isset($reason)){{ $reason }}@endif">
                    </div>
                  </div>

                  <div class="col-md-12 ">
                    <div class="form-group mb-3">
                      <label for="no_of_troops" class="form-label">3. No of troops to be transported</label>
                      <input id="no_of_troops" name="no_of_troops" type="number" placeholder="" class="form-control" value="@if (isset($no_of_troops)){{ $no_of_troops }}@endif">
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
                      <label for="auth_given_by" class="form-label">6. Auth given by (ref of the ltr/msg)</label>
                      <input id="auth_given_by" name="auth_given_by" type="text" placeholder="" class="form-control" value="@if (isset($auth_given_by)){{ $auth_given_by }}@endif">
                    </div>
                  </div>

                  <div class="col-md-12 ">
                    <div class="form-group mb-3">
                      <label for="route" class="form-label">7. Route</label>
                      <input id="route" name="route" type="text" placeholder="" class="form-control" value="@if (isset($route)){{ $route }}@endif">
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="col-md-6 m-0 float-left pl-0">
                      <div class="form-group">
                        <label for="type_of_veh" class="form-label">8. (i) Type of vehicle</label>
                        <select name="type_of_veh" class="selectpicker form-control" id="type_of_veh" data-container="body" data-live-search="true" title="Select the Type of Vehicle" data-hide-disabled="true">
                            @if (isset($vehicle_type_name))
                              @foreach($vehicle_types as $veh)
                                <option value="{{$veh->vehicle}}" @if($veh->vehicle == $vehicle_type_name) selected @endif>{{$veh->vehicle}}</option>
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
                        <label for="no_of_seat" class="form-label">(ii) No of seat available</label>
                        <input id="no_of_seat" name="no_of_seat" type="number" placeholder="" class="form-control" value="@if (isset($no_of_seat)){{ $no_of_seat }}@endif">
                      </div>
                    </div>
                  </div>

                  <div class="col-md-12 ">
                    <div class="form-group mb-3">
                      <label for="convoy" class="form-label">9. Vehicle/Convoy comd name</label>
                      <select name="convoy" class="selectpicker form-control" id="convoy" data-container="body" data-live-search="true" title="Select the Vehicle/Convoy Comd Name" data-hide-disabled="true">
                            @if (isset($convoy_comd))
                              @foreach($organization_users as $user)

                                  @if (substr($user->service_no, 0, 1) === 'O')
                                    <option value="{{$user->service_no}}" @if($user->service_no == $convoy_comd) selected @endif>{{$user->service_no}} {{$user->full_name}}</option>
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
                      <label for="escort" class="form-label">10. Escort name</label>
                      <select name="escort" class="selectpicker form-control" id="escort" data-container="body" data-live-search="true" title="Select the Escort Name" data-hide-disabled="true">
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
                        <input id="no_of_magazins" name="no_of_magazins" type="number" placeholder="" class="form-control" value="@if (isset($no_of_magazins)){{ $no_of_magazins }}@endif">
                      </div>
                    </div>
                    <div class="col-md-4 m-0 float-left pr-0">
                      <div class="form-group">
                        <label for="no_of_ammo" class="form-label">(iii) Ammo</label>
                        <input id="no_of_ammo" name="no_of_ammo" type="number" placeholder="" class="form-control" value="@if (isset($no_of_ammo)){{ $no_of_ammo }}@endif">
                      </div>
                    </div>
                  </div>

                  <div class="col-md-12 ">
                    <div class="form-group mb-3">
                      <label for="driver" class="form-label">12. Driver name</label>
                      <select name="driver" class="selectpicker form-control" id="driver" data-container="body" data-live-search="true" title="Select the Driver Name" data-hide-disabled="true">
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
                      <label for="measures_taken" class="form-label">13. Measures taken for the sy of tps to be transported</label>
                      <input id="measures_taken" name="measures_taken" type="text" placeholder="" class="form-control" value="@if (isset($measures)){{ $measures }}@endif">
                    </div>
                  </div>

                  <div class="col-md-12 ">
                    <div class="form-group mb-3">
                      <label for="ref_of_ltr" class="form-label">14. Ref of ltr/msg of "hiring auth to the Ay" for veh which use civil no plates</label>
                      <input id="ref_of_ltr" name="ref_of_ltr" type="text" placeholder="" class="form-control" value="@if (isset($ref_of_ltr)){{ $ref_of_ltr }}@endif">
                    </div>
                  </div>

                  <div class="col-md-12 ">
                    <div class="form-group mb-3">
                      <label for="image" class="image form-label">15. Any other relevant docs att <span>(PDF, JPEG, JPG, PNG | Maximum File Size 2MB)</span></label>
                      <input id="image" name="image" type="file" placeholder="" class="form-control" value="">
                    </div>
                  </div>
                  <div class="col-md-12 ">
                    <div class="form-group mb-3">
                        @if (isset($attachment))
                          <div class="uploaded_file">
                            <img src="{{asset('')}}img/attachment.png" alt="">
                            <a href="{{asset('')}}uploads/{{$attachment}}" target="_blank" class="btn btn-success">View Attachment</a>
                          </div>
                        @endif
                    </div>
                  </div>
                  

                  <div class="col-md-12 ">
                    <div class="form-group mb-3">
                      <label for="request_forward_by" class="form-label">16. Request Forward by</label>
                      <select name="request_forward_by" class="selectpicker form-control" id="request_forward_by" data-container="body" data-live-search="true" title="Select the Org Name" data-hide-disabled="true">
                          @if (isset($req_fwd_by))
                            @foreach($organization_types as $type)

                                @if (!in_array($type->id, [1,2,5,8,11,17]))
                                    <option value="{{$type->id}}" @if($type->id == $req_fwd_by) selected @endif>{{$type->name}}</option>
                                @endif
                            
                            @endforeach
                          @else 
                            @foreach($organization_types as $type)

                                @if (!in_array($type->id, [1,2,5,8,11,17]))
                                    <option value="{{$type->id}}">{{$type->name}}</option>
                                @endif

                            @endforeach
                          @endif
                      </select>
                    </div>
                  </div>


                  <div class="col-md-12 ">
                    <div class="form-group mb-3">
                      <label for="request_forward_to" class="form-label">17. Request Forward to</label>
                      <select name="request_forward_to" class="selectpicker form-control" id="request_forward_to" data-container="body" data-live-search="true" title="Select the Org Name" data-hide-disabled="true">
                          @if (isset($req_fwd_to))
                            @foreach($organization_types as $type)

                                @if (!in_array($type->id, [1,2,5,8,11,17]))
                                    <option value="{{$type->id}}" @if($type->id == $req_fwd_to) selected @endif>{{$type->name}}</option>
                                @endif
                            
                            @endforeach
                          @else 
                            @foreach($organization_types as $type)

                                @if (!in_array($type->id, [1,2,5,8,11,17]))
                                    <option value="{{$type->id}}">{{$type->name}}</option>
                                @endif

                            @endforeach
                          @endif
                      </select>
                    </div>
                  </div>





                  <div class="col-md-12">
                    <div class="alert alert-danger" role="alert"></div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group text-right">
                      <button id="auth_req_lttr_troops_submit_btn" type="submit" class="btn btn-primary">Submit</button>
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

$(document).ready(function() {

    $('.alert-danger').hide()

    parameter_id = '{{$id}}' // id value in url parameter

    $('form').submit(function(event) {
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
          url:"{{ url('') }}/auth_req_ltr_troops_form_func",
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

                    $('#req_made_location').selectpicker('val', '');
                    $('#reason').val('');
                    $('#no_of_troops').val('');
                    $('#transport_date').val('');
                    $('#location_from').selectpicker('val', '');
                    $('#location_to').selectpicker('val', '');
                    $('#auth_given_by').val('');
                    $('#route').val('');
                    $('#type_of_veh').selectpicker('val', '');
                    $('#no_of_seat').val('');
                    $('#convoy').selectpicker('val', '');
                    $('#escort').selectpicker('val', '');
                    $('#escort_weapon_no').val('');
                    $('#no_of_magazins').val('');
                    $('#no_of_ammo').val('');
                    $('#driver').selectpicker('val', '');
                    $('#measures_taken').val('');
                    $('#ref_of_ltr').val('');
                    $('#request_forward_by').selectpicker('val', '');
                    $('#request_forward_to').selectpicker('val', '');           

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
