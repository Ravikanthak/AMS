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
            <h1>Dashboard</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
            </ol>
            </div>
        </div>
        </div>
    </section>



    <section class="content">
        <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                <h3>150</h3>

                <p>Strength</p>
                </div>
                <div class="icon">
                <i class="nav-icon fas fa-th"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
            </div>
            <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                <h3>3453</h3>

                <p>Weapon Count</p>
                </div>
                <div class="icon">
                <i class="nav-icon fas fa-th"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
            </div>
            <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                <h3>445</h3>

                <p>Establishments</p>
                </div>
                <div class="icon">
                <i class="nav-icon fas fa-th"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
            </div>
            <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                <h3>23</h3>

                <p>Daily Activities</p>
                </div>
                <div class="icon">
                <i class="nav-icon fas fa-th"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
            </div>
        </div>

        <div class="row">
            <section class="col-lg-7 connectedSortable ui-sortable">
            <div class="card">
                <div class="card-header ui-sortable-handle" style="cursor: move;">
                    <h3 class="card-title">
                    <i class="fas fa-chart-pie mr-1"></i>
                    Weapons
                    </h3>
                    <div class="card-tools">
                    <ul class="nav nav-pills ml-auto">
                        <li class="nav-item">
                        <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Area</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="#sales-chart" data-toggle="tab">Donut</a>
                        </li>
                    </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="tab-content p-0">
                    <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                        <canvas id="revenue-chart-canvas" height="375" style="height: 300px; display: block; width: 676px;" width="845" class="chartjs-render-monitor"></canvas>
                    </div>
                    <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
                        <canvas id="sales-chart-canvas" height="0" style="height: 0px; display: block; width: 0px;" width="0" class="chartjs-render-monitor"></canvas>
                    </div>
                    </div>
                </div>
                </div>
            </section>

            <section class="col-lg-5 connectedSortable ui-sortable">
            <div class="card">
                <div class="card-header ui-sortable-handle" style="cursor: move;">
                    <h3 class="card-title">
                    <i class="fas fa-chart-pie mr-1"></i>
                    Strength
                    </h3>
                    <div class="card-tools">
                    <ul class="nav nav-pills ml-auto">
                        <li class="nav-item">
                        <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Area</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="#sales-chart" data-toggle="tab">Donut</a>
                        </li>
                    </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="tab-content p-0">
                    <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                        <canvas id="revenue-chart-canvas" height="375" style="height: 300px; display: block; width: 676px;" width="845" class="chartjs-render-monitor"></canvas>
                    </div>
                    <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
                        <canvas id="sales-chart-canvas" height="0" style="height: 0px; display: block; width: 0px;" width="0" class="chartjs-render-monitor"></canvas>
                    </div>
                    </div>
                </div>
                </div>
            </section>

        </div>


    </section>

  </div>

  <footer class="main-footer">
    @include('inc/footer')
  </footer>


</div>

@include('inc/footer_assets')


<script>

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
