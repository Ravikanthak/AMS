<!DOCTYPE html>
<html lang="en">
<head>
  @include('inc/header')
</head>



<body>

<section class="main_section">

  <div class="main_div">
      <a href="#" class="logo_a">
          <img class="" src="{{ asset('/img/logo.png') }}" alt="SL Army logo">
          Weapons & Troops Transport Authority Management System
      </a>
      <div class="main_div_inner">
          <div class="main_div_innerin">
              <!-- <h1 class="">
              Login to Account
              </h1> -->
              <form class="form" action="#">
                  <div>
                      <label for="username" class="">Username</label>
                      <input type="text" name="username" id="username" class="form-control" placeholder="admin" value="admin">
                      <span class="error_msg error_msg_username"></span>
                  </div>
                  <div>
                      <label for="password" class="">Password</label>
                      <input type="password" name="password" id="password" placeholder="••••••••" class="form-control" value="123">
                      <span class="error_msg error_msg_password"></span>
                  </div>
                  <div class="">
                        <div class="remember_me">
                            <div>
                                <input id="remember" type="checkbox" class="">
                                <label for="remember" class="">Remember me</label>
                            </div>
                            <a id="forgot_password" href="#" class="">Forgot password?</a>
                        </div>
                  </div>

                  <div class="msg">
                        <p class="error"></p>
                        <p class="success"></p>
                  </div>                 

                  <div class="loginlink">
                    <button class="btn btn-primary" type="submit" class="">Login</button>
                  </div>

              </form>
          </div>
      </div>
  </div>
</section>




<script>
    $(document).ready(function () {

        $("form").submit(function (event) {

            var username = $("#username").val(); 
            var password = $("#password").val(); 

            $.ajax({
                type: "POST",
                url:"{{ url('') }}/login_func",
                data: { "_token": "{{ csrf_token() }}" , username:username , password:password },
                dataType: "json",
                encode: true,
            }).done(function (data) {

                // No Error
                if (data.status == 0) { 
                    $('.error_msg').hide()
                    $('.msg > .success').show()
                    $('.msg > .success').html('Login Success');

                    window.location.href = "{{route('dashboard')}}"
                }

                // Validation Error
                if(data.status == 1){ 
                    $('.msg').hide()
                    $('.error_msg_username').hide()
                    $('.error_msg_password').hide()
                    $('.msg > .success').hide()

                    if (data.error.username) { // Has Error, username
                        $('.error_msg_username').show();
                        $('.error_msg_username').html(data.error.username);
                    }
                    else{ $('.error_msg_username').hide(); }

                    if (data.error.password) { // Has Error, password
                        $('.error_msg_password').show();
                        $('.error_msg_password').html(data.error.password);
                    }
                    else{ $('.error_msg_password').hide(); }         
                }

                // Credentials Error
                if(data.status == 2){ 
                    $('.error_msg_username').hide();
                    $('.error_msg_password').hide();
                    $('.msg').show()
                    $('.msg > .error').show()
                    $('.msg > .error').html('Incorrect Username or Password');
                }


            });
            event.preventDefault();
        });


        document.getElementById("forgot_password").onclick = function() {  
            window.location.href = "";
        };
 

    });
</script>



</body>
</html>