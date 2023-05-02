@extends('layouts.app')

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Role Management</h1>
                </div>
            </div>
            <div class="pull-right">
                {{--                @can('role-create')--}}
                <a class="btn btn-success" href="{{ route('roles.create') }}"> Create New Role</a>
                {{--@endcan--}}
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <section class="col-lg-12 connectedSortable ui-sortable">

                    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($roles as $key => $role)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $role->name }}</td>
                <td>
                    {{--@can('role-edit')--}}
                        <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">Edit</a>
                    {{--@endcan--}}
{{--                    @can('role-delete')--}}
                        {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    {{--@endcan--}}
                </td>
            </tr>
        @endforeach
    </table>

                </section>
            </div>
        </div>
    </section>

    <footer class="main-footer">
        @include('inc/footer')
    </footer>


    {!! $roles->render() !!}


@endsection

@include('inc/footer_assets')

@push('page_css')

@endpush

@push('scripts')

@endpush