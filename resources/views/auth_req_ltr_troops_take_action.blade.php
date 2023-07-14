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
            <h1>Approve/Decline Authority Requests (Troops Transportation)</h1>
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
                        <label for="request_ref_no" class="form-label">1. Request Reference Number : 000{{$auth_req_ltr_troops_fwds->auth_req_ltr_troops_id}}</label>

                        @if($auth_req_ltr_troops_fwds->req_fwd_to_status != '')
                        </br><label for="request_status" class="form-label">2. Request Status : {{ $auth_req_ltr_troops_fwds->req_fwd_to_status }}</label>@endif

                        @if($req_fwd_to_name != '' && $auth_req_ltr_troops_fwds->req_fwd_to_status != 'Pending')
                        </br><label for="request_status" class="form-label">3. Request Forwarded to : {{ $req_fwd_to_name }}</label>@endif
                    </div>
                  </div>


                  <div class="col-md-12 ">
                    <div class="form-group mb-3">
                      <label for="request_forward_to" class="form-label">Request Approve and Forward to</label>
                      <select name="request_forward_to" class="selectpicker form-control" id="request_forward_to" data-container="body" data-live-search="true" title="Select the Org Name" data-hide-disabled="true">
                            @foreach($organization_types as $type)
{{--                                @if (!in_array($type->id, [1,2,5,8,11,17]))--}}
                                    <option value="{{$type->id}}">{{$type->name}}</option>
                                {{--@endif--}}
                            @endforeach
                      </select>
                    </div>
                  </div>


                  <div class="col-md-12 ">
                    <div class="form-group">
                      <label for="comments">Comments</label>
                      <textarea class="form-control" id="comments" rows="3"></textarea>
                    </div>
                  </div>


                  <div class="col-md-12 ">
                    <div class="form-group">
                      <label for="comments">Previous Comments</label>
                      @if($auth_req_ltr_troops_fwds->comment_approve != '')
                        <br><i>{{ $auth_req_ltr_troops_fwds->comment_approve }}</i>
                      @endif
                      @if($auth_req_ltr_troops_fwds->comment_decline != '')
                        <br><i>{{ $auth_req_ltr_troops_fwds->comment_decline }}</i>
                      @endif
                    </div>
                  </div>


                  <div class="col-md-12">
                    <div class="form-group text-right">

                      @if( Auth()->user()->user_type == 12  || Auth()->user()->user_type == 12 || Auth()->user()->user_type == 12)
                        <a target="_blank" href="{{route('auth_req_ltr_troops')}}/{{$req_ltr->id}}" id="{{$req_ltr->id}}" class="btn btn-success edit">Edit</a>
                      @endif

                      <button type="button" class="float-left btn btn-success final_approve_btn">Final Approval</button>
                      <button type="button" class="btn btn-success approve_btn">Approve and Forward</button>
                      <button type="button" class="btn btn-danger decline_btn">Decline</button>
                      <a href="{{route('auth_req_ltr_troops_take_action_view')}}" id="" class="btn btn-secondary">Back</a>
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

    $('.alert-success').hide()
    $('.alert-danger').hide()

    var req_id = '{{ request()->segment(2) }}' // Get Req ID from the URL Parameter

    // Check req ltr status to modify approve and decline buttons
    $.ajax({ 
        url:"{{ url('') }}/auth_req_ltr_troops_check_status",
        method:'POST',
        // dataType:'json',
        data:{ "_token": "{{ csrf_token() }} " , req_id:req_id },
        success: function(response) {
          
            if (response.msg[0].req_fwd_to_status == 'Declined') {
              $('.decline_btn').text('Declined');
              $('.decline_btn').prop('disabled', true);
            }
            if (response.msg[0].req_fwd_to_status == 'Approved') {

              $('#request_forward_to').prop('disabled', true);
              $('#request_forward_to').selectpicker('refresh');
              
              $('.approve_btn').text('Approved and Forwarded');
              $('.approve_btn').prop('disabled', true);
              $('.decline_btn').prop('disabled', true);
            }
            if (response.msg2 == 'Approved Final') {

              $('#request_forward_to').prop('disabled', true);
              $('#request_forward_to').selectpicker('refresh');
              
              $('.final_approve_btn').prop('disabled', true);
              $('.final_approve_btn').text('Finally Approved');
              $('.approve_btn').prop('disabled', true);
              $('.decline_btn').prop('disabled', true);
            }
        }
    });



    // Approve and Forward Button
    $("body").on("click",".approve_btn",function(){

        var req_id = '{{ request()->segment(2) }}' // Get Req ID from the URL Parameter
        var request_forward_by = $('#request_forward_by').val();
        var request_forward_to = $('#request_forward_to').val();
        var comments = $('#comments').val();

        if (request_forward_to == '') {
          Swal.fire('Please select the "Request Approve and Forward to" Option')
        }
        else{
          $.ajax({
              url:"{{ url('') }}/auth_req_ltr_troops_approve_btn",
              method:'POST',
              dataType:'json',
              data:{ "_token": "{{ csrf_token() }}" , req_id:req_id , request_forward_by:request_forward_by , request_forward_to:request_forward_to, comments:comments },
              success: function(response) {
                console.log(response)
                if (response.msg == 'Approved') {

                  Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Request Approved Success',
                    showConfirmButton: false,
                    timer: 2000
                  })

                  $('.approve_btn').text('Approved and Forwarded');
                  $('.approve_btn').prop('disabled', true);
                  $('.decline_btn').prop('disabled', true);

                  setTimeout(function() {
                    location.reload()
                  }, 2000)

                }
              }
          });
        }
    });



    

    // Decline Button
    $("body").on("click",".decline_btn",function(){

        var req_id = '{{ request()->segment(2) }}'
        var comments = $('#comments').val();

        if (comments == '') {
          Swal.fire('Please put the comment for the reason for the decline')
        }
        else{
          $.ajax({
              url:"{{ url('') }}/auth_req_ltr_troops_decline_btn",
              method:'POST',
              dataType:'json',
              data:{ "_token": "{{ csrf_token() }}" , req_id:req_id , comments:comments},
              success: function(response) {
                if (response.msg == 'Declined') {

                  Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Request has been Declined',
                    showConfirmButton: false,
                    timer: 2000
                  })

                  $('.decline_btn').text('Declined');
                  $('.decline_btn').prop('disabled', true);

                  setTimeout(function() {
                    location.reload()
                  }, 2000)

                }
              }
          });
        }
        
     });




    // Final Approve Button
    $("body").on("click",".final_approve_btn",function(){

        var req_id = '{{ request()->segment(2) }}' // Get Req ID from the URL Parameter
        var request_forward_by = $('#request_forward_by').val();
        var request_forward_to = $('#request_forward_to').val();
        var comments = $('#comments').val();

        if (comments == '') {
          Swal.fire('Please leave a comment')
        }
        else{
          $.ajax({
              url:"{{ url('') }}/auth_req_ltr_troops_final_approve_btn",
              method:'POST',
              dataType:'json',
              data:{ "_token": "{{ csrf_token() }}" , req_id:req_id , request_forward_by:request_forward_by , request_forward_to:request_forward_to, comments:comments },
              success: function(response) {
                console.log(response)
                if (response.msg == 'Approved Final') {

                  Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Request Fianlly Approved Success',
                    showConfirmButton: false,
                    timer: 2000
                  })

                  $('.final_approve_btn').text('Finally Approved');
                  $('.final_approve_btn').prop('disabled', true);
                  $('.approve_btn').prop('disabled', true);
                  $('.decline_btn').prop('disabled', true);

                  setTimeout(function() {
                    location.reload()
                  }, 2000)

                }
              }
          });
        }
    });



});

</script>

</body>
</html>
