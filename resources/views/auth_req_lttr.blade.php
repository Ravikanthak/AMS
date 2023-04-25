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
          <div class="row">
            <section class="col-lg-12 connectedSortable ui-sortable">
             
              <div class="card auth_req_lttr_form">

                  <div class="col-md-12 ">
                    <div class="form-group mb-3">
                      <label for="officer" class="form-label">1. Request made by (location)</label>
                      <div class="dropdown">
                        <a id="dropbtn" class="dropbtn">Select the Name</a>
                        <div id="myDropdown" class="dropdown-content">
                            <input class="myInput" type="text" placeholder="Search.." id="myInput" onkeyup="filterFunction()">
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-12 ">
                    <div class="form-group mb-3">
                      <label for="reason" class="form-label">2. Reason for transportation</label>
                      <input id="reason" name="reason" type="text" placeholder="" class="form-control">
                    </div>
                  </div>

                  <div class="col-md-12 ">
                    <div class="form-group mb-3">
                      <label for="no_of_troops" class="form-label">3. No of troops to be transported</label>
                      <input id="no_of_troops" name="no_of_troops" type="number" placeholder="" class="form-control">
                    </div>
                  </div>

                  <div class="col-md-12 ">
                    <div class="form-group mb-3">
                      <label for="transport_date" class="form-label">4. Date of transportation</label>
                      <input type="text" autocomplete="off" placeholder="Date" class="form-control datepicker transport_date" name="transport_date" id="datepicker">
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="col-md-6 m-0 float-left pl-0">
                      <div class="form-group">
                        <label for="location_from" class="form-label">5. Location to be transported : (From)</label>
                        <input id="location_from" name="location_from" type="text" placeholder="" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-6 m-0 float-left pr-0">
                      <div class="form-group">
                        <label for="location_to" class="form-label">(To)</label>
                        <input id="location_to" name="location_to" type="text" placeholder="" class="form-control">
                      </div>
                    </div>
                  </div>

                  <div class="col-md-12 ">
                    <div class="form-group mb-3">
                      <label for="auth_given_by" class="form-label">6. Auth given by (ref of the ltr/msg)</label>
                      <input id="auth_given_by" name="auth_given_by" type="text" placeholder="" class="form-control">
                    </div>
                  </div>

                  <div class="col-md-12 ">
                    <div class="form-group mb-3">
                      <label for="route" class="form-label">7. Route</label>
                      <input id="route" name="route" type="text" placeholder="" class="form-control">
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="col-md-6 m-0 float-left pl-0">
                      <div class="form-group">
                        <label for="type_of_veh" class="form-label">8. (i) Type of vehicle</label>
                        <input id="type_of_veh" name="type_of_veh" type="text" placeholder="" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-6 m-0 float-left pr-0">
                      <div class="form-group">
                        <label for="no_of_seat" class="form-label">(ii) No of seat available</label>
                        <input id="no_of_seat" name="no_of_seat" type="text" placeholder="" class="form-control">
                      </div>
                    </div>
                  </div>

                  <div class="col-md-12 ">
                    <div class="form-group mb-3">
                      <label for="officer" class="form-label">9. Vehicle/Convoy comd name</label>
                      <div class="dropdown">
                        <a id="dropbtn2" class="dropbtn">Select the Name</a>
                        <div id="myDropdown2" class="dropdown-content">
                            <input class="myInput" type="text" placeholder="Search.." id="myInput2" onkeyup="filterFunction()">
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-12 ">
                    <div class="form-group mb-3">
                      <label for="officer" class="form-label">10. Escort name</label>
                      <div class="dropdown">
                        <a id="dropbtn3" class="dropbtn">Select the Name</a>
                        <div id="myDropdown3" class="dropdown-content">
                            <input class="myInput" type="text" placeholder="Search.." id="myInput3" onkeyup="filterFunction()">
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="col-md-4 m-0 float-left pl-0">
                      <div class="form-group">
                        <label for="escort_weapon_no" class="form-label">11. (i) Escort weapon no</label>
                        <input id="escort_weapon_no" name="escort_weapon_no" type="text" placeholder="" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-4 m-0 float-left">
                      <div class="form-group">
                        <label for="no_of_magazins" class="form-label">(ii) No of magazins</label>
                        <input id="no_of_magazins" name="no_of_magazins" type="text" placeholder="" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-4 m-0 float-left pr-0">
                      <div class="form-group">
                        <label for="no_of_ammo" class="form-label">(iii) Ammo</label>
                        <input id="no_of_ammo" name="no_of_ammo" type="text" placeholder="" class="form-control">
                      </div>
                    </div>
                  </div>

                  <div class="col-md-12 ">
                    <div class="form-group mb-3">
                      <label for="officer" class="form-label">12. Driver name</label>
                      <div class="dropdown">
                        <a id="dropbtn3" class="dropbtn">Select the Name</a>
                        <div id="myDropdown3" class="dropdown-content">
                            <input class="myInput" type="text" placeholder="Search.." id="myInput3" onkeyup="filterFunction()">
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-12 ">
                    <div class="form-group mb-3">
                      <label for="reason" class="form-label">13. Measures taken for the sy of tps to be transported</label>
                      <input id="reason" name="reason" type="text" placeholder="" class="form-control">
                    </div>
                  </div>

                  <div class="col-md-12 ">
                    <div class="form-group mb-3">
                      <label for="reason" class="form-label">14. Ref of ltr/msg of "hiring auth to the Ay" for veh which use civil no plates</label>
                      <input id="reason" name="reason" type="text" placeholder="" class="form-control">
                    </div>
                  </div>

                  <div class="col-md-12 ">
                    <div class="form-group mb-3">
                      <label for="reason" class="form-label">15. Any other relevant docs att</label>
                      <input id="reason" name="reason" type="text" placeholder="" class="form-control">
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
      </div>
    </section>

  </div>

  <footer class="main-footer">
    @include('inc/footer')
  </footer>


