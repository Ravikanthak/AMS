<!DOCTYPE html>
<html lang="en">
<head>
  @include('inc/header')
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/jquery.dataTables.min.css" /> -->
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
            <h1>Add Organization</h1>
          </div>
        </div>
      </div>
    </section>
<!-- 
    <section class="content">
      <div class="container-fluid">
          <div class="row">
            <section class="col-lg-12 connectedSortable ui-sortable">
             
              <div class="card auth_req_lttr_form">

                  <div class="col-md-12 ">
                      <div class="form-group mb-3">
                          <label for="establishment" class="form-label">Select Organization Type</label>
                          <div class="dropdown">
                              <select class="form-select" name="establishment" id="establishment">
                                  <option value="unit">Unit</option>
                                  <option value="bde">Bde</option>
                                  <option value="div">Div</option>
                                  <option value="sfq">SFHQ/1 Corps</option>
                                  <option value="dops">D-Ops</option>
                              </select>
                          </div>
                      </div>
                  </div>

                  <div class="col-md-12">
                    <div class="col-md-8 m-0 float-left pl-0">
                      <div class="form-group">
                        <label for="establishment_name" class="form-label">Organization Name</label>
                        <input id="establishment_name" name="establishment_name" type="text" placeholder="" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-4 m-0 float-left pr-0">
                      <div class="form-group">
                        <label for="abbreviation" class="form-label">Abbreviation</label>
                        <input id="abbreviation" name="abbreviation" type="text" placeholder="" class="form-control">
                      </div>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group text-right">
                      <button id="add_establishment" type="submit" class="btn btn-primary">Add Establishment</button>
                    </div>
                  </div>

                </div>

            </section>
          </div>
      </div>
    </section>
 -->


    <section class="content table_establishments">
      <div class="container-fluid">
        <div class="row mb-2">
          <section class="col-lg-12 connectedSortable ui-sortable">
            <div class="card auth_req_lttr_form">

              <table class="table stripe hover row-border order-column" id="table_establishments">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Code</th>
                  <th>Mobile</th>
                  <th>Address</th>
                  <th>Category</th>
                  <th>Action</th>
                </tr>
                </thead>

                <tbody>
                @foreach($supplier as $sup)
                  <tr>
                      <td>{{$sup->id}}</td>
                      <td>{{$sup->username}}</td>
                      <td>{{$sup->code}}</td>
                      <td>{{$sup->mobile}}</td>
                      <td>{{$sup->address}}</td>
                      <td>{{$sup->category}}</td>
                      <td><a href="delete_sup_func/{{$sup->id}}" class="btn btn-danger">Delete</a><a href="datatable_edit/{{$sup->id}}" class="btn btn-primary">Edit</a></td>
                  </tr>
                @endforeach
                </tbody>
              </table>

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

<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready( function () {
        $('#table_establishments').DataTable();
    } );


    $("#add_establishment").click(function(){
        $.ajax({
            url:"{{ url('') }}/add_establishment_func",
            method:'POST',
            dataType: 'json',
            data:{ "_token": "{{ csrf_token() }}"},
            success:function(data){

              // if (data.msg == 'expired') {
              //   window.location.href = "";
              // }
              // else{
              //   $('.remaining_dates').html(data.msg)
              // }

            }
        })
    })

</script>


</body>
</html>
