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
            <h1>View Authority Requests (Weapon Transportation)</h1>
          </div>
        </div>
      </div>
    </section>


    <section class="content table_auth_req_lttr_troops">
      <div class="container-fluid">
        <div class="row mb-2">
          <section class="col-lg-12 connectedSortable ui-sortable">
            <div class="card auth_req_lttr_form">

              <table class="table stripe hover row-border order-column" id="table_auth_req_ltr_troops">
                <thead>
                <tr>
                  <th>#ID</th>
                  <th>Date</th>
                  <th>Auth Given by</th>
                  <th>Date of Transportation</th>
                  <th>Request Made by</th>
                  <th>No of Weapons</th>
                  <th>Action</th>
                </tr>
                </thead>

                <tbody>
                @foreach($auth_req_lttr_weapon as $wpn)
                  <tr>
                      <td>{{$wpn->id}}</td>
                      <td>{{$wpn->created_at}}</td>
                      <td>{{$wpn->auth_given_by}}</td>
                      <td>{{$wpn->transport_date}}</td>
                      <td>{{$wpn->organization}}</td>
                      <td>{{$wpn->no_of_wpn}}</td>
                      <td>
                        <span id="{{$wpn->id}}" class="btn btn-primary view" data-toggle="modal" data-target="#TrackModal">Track</span>
                        <span id="{{$wpn->id}}" class="btn btn-primary view" data-toggle="modal" data-target="#ViewModal">View</span>
                        <a target="_blank" href="{{route('auth_req_lttr_weapon')}}/{{$wpn->id}}" id="{{$wpn->id}}" class="btn btn-success edit">Edit</a>
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
          <div class="modal-body view_auth_req_lttr_troops_details"></div> 
          <div class="modal-footer">
            <button type="button" class="btn btn-success" data-dismiss="modal">Approve</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Decline</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
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

                <div class="box">
                  <div class="org">2 SLSC</div>
                  <div class="status status_approved"><p>Created Auth Req(Troops)</p><span>2023-02-14</span></div>
                </div>
                <div class="dot dot1"></div><div class="dot dot2"></div>

                <div class="box">
                  <div class="org">Unit Head</div>
                  <div class="status status_approved"><p>Approved</p><span>2023-02-14</span></div>
                </div>
                <div class="dot dot1"></div><div class="dot dot2"></div>
                
                <div class="box">
                  <div class="org">Bde Comd/BM</div>
                  <div class="status status_pending"><p>Pending</p></div>
                </div>
                <div class="dot dot1"></div><div class="dot dot2"></div>
                
                <div class="box">
                  <div class="org">Div Comd/Col GS</div>
                  <div class="status status_pending"><p>Pending</p></div>
                </div>
                <div class="dot dot1"></div><div class="dot dot2"></div>
                
                <div class="box">
                  <div class="org">SFHQ Subject Clerk</div>
                  <div class="status status_pending"><p>Pending</p></div>
                </div>
                <div class="dot dot1"></div><div class="dot dot2"></div>
                
                <div class="box">
                  <div class="org">SFHQ G2</div>
                  <div class="status status_pending"><p>Pending</p></div>
                </div>
                <div class="dot dot1"></div><div class="dot dot2"></div>
                
                <div class="box">
                  <div class="org">SFHQ G1</div>
                  <div class="status status_pending"><p>Pending</p></div>
                </div>
                <div class="dot dot1"></div><div class="dot dot2"></div>
                
                <div class="box">
                  <div class="org">D-Ops (Special Ops) Subject Clerk</div>
                  <div class="status status_pending"><p>Pending</p></div>
                </div>
                <div class="dot dot1"></div><div class="dot dot2"></div>
                
                <div class="box">
                  <div class="org">D-Ops (Special Ops) SO</div>
                  <div class="status status_pending"><p>Pending</p></div>
                </div>
                <div class="dot dot1"></div><div class="dot dot2"></div>
                
                <div class="box">
                  <div class="org">D-Ops (Coordination) Subject Clerk</div>
                  <div class="status status_pending"><p>Pending</p></div>
                </div>
                <div class="dot dot1"></div><div class="dot dot2"></div>
                
                <div class="box">
                  <div class="org">D-Ops (Coordination) SO</div>
                  <div class="status status_pending"><p>Pending</p></div>
                </div>
                <div class="dot dot1"></div><div class="dot dot2"></div>
                
                <div class="box">
                  <div class="org">D-Ops Director / G2</div>
                  <div class="status status_pending"><p>Pending</p></div>
                </div>
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


        // View details
        $("body").on("click",".view",function(){
            
            $('#myInput').trigger('focus')

            var leaveID = $(this).attr("id");

            $.ajax({
                url:"{{ url('') }}/auth_req_ltr_weapons_view_btn",
                method:'POST',
                // dataType:'json',
                data:{ "_token": "{{ csrf_token() }} " , leaveID:leaveID },
                success: function(response) {
                    $('.view_auth_req_lttr_troops_details').html(response)
                }
            });

        });

  })

</script>


</body>
</html>
