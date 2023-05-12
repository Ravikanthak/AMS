@extends('layouts.app')

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Role Management</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="col-md-12">
        <div class="text-end mt-5 mb-2">
            <a class="btn btn-dark" href="{{ route('roles.create') }}"> Create New Role</a>
        </div>
        <div class="card">
            <div class="card-body">
                <table id="roleTbl" class="display" style="width:100%">
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
                                <a class="btn btn-primary btn-sm" href="{{ route('roles.edit',$role->id) }}">Edit</a>
                                {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                    <tbody>
                </table>
                {!! $roles->render() !!}
            </div>
        </div>


    </div>

    <div class="col-md-12">
        <footer class="footer-div">
            @include('inc/footer')
        </footer>
    </div>



@endsection

@include('inc/footer_assets')

@push('page_css')

    <style>
        .footer-div
        {
            background-color: #fff;
            border-top: 1px solid #dee2e6;
            color: #869099;
            padding: 1rem;
        }
    </style>

@endpush

@push('scripts')


    <script>

        $(document).ready(function () {

            $('#userTbl').DataTable();


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