@extends('layouts.app')

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Role Management</h1>
                </div>
                <div class="text-end">
                    <a class="btn btn-dark" href="{{ route('roles.create') }}"> Create New Role</a>
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
                            <section class="col-lg-12 connectedSortable ui-sortable">

                                <table id="roleTbl" class="table stripe hover row-border order-column">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th width="110px">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($roles as $key => $role)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $role->name }}</td>
                                            <td class="text-end">
                                                <a class="btn btn-primary btn-sm"
                                                   href="{{ route('roles.edit',$role->id) }}">Edit</a>
                                                {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
                                                {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                                                {!! Form::close() !!}
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tbody>
                                </table>
                                {{--                {!! $roles->render() !!}--}}
                            </section>
                        </div>

                    </div>
                </section>
            </div>
        </div>
    </section>



    <div class="col-md-12">
        <footer class="main-footer">
            @include('inc/footer')
        </footer>
    </div>



@endsection

@include('inc/footer_assets')

@push('page_css')

    {{--datatable--}}
    {{--<link rel="stylesheet" href="https://cdn.datatables.net/autofill/2.5.3/css/autoFill.dataTables.min.css" />--}}

    <style>
        .footer-div {
            background-color: #fff;
            border-top: 1px solid #dee2e6;
            color: #869099;
            padding: 1rem;
        }
    </style>

@endpush

@push('scripts')

    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>


    <script>

        $(document).ready(function () {

            $('#roleTbl').DataTable();


            {{--//deactivate--}}
            {{--$('#userTbl').on('click', '.btn-staff-deactive', function () {--}}

            {{--let staffId = $(this).closest('tr').attr('id');--}}

            {{--let text = "De-active this user?";--}}
            {{--if (confirm(text) == true) {--}}

            {{--$.ajax({--}}
            {{--headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},--}}
            {{--dataType: 'json',--}}
            {{--url: '{{route('staff-deactivate')}}',--}}
            {{--type: 'POST',--}}
            {{--data: {staffId: staffId},--}}
            {{--success: function (response) {--}}
            {{--// alert('User De-Activated');--}}
            {{--// location.reload();--}}
            {{--Swal.fire({--}}
            {{--position: 'top-end',--}}
            {{--icon: 'success',--}}
            {{--title: 'User deactivated',--}}
            {{--showConfirmButton: false,--}}
            {{--timer: 1500--}}
            {{--})--}}
            {{--setTimeout(function () {--}}
            {{--location.reload()--}}
            {{--}, 1500);--}}
            {{--},--}}
            {{--});--}}
            {{--}--}}
            {{--});--}}


        });

    </script>

@endpush