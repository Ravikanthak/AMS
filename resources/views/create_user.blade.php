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
@extends('layouts.app')

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    @if(Auth::user()->user_type ==1)
                        <h1>Create Establishment Admin</h1>
                    @else
                        <h1>Create Establishment User</h1>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <section class="col-lg-12 connectedSortable ui-sortable">

                    <div class="card auth_req_lttr_form">

                        <div class="row">


                            <div class="col-md-3 offset-md-8">
                                <div class="form-group">
                                    <label for="officer_number" class="form-label">Officer/Solder Number</label>
                                    <input placeholder="O/12345" type="text" class="form-control" value=""
                                           name="officer_number" id="officer_number">
                                    <input type="hidden" name="orgId" id="orgId" value="{{isset($orgId)?$orgId:null}}">
                                </div>
                            </div>
                            <div class="col-md-1 mt-4 pt-2">
                                <div class="form-group">
                                    <input class="btn btn-primary float-right" type="button" value="Search"
                                           id="searchOfficer">
                                </div>
                            </div>


                            <form id="service_data_form" method="POST" action="{{route('admin.store')}}">
                                @csrf
                                <div class="row mt-5">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="full_name" class="form-label">Full Name</label>
                                            <input readonly type="text" class="form-control" name="full_name"
                                                   id="full_name" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="gender" class="form-label">Gender</label>
                                            <input readonly type="text" class="form-control" name="gender" id="gender"
                                                   value="">
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="active_service" class="form-label">Active Service</label>
                                            <input readonly type="text" class="form-control" name="active_service"
                                                   id="active_service" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="e_number" class="form-label">E-Number</label>
                                            <input readonly type="text" class="form-control" name="e_number"
                                                   id="e_number" value="">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="service_number" class="form-label">Service Number</label>
                                            <input readonly type="text" class="form-control" name="service_number"
                                                   id="service_number" value="">
                                            @error('service_number')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="rank" class="form-label">Rank</label>
                                            <input readonly type="text" class="form-control" name="rank" id="rank"
                                                   value="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="regiment" class="form-label">Regiment</label>
                                            <input readonly type="text" class="form-control" name="regiment"
                                                   id="regiment" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="unit" class="form-label">Unit</label>
                                            <input readonly type="text" class="form-control" name="unit" id="unit"
                                                   value="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nic" class="form-label">NIC</label>
                                            <input readonly type="text" class="form-control" name="nic" id="nic"
                                                   value="">
                                        </div>
                                    </div>

                                    @if(Auth::user()->user_type ==1)
                                        <div class="col-md-12 ">
                                            <div class="form-group mb-3">
                                                <label for="organization" class="form-label">Organization</label>
                                                <div class="dropdown">
                                                    <select class="form-select" name="organization" id="organization">
                                                        <option value="0" selected="selected">Select Organization
                                                        </option>
                                                        @foreach($organizations as $organization)
                                                            <option value="{{$organization->id}}">{{$organization->organization}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    @if(Auth::user()->user_type !=1)
                                        <div class="col-md-12 ">
                                            <div class="form-group mb-3">
                                                <label for="user_type" class="form-label">User Type</label>
                                                <select class="form-select" name="user_type" id="user_type">
                                                </select>
                                            </div>
                                        </div>
                                    @endif


                                    <div class="col-md-12">
                                        <div class="form-group pl-4 mt-4">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input"
                                                       {{isset($admin->active)?$admin->active==1?'checked':'':'checked'}} type="checkbox"
                                                       role="switch" id="admin_status" name="admin_status">
                                                <label class="form-check-label label-font-weight" for="availability">Account
                                                    Active</label>
                                                <input type="hidden" id="active" name="active"
                                                       value="{{isset($admin->active)?$admin->active==1?'1':'0':'1'}}">
                                            </div>
                                        </div>
                                    </div>


                                    @if(Auth::user()->user_type !=1)

                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <strong>Role</strong>
                                                @if($roles)
                                                    {{--                                            {!! Form::select('roles[]', $roles,[], array('class' => 'form-control','multiple')) !!}--}}
                                                    {!! Form::select('roles', $roles,[], array('class' => 'form-control', 'id' => 'roles')) !!}
                                                    <input type="hidden" id="userType"
                                                           value="{{Auth::user()->user_type}}">
                                                @endif
                                            </div>
                                        </div>

                                    @endif


                                    <div class="col-md-12">
                                        <div class="form-group text-right">
                                            <button id="create_user" type="submit" class="btn btn-primary">Submit
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>

                    </div>

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
                                <th>Name</th>
                                <th>Organization</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php $i = 0; ?>

                            @foreach ($admins as $admin)
                                <tr id="{{$admin->id}}">
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $admin->name }}</td>
                                    <td>{{ $admin->organization }}</td>
                                    <td>{{  preg_replace('/\\s+/', '', $admin->role) }}</td>
                                    <td>
                                        {{--<button class="btn btn-sm btn-dark">Deactivate</button>--}}
                                        {{--<button class="ml-2 btn btn-sm btn-warning admin-edit">Edit</button>--}}
                                    </td>
                                </tr>
                            @endforeach
                            <tbody>
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
@endsection

