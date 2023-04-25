@extends('layouts.app')

@section('content')

{{--<!DOCTYPE html>--}}
{{--<html lang="en">--}}
{{--<head>--}}
    {{--@include('inc/header')--}}
{{--</head>--}}

{{--<body class="hold-transition sidebar-mini layout-fixed">--}}

{{--<div class="wrapper">--}}

    {{--<nav class="main-header navbar navbar-expand navbar-white navbar-light">--}}
        {{--@include('inc/topnavbar')--}}
    {{--</nav>--}}

    {{--<aside class="main-sidebar sidebar-dark-primary elevation-4">--}}
        {{--@include('inc/sidebar')--}}
    {{--</aside>--}}



    {{--<div class="content-wrapper">--}}

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add Establishment Armory</h1>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <section class="col-lg-12 connectedSortable ui-sortable">

                        @if(!isset($selectedMapData[0]->id))
                            <form action="{{route('estb_armoury.store')}}" method="POST">
                        @else
                            <form method="POST" action="{{route('estb_armoury.update',$selectedMapData[0]->id)}}">
                        @method('PUT')
                        @endif
                        @csrf

                            <div class="card auth_req_lttr_form">

                                <div class="col-md-12 ">
                                    <div class="form-group mb-3">
                                        <label for="establishment" class="form-label">Select Establishment</label>
                                        <div class="dropdown">
                                            <select id="establishment" name="establishment" class="form-select">
                                                <option value="dit" {{isset($selectedMapData[0]->establishment)?($selectedMapData[0]->establishment=='dit')?'selected':'':''}}>dit</option>
                                                <option value="12-SLSC" {{isset($selectedMapData[0]->establishment)?($selectedMapData[0]->establishment=='12-SLSC')?'selected':'':''}}>12 SLSC</option>
                                                <option value="11-SLSC" {{isset($selectedMapData[0]->establishment)?($selectedMapData[0]->establishment=='11-SLSC')?'selected':'':''}}>11 SLSC</option>
                                                <option value="10-SLSC" {{isset($selectedMapData[0]->establishment)?($selectedMapData[0]->establishment=='10-SLSC')?'selected':'':''}}>10 SLSC</option>
                                                <option value="6-SLSC" {{isset($selectedMapData[0]->establishment)?($selectedMapData[0]->establishment=='6-SLSC')?'selected':'':''}}>6 SLSC</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-12 ">
                                    <div class="form-group mb-3">
                                        <label for="armory" class="form-label">Select Armory</label>
                                        <div class="dropdown">
                                            <select id="armory" name="armory" class="form-select">
                                                <option value="armoury-1" {{isset($selectedMapData[0]->armory)?($selectedMapData[0]->armory=='armoury-1')?'selected':'':''}}>Armoury 1</option>
                                                <option value="armoury-2" {{isset($selectedMapData[0]->armory)?($selectedMapData[0]->armory=='armoury-2')?'selected':'':''}}>Armoury 2</option>
                                                <option value="armoury-3" {{isset($selectedMapData[0]->armory)?($selectedMapData[0]->armory=='armoury-3')?'selected':'':''}}>Armoury 3</option>
                                                <option value="armoury-4" {{isset($selectedMapData[0]->armory)?($selectedMapData[0]->armory=='armoury-4')?'selected':'':''}}>Armoury 4</option>
                                                <option value="armoury-5" {{isset($selectedMapData[0]->armory)?($selectedMapData[0]->armory=='armoury-5')?'selected':'':''}}>Armoury 5</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    @if(!isset($selectedMapData[0]->id))
                                    <div class="form-group text-right">
                                        <button id="create_user" type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                    @else
                                    <div class="form-group text-right">
                                        <button id="create_user" type="submit" class="btn btn-primary">update</button>
                                    </div>
                                    @endif
                                </div>

                            </div>

                        </form>
                        </form>

                    </section>
                </div>
            </div>
        </section>

        <section class="content table_establishment_armory">
            <div class="container-fluid">
                <div class="row mb-2">
                    <section class="col-lg-12 connectedSortable ui-sortable">
                        <div class="card auth_req_lttr_form">

                            <table class="table stripe hover row-border order-column" id="table_establishment_armoury">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Establishment</th>
                                    <th>Armory</th>
                                    <th>Action</th>
                                </tr>
                                </thead>

                                <tbody>

                                </tbody>
                            </table>

                        </div>
                    </section>
                </div>
            </div>
        </section>

    {{--</div>--}}

    <footer class="main-footer">
        @include('inc/footer')
    </footer>


{{--</div>--}}

{{--@include('inc/footer_assets')--}}

@endsection

@include('inc/footer_assets')


@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://172.16.60.28/omms/test2/public/js/datepicker/datepicker.js"></script>
<script>



    $( document ).ready(function() {
        establishmentArmoryTable();
    });

    function establishmentArmoryTable()
    {
        //dtaTable
        $('#table_establishment_armoury').DataTable({
            // responsive: true,
            // processing: true,
            serverSide: true,
            ajax: {
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: '{{url("/get-establishment-armory-dt")}}',
                type: "POST",
                dataType: "json",
            },
            rowId: 'id',
            columns: [
                {
                    "data": null, "render": function (data, type, full, meta) {
                        return meta.row + 1;
                    }
                },
                {data: 'establishment', name: 'establishment'},
                {data: 'armory', name: 'armory'},
                {data: 'action', name: 'action'},

            ]
        });



    }

</script>
@endpush

{{--</body>--}}
{{--</html>--}}
