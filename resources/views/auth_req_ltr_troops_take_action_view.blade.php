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
            <h1>Approve/Decline Authority Requests (Troops Transportation)44</h1>
          </div>
        </div>
      </div>
    </section>


    <section class="content table_auth_req_lttr_troops">
      <div class="container-fluid">
        <div class="row mb-2">
          <section class="col-lg-12 connectedSortable ui-sortable">
            <div class="card auth_req_lttr_form">

              <table class="table_auth_req_ltr table stripe hover row-border order-column" id="table_auth_req_ltr_troops">
                <thead>
                <tr>
                  <th>#Auth Req Ltr ID</th>
                  <th>Created Date</th>
                  <th>Request From</th>
                  <th>Status</th>
                  <th>Request To</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>

                <tbody>
                @foreach($auth_req_ltr_troops as $req_ltr)
                  <tr>
                      <td>{{$req_ltr->auth_req_ltr_troops_id}}</td>
                      <td>{{$req_ltr->created_at}}</td>
                      <td>
                        @if($req_ltr->req_fwd_by == 3)Establishment Head
                        @elseif($req_ltr->req_fwd_by == 4)Establishment Subject Clerk
                        @elseif($req_ltr->req_fwd_by == 6)Bde Comd
                        @elseif($req_ltr->req_fwd_by == 7)BM
                        @elseif($req_ltr->req_fwd_by == 9)Div Comd
                        @elseif($req_ltr->req_fwd_by == 10)Div Col GS
                        @elseif($req_ltr->req_fwd_by == 12)SFHQ BGS
                        @elseif($req_ltr->req_fwd_by == 13)SFHQ Col GS
                        @elseif($req_ltr->req_fwd_by == 14)SFHQ GSO I
                        @elseif($req_ltr->req_fwd_by == 15)SFHQ GSO II
                        @elseif($req_ltr->req_fwd_by == 16)SFHQ Subject Clerk
                        @elseif($req_ltr->req_fwd_by == 18)D-Ops Director
                        @elseif($req_ltr->req_fwd_by == 19)D-Ops SO (Special Ops)
                        @elseif($req_ltr->req_fwd_by == 20)D-Ops SO (Coordination Ops)
                        @elseif($req_ltr->req_fwd_by == 21)D-Ops Subject Clerk (Special Ops)
                        @elseif($req_ltr->req_fwd_by == 22)D-Ops Subject Clerk (Coordination Ops)
                        @endif
                      </td>
                      <td>{{$req_ltr->req_fwd_by_status}}</td>
                      <td>
                        @if($req_ltr->req_fwd_to == 3)Establishment Head
                        @elseif($req_ltr->req_fwd_to == 4)Establishment Subject Clerk
                        @elseif($req_ltr->req_fwd_to == 6)Bde Comd
                        @elseif($req_ltr->req_fwd_to == 7)BM
                        @elseif($req_ltr->req_fwd_to == 9)Div Comd
                        @elseif($req_ltr->req_fwd_to == 10)Div Col GS
                        @elseif($req_ltr->req_fwd_to == 12)SFHQ BGS
                        @elseif($req_ltr->req_fwd_to == 13)SFHQ Col GS
                        @elseif($req_ltr->req_fwd_to == 14)SFHQ GSO I
                        @elseif($req_ltr->req_fwd_to == 15)SFHQ GSO II
                        @elseif($req_ltr->req_fwd_to == 16)SFHQ Subject Clerk
                        @elseif($req_ltr->req_fwd_to == 18)D-Ops Director
                        @elseif($req_ltr->req_fwd_to == 19)D-Ops SO (Special Ops)
                        @elseif($req_ltr->req_fwd_to == 20)D-Ops SO (Coordination Ops)
                        @elseif($req_ltr->req_fwd_to == 21)D-Ops Subject Clerk (Special Ops)
                        @elseif($req_ltr->req_fwd_to == 22)D-Ops Subject Clerk (Coordination Ops)
                        @endif
                      </td>
                      <td>{{$req_ltr->req_fwd_to_status}}</td>
                      <td class="action_td">
                      <span id="{{$req_ltr->auth_req_ltr_troops_id}}" class="track_btn btn btn-primary" data-toggle="modal" data-target="#TrackModal">Track</span>
                      <span id="{{$req_ltr->auth_req_ltr_troops_id}}" class="view_btn btn btn-primary" data-toggle="modal" data-target="#ViewModal">View</span>
                      <a target="_blank" href="{{route('auth_req_ltr_troops')}}/{{$req_ltr->auth_req_ltr_troops_id}}" id="{{$req_ltr->auth_req_ltr_troops_id}}" class="btn btn-success edit">Edit</a>
                      <a target="_blank" href="{{route('auth_req_ltr_troops_take_action')}}/{{$req_ltr->id}}" id="{{$req_ltr->id}}" class="btn btn-success edit">Take Action</a>
                      </td>
                  </tr>
                @endforeach
                </tbody>
              </table>

            </div>
          </section>
        </div>
      </div>
    </section>






    <!-- View Authority Request Popup Model -->
    <div class="modal fade" id="ViewModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Authority Request</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="view_auth_req_lttr_troops_details_div"></div>
        </div>
      </div>
    </div>



    <!-- Track Authority Request Popup Model -->
    <div class="modal fade" id="TrackModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Track Authority Request</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body view_auth_req_lttr_troops_track">

            <div class="track_requests">
              <div class="track_requestsin">
                
              </div>
            </div>    

          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>


  </div>

  <footer class="main-footer">
    @include('inc/footer')
  </footer>


</div>

@include('inc/footer_assets')

<script>

  $(document).ready(function() {

      // Datatable
      $('#table_auth_req_ltr_troops').DataTable();


      var ReqId = ""


      // Track Button
      $("body").on("click",".track_btn",function(){

          ReqId = $(this).attr('id');

          $.ajax({
              url:"{{ url('') }}/auth_req_ltr_troops_track_btn",
              method:'POST',
              data:{ "_token": "{{ csrf_token() }}" , ReqId:ReqId },
              success: function(response) {
                $('.track_requestsin').html(response)
              }
          });
      });   

      
      // View Button
      $("body").on("click",".view_btn",function(){
          
          $('#myInput').trigger('focus')

          ReqId = $(this).attr("id");

          $.ajax({
              url:"{{ url('') }}/auth_req_ltr_troops_view_btn",
              method:'POST',
              // dataType:'json',
              data:{ "_token": "{{ csrf_token() }} " , ReqId:ReqId },
              success: function(response) {
                  $('.view_auth_req_lttr_troops_details_div').html(response)
              }
          });

          $.ajax({ // Check req ltr status to change approve and decline buttons
              url:"{{ url('') }}/auth_req_ltr_troops_check_status",
              method:'POST',
              // dataType:'json',
              data:{ "_token": "{{ csrf_token() }} " , ReqId:ReqId },
              success: function(response) {
                  if (response.msg[0].status == 'Declined') {
                    $('.decline_btn').text('Declined');
                    $('.decline_btn').prop('disabled', true);
                    $('.approve_btn').prop('disabled', true);
                  }
                  if (response.msg[0].status == 'Approved') {
                    $('.decline_btn').prop('disabled', true);
                    $('.approve_btn').prop('disabled', true);
                    $('.approve_btn').text('Approved');
                  }
              }
          });
      });


  })

</script>


</body>
</html>
