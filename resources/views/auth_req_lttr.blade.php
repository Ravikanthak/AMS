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
  
  
  
  <div class="content-wrapper">

    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Create Authority Request</h1>
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
                            <option value="dit">DIT</option>
                            <option value="10-slsc">10 SLSC</option>
                            <option selected value="11-slsc">11 SLSC</option>
                            <option value="12-slsc">12 SLSC</option>
                        </select>
                    </div>
                  </div>

                  <div class="col-md-12 ">
                    <div class="form-group mb-3">
                      <label for="reason" class="form-label">2. Reason for transportation</label>
                      <input id="reason" name="reason" type="text" placeholder="" class="form-control" value="Troops allocate">
                    </div>
                  </div>

                  <div class="col-md-12 ">
                    <div class="form-group mb-3">
                      <label for="no_of_troops" class="form-label">3. No of troops to be transported</label>
                      <input id="no_of_troops" name="no_of_troops" type="number" placeholder="" class="form-control" value="31">
                    </div>
                  </div>

                  <div class="col-md-12 ">
                    <div class="form-group mb-3">
                      <label for="transport_date" class="form-label">4. Date of transportation</label>
                      <input class="transport_date form-control" id="transport_date" type="text" value="2023-04-11">
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
                            <option value="dit">DIT</option>
                            <option value="10-slsc">10 SLSC</option>
                            <option selected value="11-slsc">11 SLSC</option>
                            <option value="12-slsc">12 SLSC</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6 m-0 float-left pr-0">
                      <div class="form-group">
                        <label for="location_to" class="form-label">(To)</label>
                        <select class="selectpicker form-control" id="location_to" data-container="body" data-live-search="true" title="Select the Location" data-hide-disabled="true">
                            <option value="dit">DIT</option>
                            <option value="10-slsc">10 SLSC</option>
                            <option value="11-slsc">11 SLSC</option>
                            <option value="12-slsc">12 SLSC</option>
                            <option selected value="5-slsc">5 SLSC</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-12 ">
                    <div class="form-group mb-3">
                      <label for="auth_given_by" class="form-label">6. Auth given by (ref of the ltr/msg)</label>
                      <input id="auth_given_by" name="auth_given_by" type="text" placeholder="" class="form-control" value="TPS/G/2023/43312">
                    </div>
                  </div>

                  <div class="col-md-12 ">
                    <div class="form-group mb-3">
                      <label for="route" class="form-label">7. Route</label>
                      <input id="route" name="route" type="text" placeholder="" class="form-control" value="Panagoda - Padukka">
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="col-md-6 m-0 float-left pl-0">
                      <div class="form-group">
                        <label for="type_of_veh" class="form-label">8. (i) Type of vehicle</label>
                        <select class="selectpicker form-control" id="type_of_veh" data-container="body" data-live-search="true" title="Select the Type of Vehicle" data-hide-disabled="true">
                            <option value="bus">Bus</option>
                            <option value="lorry">Lorry</option>
                            <option value="van">Van</option>
                            <option selected value="truck">Truck</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6 m-0 float-left pr-0">
                      <div class="form-group">
                        <label for="no_of_seat" class="form-label">(ii) No of seat available</label>
                        <input id="no_of_seat" name="no_of_seat" type="text" placeholder="" class="form-control" value="3">
                      </div>
                    </div>
                  </div>

                  <div class="col-md-12 ">
                    <div class="form-group mb-3">
                      <label for="convoy" class="form-label">9. Vehicle/Convoy comd name</label>
                      <select class="selectpicker form-control" id="convoy" data-container="body" data-live-search="true" title="Select the Vehicle/Convoy Comd Name" data-hide-disabled="true">
                            <option selected value="S/33421">S/33421 Kumanayake MGE</option>
                            <option value="lorry">S/66433 Rathna PG</option>
                            <option value="van">S/85333 Giragama HNHG</option>
                            <option value="truck">S/75578 Rukunayake RS</option>
                        </select>
                    </div>
                  </div>

                  <div class="col-md-12 ">
                    <div class="form-group mb-3">
                      <label for="escort" class="form-label">10. Escort name</label>
                      <select class="selectpicker form-control" id="escort" data-container="body" data-live-search="true" title="Select the Escort Name" data-hide-disabled="true">
                            <option value="S/33421">S/33421 Kumanayake MGE</option>
                            <option selected value="lorry">S/66433 Rathna PG</option>
                            <option value="van">S/85333 Giragama HNHG</option>
                            <option value="truck">S/75578 Rukunayake RS</option>
                        </select>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="col-md-4 m-0 float-left pl-0">
                      <div class="form-group">
                        <label for="escort_weapon_no" class="form-label">11. (i) Escort weapon no</label>
                        <input id="escort_weapon_no" name="escort_weapon_no" type="text" placeholder="" class="form-control" value="444566444">
                      </div>
                    </div>
                    <div class="col-md-4 m-0 float-left">
                      <div class="form-group">
                        <label for="no_of_magazins" class="form-label">(ii) No of magazins</label>
                        <input id="no_of_magazins" name="no_of_magazins" type="text" placeholder="" class="form-control" value="4">
                      </div>
                    </div>
                    <div class="col-md-4 m-0 float-left pr-0">
                      <div class="form-group">
                        <label for="no_of_ammo" class="form-label">(iii) Ammo</label>
                        <input id="no_of_ammo" name="no_of_ammo" type="text" placeholder="" class="form-control" value="120">
                      </div>
                    </div>
                  </div>

                  <div class="col-md-12 ">
                    <div class="form-group mb-3">
                      <label for="driver" class="form-label">12. Driver name</label>
                      <select class="selectpicker form-control" id="driver" data-container="body" data-live-search="true" title="Select the Driver Name" data-hide-disabled="true">
                            <option value="S/33421">S/33421 Kumanayake MGE</option>
                            <option value="lorry">S/66433 Rathna PG</option>
                            <option value="van">S/85333 Giragama HNHG</option>
                            <option selected value="truck">S/75578 Rukunayake RS</option>
                        </select>
                    </div>
                  </div>

                  <div class="col-md-12 ">
                    <div class="form-group mb-3">
                      <label for="measures_taken" class="form-label">13. Measures taken for the sy of tps to be transported</label>
                      <input id="measures_taken" name="measures_taken" type="text" placeholder="" class="form-control" value="-">
                    </div>
                  </div>

                  <div class="col-md-12 ">
                    <div class="form-group mb-3">
                      <label for="ref_of_ltr" class="form-label">14. Ref of ltr/msg of "hiring auth to the Ay" for veh which use civil no plates</label>
                      <input id="ref_of_ltr" name="ref_of_ltr" type="text" placeholder="" class="form-control" value="-">
                    </div>
                  </div>

                  <div class="col-md-12 ">
                    <div class="form-group mb-3">
                      <label for="att" class="form-label">15. Any other relevant docs att</label>
                      <input id="att" name="att" type="text" placeholder="" class="form-control" value="-">
                    </div>
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

    $("form").submit(function (event) {

        var req_made_location = $("#req_made_location").val();
        var reason = $("#reason").val();
        var no_of_troops = $("#no_of_troops").val();
        var transport_date = $("#transport_date").val();
        var location_from = $("#location_from").val();
        var location_to = $("#location_to").val();
        var auth_given_by = $("#auth_given_by").val();
        var route = $("#route").val();
        var type_of_veh = $("#type_of_veh").val();
        var no_of_seat = $("#no_of_seat").val();
        var convoy = $("#convoy").val();
        var escort = $("#escort").val();
        var escort_weapon_no = $("#escort_weapon_no").val();
        var no_of_magazins = $("#no_of_magazins").val();
        var no_of_ammo = $("#no_of_ammo").val();
        var driver = $("#driver").val();
        var measures_taken = $("#measures_taken").val();
        var ref_of_ltr = $("#ref_of_ltr").val();
        var att = $("#att").val();
      

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
            url:"{{ url('') }}/auth_req_lttr_form_func",
            data: { "_token": "{{ csrf_token() }}" , req_made_location:req_made_location , reason:reason , no_of_troops:no_of_troops , transport_date:transport_date , location_from:location_from , location_to:location_to , auth_given_by:auth_given_by , route:route , type_of_veh:type_of_veh , no_of_seat:no_of_seat , convoy:convoy , escort:escort , escort_weapon_no:escort_weapon_no , no_of_magazins:no_of_magazins , no_of_ammo:no_of_ammo , driver:driver , measures_taken:measures_taken , ref_of_ltr:ref_of_ltr , att:att },
            dataType: "json",
            encode: true,
        }).done(function (data) {
            console.log(data);
    
      
        });
        event.preventDefault();

    });



  // $(".logoutx").click(function(){
  //   console.log('xx')
  //     // Logout
  //     $.ajax({
  //         url:"{{ url('') }}/logout_func",
  //         method:'POST',
  //         dataType: 'json',
  //         data:{ "_token": "{{ csrf_token() }}"},
  //         success:function(data){

  //           // if (data.msg == 'expired') {
  //           //   window.location.href = "";
  //           // }
  //           // else{
  //           //   $('.remaining_dates').html(data.msg)
  //           // }

  //         }
  //     })
  // })

</script>


</body>
</html>
