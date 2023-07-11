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
                    <h1>Map Organization Armory</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <section class="col-lg-12 connectedSortable ui-sortable">

                    @if(!isset($selectedMapData[0]->id))
                        <form action="{{route('org_armoury.store')}}" method="POST">
                            @else
                                <form method="POST" action="{{route('org_armoury.update',$selectedMapData[0]->id)}}">
                                    @method('PUT')
                                    @endif
                                    @csrf

                                    <div class="card auth_req_lttr_form">
                                        {{--{{Auth::user()->id}}--}}
                                        {{--{{Auth::user()->id}}--}}
                                        <div class="col-md-12 ">
                                            <div class="form-group mb-3">
                                                <input type="hidden" id="org_text" name="org_text" value="{{isset($selectedMapData[0]->organization)?$selectedMapData[0]->organization:''}}">
                                                <label for="organization" class="form-label">Select
                                                    Organization</label>
                                                <div class="dropdown">
                                                    <select id="organization" name="organization"
                                                            class="form-select organization-select">
                                                        @if(isset($selectedMapData))
                                                            <option value="{{$selectedMapData[0]->organization}}">{{$selectedMapData[0]->organization}}</option>
                                                        @else
                                                            <option value="">Select Organization</option>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-md-12 ">
                                            <div class="form-group mb-3">
                                                <label for="armoury" class="form-label">Select
                                                    Armoury</label>
                                                <div class="dropdown">
                                                    <select id="armoury" name="armoury"
                                                            class="form-select armoury-select">
                                                        @if(isset($selectedMapData))
                                                            <option value="{{$selectedMapData[0]->armory_api_id}}">{{$selectedMapData[0]->armory}}</option>
                                                        @else
                                                            <option value="">Select Armoury</option>
                                                        @endif
                                                    </select>
                                                </div>
                                                <input type="hidden" id="selected_armoury" name="selected_armoury"
                                                       value="{{isset($selectedMapData[0]['armory'])?$selectedMapData[0]['armory']:''}}">
                                            </div>
                                        </div>


                                        <div class="col-md-12 ">
                                            <div class="form-group mb-3">
                                                <label for="organization_type" class="form-label">Select Organization
                                                    Type</label>
                                                <div class="dropdown">
                                                    {{--<select class="form-select" name="organization_type"--}}
                                                    {{--id="organization_type">--}}
                                                    {{--                                                        <option value="unit" {{ isset($selectedMapData[0]->organization_type)?$selectedMapData[0]->organization_type=='unit'?'selected':'':'' }}>Unit</option>--}}
                                                    {{--<option value="estb" {{ isset($selectedMapData[0]->organization_type)?$selectedMapData[0]->organization_type=='estb'?'selected':'':'' }}>Establishment</option>--}}
                                                    {{--<option value="bde" {{ isset($selectedMapData[0]->organization_type)?$selectedMapData[0]->organization_type=='bde'?'selected':'':'' }}>Bde</option>--}}
                                                    {{--<option value="div" {{ isset($selectedMapData[0]->organization_type)?$selectedMapData[0]->organization_type=='div'?'selected':'':'' }}>Div</option>--}}
                                                    {{--<option value="sfhq" {{ isset($selectedMapData[0]->organization_type)?$selectedMapData[0]->organization_type=='sfhq'?'selected':'':'' }}>SFHQ/1 Corps</option>--}}
                                                    {{--<option value="dops" {{ isset($selectedMapData[0]->organization_type)?$selectedMapData[0]->organization_type=='dops'?'selected':'':'' }}>D-Ops</option>--}}
                                                    {{--</select> --}}

                                                    <select class="form-select" name="organization_type"
                                                            id="organization_type">
                                                        <option value="" selected="selected">Select type</option>
                                                        @foreach($orgTypes as $orgType)
                                                            <option value="{{$orgType->abbreviation}}" {{isset($selectedMapData[0]->organization_type)?($orgType->abbreviation==$selectedMapData[0]->organization_type)?'selected="selected"':'':''}}>{{$orgType->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-md-12">
                                            @if(!isset($selectedMapData[0]->id))
                                                <div class="form-group text-right">
                                                    <button id="create_user" type="submit" class="btn btn-primary">
                                                        Submit
                                                    </button>
                                                </div>
                                            @else
                                                <div class="form-group text-right">
                                                    <button id="create_user" type="submit" class="btn btn-primary mr-1">
                                                        update
                                                    </button>

                                                    <a class="btn btn-secondary float-right mr-1" type="button"
                                                       href="{{route('org_armoury.index')}}">Cancel</a>
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

    <section class="content table_organization_armory">
        <div class="container-fluid">
            <div class="row mb-2">
                <section class="col-lg-12 connectedSortable ui-sortable">
                    <div class="card auth_req_lttr_form">

                        <table class="table stripe hover row-border order-column" id="table_organization_armoury">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Organization</th>
                                <th>Type</th>
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


@push('page_css')
    <style>
        .organization-select {
            height: 35px !important;
        }

        .armoury-select {
            height: 35px !important;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>




    <script>


        $(document).ready(function () {
            organizationArmoryTable();

            $('.organization-select').select2({});
            $('.armoury-select').select2({});

            // $("#organization").next('span').find('span:nth-child(2)').addClass("organization-select");
            $("#organization").next('span').find('span span').addClass("organization-select");
            $("#armoury").next('span').find('span span').addClass("armoury-select");
        });


        function organizationArmoryTable() {
            //dtaTable
            $('#table_organization_armoury').DataTable({
                // responsive: true,
                // processing: true,
                serverSide: true,
                ajax: {
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: '{{url("/get-organization-armory-dt")}}',
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
                    {data: 'organization', name: 'organization'},
                    {data: 'organization_type', name: 'organization_type'},
                    {data: 'armory', name: 'armory'},
                    {data: 'action', name: 'action'},

                ]
            });


            //Organizations
            $('#organization').change(function () {

                $orgText = $('#organization').select2('data')[0].text;
                $('#org_text').val($orgText);
            });
            $(document).ready(function () {
                // $('#organization').change(function () {
                $.ajax({
                    url: 'https://172.16.60.51/beta/api/get_establishments/',
                    // url: 'https://172.16.60.51/beta/api/get_establishments/?&str-token=1189d8dde195a36a9c4a721a390a74e6',
                    method: 'GET',
                    cache: false,
                    async: false,
                    dataType: 'json',
                    data: {
                        "str-token": "1189d8dde195a36a9c4a721a390a74e6"
                    },
                    success: function (data) {

                        var organizationArray = [];
                        $.each(data, function (id, name) {
                            organizationArray.push({id: name.id, text: name.name});
                        });
                        // console.log(organizationArray)

                        $('#organization').select2({
                            data: organizationArray
                        });
                        $("#organization").next('span').find('span span').addClass("organization-select");
                    },
                    error: function (e) {

                        console.log(e)
                    }
                });
                // });
            });


            $('#armoury').change(function () {
                $('#selected_armoury').val($('#armoury').select2('data')[0].text);
            });


            //Armory
            $(document).ready(function () {
                // $('#organization').change(function () {
                $.ajax({
                    url: 'http://10.7.113.86/wims/api/location_wpn/read_location.php',
                    method: 'GET',
                    cache: false,
                    dataType: 'json',
                    // data: {
                    //     "str-token": "1189d8dde195a36a9c4a721a390a74e6"
                    // },
                    success: function (data) {

                        var armouryArray = [];
                        $.each(data.data, function (id, name) {
                            // console.log(name.loc_name)
                            armouryArray.push({id: name.loc_id, text: name.loc_name});
                        });

                        $('#armoury').select2({
                            data: armouryArray
                        });
                        $("#armoury").next('span').find('span span').addClass("armoury-select");
                    },
                    error: function (e) {
                        // console.log(e)
                    }
                });
                // });
            });


        }

    </script>
@endpush


{{--</body>--}}
{{--</html>--}}
