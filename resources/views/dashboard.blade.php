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
                        <h1>{{ isset($userOrg)?$userOrg:'' }}</h1>
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



                    @if(\Illuminate\Support\Facades\Auth::user()->user_type ==1)
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

                    @else
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
                    @endif
                </div>

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
