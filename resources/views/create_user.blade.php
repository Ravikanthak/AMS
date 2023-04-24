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
            <h1>Create Admin User</h1>
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
                      <label for="location_name" class="form-label">Location Name</label>
                      <input id="location_name" name="location_name" type="text" placeholder="" class="form-control" value="12 SLSC - Png">
                    </div>
                  </div>

                  <div class="col-md-12 ">
                      <div class="form-group mb-3">
                      <label for="account_type" class="form-label">User Account Type</label>
                      <select name="account_type" class="form-control">
                          @foreach($user_type as $ut)
                              <option value="{{$ut->user_type}}">{{$ut->name}}</option>
                          @endforeach
                      </select>
                    </div>
                  </div>

                  <div class="col-md-12 ">
                    <div class="form-group mb-3">
                      <label for="username" class="form-label">Username</label>
                      <input id="username" name="username" type="text" placeholder="" class="form-control" value="12slsc">
                    </div>
                  </div>

                  <div class="col-md-12 ">
                    <div class="form-group mb-3">
                      <label for="password" class="form-label">Password</label>
                      <input id="password" name="password" type="password" placeholder="" class="form-control" value="army@123">
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

        var location_name = $("#location_name").val();
        var account_type = $("#account_type").val();
        var username = $("#username").val();
        var password = $("#password").val();

        $.ajax({
            type: "POST",
            url:"{{ url('') }}/create_admin_user_func",
            data: { "_token": "{{ csrf_token() }}" , location_name:location_name , account_type:account_type , username:username , password:password },
            dataType: "json",
            encode: true,
        }).done(function (data) {
            console.log(data);
    
      
        });
        event.preventDefault();

    });

</script>


</body>
</html>