</div>

@include('inc/footer_assets')


<script src="https://172.16.60.28/omms/test2/public/js/datepicker/datepicker.js"></script>
<script>

    const weekday = ["Saturday","Sunday","Monday","Tuesday","Wednesday","Thursday","Friday",];
    //date picker
    $('.datepicker').datepicker({
        format: 'YYYY-MM-DD',
        autoclose: true,
        // endDate: '0d'
    })
    .datepicker("setDate", new Date()).on('keypress keydown paste change', function (e) {
        $('.datepicker').datepicker('hide');
    });


    // Search Dropdown List 1
    function filterFunction() {
        var input, filter, ul, li, a, i;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        div = document.getElementById("myDropdown");
        a = div.getElementsByTagName("a");
        for (i = 0; i < a.length; i++) {
            txtValue = a[i].textContent || a[i].innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
            a[i].style.display = "";
            } else {
            a[i].style.display = "none";
            }
        }
    }
    $("#dropbtn").click(function(){
        document.getElementById("myDropdown").classList.toggle("show");
        $("#myInput").val('');
    });
    // Search Dropdown List 1


    // Search Dropdown List 2
    function filterFunction() {
        var input, filter, ul, li, a, i;
        input = document.getElementById("myInput2");
        filter = input.value.toUpperCase();
        div = document.getElementById("myDropdown2");
        a = div.getElementsByTagName("a");
        for (i = 0; i < a.length; i++) {
            txtValue = a[i].textContent || a[i].innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
            a[i].style.display = "";
            } else {
            a[i].style.display = "none";
            }
        }
    }
    $("#dropbtn2").click(function(){
        document.getElementById("myDropdown2").classList.toggle("show");
        $("#myInput2").val('');
    });
    // Search Dropdown List 2


    // Search Dropdown List 3
    function filterFunction() {
        var input, filter, ul, li, a, i;
        input = document.getElementById("myInput3");
        filter = input.value.toUpperCase();
        div = document.getElementById("myDropdown3");
        a = div.getElementsByTagName("a");
        for (i = 0; i < a.length; i++) {
            txtValue = a[i].textContent || a[i].innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
            a[i].style.display = "";
            } else {
            a[i].style.display = "none";
            }
        }
    }
    $("#dropbtn3").click(function(){
        document.getElementById("myDropdown3").classList.toggle("show");
        $("#myInput3").val('');
    });
    // Search Dropdown List 3




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
