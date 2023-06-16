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


    <section class="content table_auth_req_lttr_troops">
      <div class="container-fluid">
        <div class="row mb-2">
          <section class="col-lg-12 connectedSortable ui-sortable">
            <div class="card auth_req_lttr_form">

              <table class="table stripe hover row-border order-column" id="table_auth_req_lttr_troops">
                <thead>
                <tr>
                  <th>#Auth Req Ltr ID</th>
                  <th>Date</th>
                  <th>Request From</th>
                  <th>Status</th>
                  <th>Request To</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>

                <tbody>
                @foreach($auth_req_lttr_troops as $req_lttr)
                  <tr>
                      <td>{{$req_lttr->auth_req_lttr_troops_id}}</td>
                      <td>{{$req_lttr->date}}</td>
                      <td>
                        @if($req_lttr->req_fwd_by == 3)Establishment Head
                        @elseif($req_lttr->req_fwd_by == 4)Establishment Subject Clerk
                        @elseif($req_lttr->req_fwd_by == 6)Bde Comd
                        @elseif($req_lttr->req_fwd_by == 7)BM
                        @elseif($req_lttr->req_fwd_by == 9)Div Comd
                        @elseif($req_lttr->req_fwd_by == 10)Div Col GS
                        @elseif($req_lttr->req_fwd_by == 12)SFHQ BGS
                        @elseif($req_lttr->req_fwd_by == 13)SFHQ Col GS
                        @elseif($req_lttr->req_fwd_by == 14)SFHQ GSO I
                        @elseif($req_lttr->req_fwd_by == 15)SFHQ GSO II
                        @elseif($req_lttr->req_fwd_by == 16)SFHQ Subject Clerk
                        @elseif($req_lttr->req_fwd_by == 18)D-Ops Director
                        @elseif($req_lttr->req_fwd_by == 19)D-Ops SO (Special Ops)
                        @elseif($req_lttr->req_fwd_by == 20)D-Ops SO (Coordination Ops)
                        @elseif($req_lttr->req_fwd_by == 21)D-Ops Subject Clerk (Special Ops)
                        @elseif($req_lttr->req_fwd_by == 22)D-Ops Subject Clerk (Coordination Ops)
                        @endif
                      </td>
                      <td>{{$req_lttr->req_fwd_by_status}}</td>
                      <td>
                        @if($req_lttr->req_fwd_to == 3)Establishment Head
                        @elseif($req_lttr->req_fwd_to == 4)Establishment Subject Clerk
                        @elseif($req_lttr->req_fwd_to == 6)Bde Comd
                        @elseif($req_lttr->req_fwd_to == 7)BM
                        @elseif($req_lttr->req_fwd_to == 9)Div Comd
                        @elseif($req_lttr->req_fwd_to == 10)Div Col GS
                        @elseif($req_lttr->req_fwd_to == 12)SFHQ BGS
                        @elseif($req_lttr->req_fwd_to == 13)SFHQ Col GS
                        @elseif($req_lttr->req_fwd_to == 14)SFHQ GSO I
                        @elseif($req_lttr->req_fwd_to == 15)SFHQ GSO II
                        @elseif($req_lttr->req_fwd_to == 16)SFHQ Subject Clerk
                        @elseif($req_lttr->req_fwd_to == 18)D-Ops Director
                        @elseif($req_lttr->req_fwd_to == 19)D-Ops SO (Special Ops)
                        @elseif($req_lttr->req_fwd_to == 20)D-Ops SO (Coordination Ops)
                        @elseif($req_lttr->req_fwd_to == 21)D-Ops Subject Clerk (Special Ops)
                        @elseif($req_lttr->req_fwd_to == 22)D-Ops Subject Clerk (Coordination Ops)
                        @endif
                      </td>
                      <td>{{$req_lttr->req_fwd_to_status}}</td>
                      <td><a target="_blank" href="{{route('auth_req_lttr_troops_take_action')}}/{{$req_lttr->auth_req_lttr_troops_id}}" id="{{$req_lttr->auth_req_lttr_troops_id}}" class="btn btn-success edit">Take Action</a>
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
    <!-- <div class="modal fade" id="ApproveModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Authority Request Approve/Decline</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div class="modal-footer">

            <div class="col-md-12 ">
              <div class="form-group mb-3">
                <label for="request_forward" class="form-label">Request Forward to</label>
                <select name="request_forward" class="selectpicker form-control" id="request_forward" data-container="body" data-live-search="true" title="Select the Org Name" data-hide-disabled="true">
                    @if (isset($request_fwd_to))
                      @foreach($organization_types as $type)

                          @if (!in_array($type->id, [1,2,5,8,11,17]))
                              <option value="{{$type->id}}" @if($type->id == $request_fwd_to) selected @endif>{{$type->name}}</option>
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

            <button type="button" class="btn btn-success approve_btn">Approve and Forward</button>
            <button type="button" class="btn btn-danger decline_btn">Decline</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div> -->


  </div>

  <footer class="main-footer">
    @include('inc/footer')
  </footer>


</div>

@include('inc/footer_assets')

<script>

  $(document).ready(function() {

      // Datatable
      $('#table_auth_req_lttr_troops').DataTable();

  })

</script>


</body>
</html>
