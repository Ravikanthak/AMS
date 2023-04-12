<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" />
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}" />
    <script src="{{ asset('/js/js.cookie.min.js') }}"></script>
    <script src="{{ asset('/js/jquery.min.js') }}"></script>
    <title>Register</title>
</head>

<body>

<section class="main_section">

  <div class="main_div">

      <div class="main_div_inner main_div_inner_register">
          <div class="main_div_innerin">
              <h1 class="">
              Create New Account
              </h1>
              <form class="form" action="#">

                    <div>
                        <label for="fname" class="">Username</label>
                        <input type="text" name="fname" id="fname" class="form-control" placeholder="John" value="mail@army.lk">
                        <span class="error_msg error_msg_fname"></span>
                    </div>                

                    <div>
                        <label for="email" class="">Email</label>
                        <input type="text" name="email" id="email" class="form-control" placeholder="name@company.com" value="mail@army.lk">
                        <span class="error_msg error_msg_email"></span>
                    </div>

                    <div class="msg">
                        <p class="error"></p>
                        <p class="success"></p>
                    </div>

                    <div class="registerlink">
                        <button class="btn btn-primary" type="submit" class="">Register</button>
                    </div>

              </form>
          </div>
      </div>
  </div>
</section>


<script>
    $(document).ready(function () {


        $("form").submit(function (event) {

            var fname = $("#fname").val();
            var email = $("#email").val(); 

            $.ajax({
                type: "POST",
                url:"{{ url('') }}/register_func",
                data: { "_token": "{{ csrf_token() }}" , fname:fname , email:email },
                dataType: "json",
                encode: true,
            }).done(function (data) {
                console.log(data);
               
                if (data.status == 0) { // No Error
                    $('.error_msg').hide()
                    $('.msg > .success').show()
                    $('.msg > .success').html('Registration Success. Please Login');

                    

                }

                else{ // Has Error
                    $('.msg > .success').hide()

                    if (data.error.fname) { // Has Error, fname
                        $('.error_msg_fname').show();
                        $('.error_msg_fname').html(data.error.fname);
                    }
                    else{ $('.error_msg_fname').hide(); }

                    if (data.error.lname) { // Has Error, lname
                        $('.error_msg_lname').show();
                        $('.error_msg_lname').html(data.error.lname);
                    }
                    else{ $('.error_msg_lname').hide(); }

                    if (data.error.email) { // Has Error, email
                        $('.error_msg_email').show();
                        $('.error_msg_email').html(data.error.email);
                    }
                    else{ $('.error_msg_email').hide(); }

                    if (data.error.country) { // Has Error, country
                        $('.error_msg_country').show();
                        $('.error_msg_country').html(data.error.country);
                    }
                    else{ $('.error_msg_country').hide(); }

                    if (data.error.mobile) { // Has Error, mobile
                        $('.error_msg_mobile').show();
                        $('.error_msg_mobile').html(data.error.mobile);
                    }
                    else{ $('.error_msg_mobile').hide(); }

                    if (data.error.password) { // Has Error, password
                        $('.error_msg_password').show();
                        $('.error_msg_password').html(data.error.password);
                    }
                    else{ $('.error_msg_password').hide(); }   

                }


                
            });
            event.preventDefault();
        });


    });
</script>

</body>
</html>