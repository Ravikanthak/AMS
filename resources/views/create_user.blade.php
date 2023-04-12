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
            <h1>Create User</h1>
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
                      <label for="officer" class="form-label">Select Location</label>
                      <div class="dropdown">
                        <select class="form-select" aria-label="Default select example">
                          <option value="establishment">Establishment</option>
                          <option value="brigade">Brigade</option>
                          <option value="div">Div</option>
                          <option value="sfhq">SFHQ/1 Corps</option>
                          <option value="dops">D-Ops</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-12 ">
                    <div class="form-group mb-3">
                      <label for="username" class="form-label">Username</label>
                      <input id="username" name="username" type="text" placeholder="" class="form-control">
                    </div>
                  </div>

                  <div class="col-md-12 ">
                    <div class="form-group mb-3">
                      <label for="password" class="form-label">Password</label>
                      <input id="password" name="password" type="number" placeholder="" class="form-control">
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group text-right">
                      <button id="create_user" type="submit" class="btn btn-primary">Submit</button>
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