@include('inc/footer_assets')

@push('scripts')
    <script src="https://172.16.60.28/omms/test2/public/js/datepicker/datepicker.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>

        $(document).ready(function () {

            if ($('#orgId').val() != null) {
                let orgIdVal = $('#orgId').val();
                getUserType(orgIdVal)
            }

            var location_name = $("#location_name").val();
            var account_type = $("#account_type").val();
            var username = $("#username").val();
            var password = $("#password").val();

            //get user data
            $('#searchOfficer').click(function () {

                var officer_number = $('#officer_number').val();
                $.ajax({
                    url: 'https://str.army.lk/api/get_person/',
                    // url: 'https://172.16.60.51/beta/api/get_person/',
                    method: 'POST',
                    cache: false,
                    dataType: 'json',
                    data: {
                        "service_no": officer_number,
                        "str-token": "1189d8dde195a36a9c4a721a390a74e6"
                    },
                    success: function (data) {

                        if (typeof(data[0]) == "undefined") {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'error',
                                title: 'Service number not found',
                                showConfirmButton: false,
                                timer: 1500
                            });

                            $('#service_data_form')[0].reset();
                        }
                        else {
                            $name = data[0]['name'];
                            $e_no = data[0]['e_no'];
                            $service_no = data[0]['service_no'];
                            $rank = data[0]['rank'];
                            $regiment = data[0]['regiment'];
                            $unit = data[0]['unit'];
                            $nic = data[0]['nic'];
                            $gender = data[0]['gender'];
                            $active_service = data[0]['active_service'];

                            $('#full_name').val($name);
                            $('#e_number').val($e_no);
                            $('#service_number').val($service_no);
                            $('#rank').val($rank);
                            $('#unit').val($unit);
                            $('#regiment').val($regiment);
                            $('#nic').val($nic);
                            $('#gender').val($gender);
                            $('#active_service').val($active_service);
                        }


                    },
                    error: function (error) {
                        alert('2')
                    }

                });
            });


            //edit user data
            $('.admin-edit').click(function () {

                let userId = $(this).closest('tr').attr('id');

                var url = '{{ url("/admin/") }}/' + userId+'/edit';

                $.ajax({
                    url: url,
                    method: 'get',
                    dataType: 'json',
                    data: {userId:userId},
                    success: function (data) {


                    }
                })
            });


        });


        //get organization type
        $('#organization').change(function () {

            var organization = $('#organization').val();
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                dataType: 'json',
                url: '{{route("get-organization-type")}}',
                type: 'post',
                data: {
                    organization: organization,
                },
                success: function (data) {


                    if (data[0].organization_type == 'estb') {
                        jQuery("#roles option:contains('estb-')").show();
                        jQuery("#roles option:not(:contains('estb-'))").hide();
                    }
                    else if (data[0].organization_type == 'bde') {
                        jQuery("#roles option:contains('bde-')").show();
                        jQuery("#roles option:not(:contains('bde-'))").hide();
                    }
                    else if (data[0].organization_type == 'div') {
                        jQuery("#roles option:contains('div-')").show();
                        jQuery("#roles option:not(:contains('div-'))").hide();
                    }
                    else if (data[0].organization_type == 'sfhq') {
                        jQuery("#roles option:contains('sfhq-')").show();
                        jQuery("#roles option:not(:contains('sfhq-'))").hide();
                        // jQuery("#roles option:not(:contains('sfhq-'))").remove().end();    REMOVE
                    }
                    else {
                        if ($('#userType').val() == 1) {
                            jQuery("#roles option:contains('dops-admin')").show();
                        }
                        else {
                            jQuery("#roles option:contains('dops-')").show();
                            jQuery("#roles option:not(:contains('dops-'))").hide();
                        }

                    }

                }
            });
        });


        //user Type
        $('#organization').change(function () {

            let orgId = $('#organization').val();
            getUserType(orgId)
        });


        function getUserType(orgId) {

            if (orgId !== '0') {
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    dataType: 'json',
                    url: '{{url("/get-admin-user-type")}}',
                    type: 'POST',
                    data: {orgId: orgId},
                    success: function (data) {

                        $('#user_type').empty();
                        $.each(data, function (i, item) {
                            $('#user_type').append($('<option>', {
                                value: item.id,
                                text: item.name
                            }));
                        });
                    }
                });
            }
        }


    </script>
@endpush

{{--</body>--}}
{{--</html>--}}
