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
                      <label for="request_ref_no" class="form-label">Request Reference Number : 000{{ request()->segment(2) }}</label>
                      
                    </div>
                  </div>

                  <div class="col-md-12 ">
                    <div class="form-group mb-3">
                      <label for="request_forward_by" class="form-label">Request Forward by</label>
                      <select name="request_forward_by" class="selectpicker form-control" id="request_forward_by" data-container="body" data-live-search="true" title="Select the Org Name" data-hide-disabled="true">
                          @if (isset($added_by))
                            @foreach($organization_types as $type)

                                @if (!in_array($type->id, [1,2,5,8,11,17]))
                                    <option value="{{$type->id}}" @if($type->id == $added_by) selected @endif>{{$type->name}}</option>
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
                      <label for="request_forward_to" class="form-label">Request Forward to</label>
                      <select name="request_forward_to" class="selectpicker form-control" id="request_forward_to" data-container="body" data-live-search="true" title="Select the Org Name" data-hide-disabled="true">
                          @if (isset($added_by))
                            @foreach($organization_types as $type)

                                @if (!in_array($type->id, [1,2,5,8,11,17]))
                                    <option value="{{$type->id}}" @if($type->id == $added_by) selected @endif>{{$type->name}}</option>
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
                    <div class="alert alert-success" role="alert"></div>
                    <div class="alert alert-danger" role="alert"></div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group text-right">
                      <button type="button" class="btn btn-success approve_btn">Approve and Forward</button>
                      <button type="button" class="btn btn-danger decline_btn">Decline</button>
                      <a href="{{route('auth_req_lttr_troops_take_action_view')}}" id="" class="btn btn-secondary">Previous</a>
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
        url:"{{ url('') }}/auth_req_lttr_troops_check_status",
        method:'POST',
        // dataType:'json',
        data:{ "_token": "{{ csrf_token() }} " , req_id:req_id },
        success: function(response) {
            if (response.msg[0].req_fwd_to_status == 'Declined') {
              $('.decline_btn').text('Declined');
              $('.decline_btn').prop('disabled', true);
              $('.approve_btn').prop('disabled', true);
            }
            if (response.msg[0].req_fwd_to_status == 'Approved') {
              $('.decline_btn').prop('disabled', true);
              $('.approve_btn').prop('disabled', true);
              $('.approve_btn').text('Approved and Forwarded');
            }
        }
    });



    // Approve and Forward Button
    $("body").on("click",".approve_btn",function(){

        var req_id = '{{ request()->segment(2) }}' // Get Req ID from the URL Parameter
        var request_forward_by = $('#request_forward_by').val();
        var request_forward_to = $('#request_forward_to').val();

        if (request_forward_by == '' || request_forward_to == '') {
          alert('Please select Request Forward Options')
        }
        else{
          $.ajax({
              url:"{{ url('') }}/auth_req_lttr_troops_approve_btn",
              method:'POST',
              dataType:'json',
              data:{ "_token": "{{ csrf_token() }}" , req_id:req_id , request_forward_by:request_forward_by , request_forward_to:request_forward_to },
              success: function(response) {
                console.log(response)
                if (response.msg == 'Approved') {
                  $('.approve_btn').text('Approved and Forwarded');
                  $('.approve_btn').prop('disabled', true);
                  $('.decline_btn').prop('disabled', true);
                }
              }
          });
        }
    });



    $("body").on("click",".decline_btn",function(){

        var req_id = '{{ request()->segment(2) }}'

        if (request_forward_by == '' || request_forward_to == '') {
          alert('Please select Request Forward Options')
        }
        else{
          $.ajax({
              url:"{{ url('') }}/auth_req_lttr_troops_decline_btn",
              method:'POST',
              dataType:'json',
              data:{ "_token": "{{ csrf_token() }}" , req_id:req_id },
              success: function(response) {
                if (response.msg == 'Declined') {
                  $('.decline_btn').text('Declined');
                  $('.decline_btn').prop('disabled', true);
                  $('.approve_btn').prop('disabled', true);
                }
              }
          });
        }
     });



    // Decline Button
    // $("body").on("click",".decline_btn",function(){
    //   console.log('dec')
    //       $.ajax({
    //           url:"{{ url('') }}/auth_req_lttr_troops_approve_btn",
    //           method:'POST',
    //           dataType:'json',
    //           data:{ "_token": "{{ csrf_token() }}" , req_id:req_id , request_forward_by:request_forward_by , request_forward_to:request_forward_to },
    //           success: function(response) {
    //             // if (response.msg == 'Declined') {
    //             //   $('.decline_btn').text('Declined');
    //             //   $('.decline_btn').prop('disabled', true);
    //             //   $('.approve_btn').prop('disabled', true);
    //             // }
    //           }
    //       });
    // });




});

</script>

</body>
</html>
