@extends('layouts.app')


@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="pull-left">
                    <h2>Edit Role</h2>
                </div>
                <div class="text-end">
                    <a class="btn btn-dark mt-5 mb-2" href="{{ route('roles.index') }}"> Back</a>
                </div>
            </div>
        </div>
    </section>


    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="col-md-12">
        <div class="row">
            {!! Form::model($role, ['method' => 'PATCH','route' => ['roles.update', $role->id]]) !!}
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <strong class="mb-1 mt-1">Role Name</strong>
                    <div class="form-group">
                        {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control ibacor_fi' ,'id' =>'name','data-prefix'=>"{$orgType[0]['organization_type']}-")) !!}

                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Select Role Permissions</strong>
                        <br/>
                        @foreach($permission as $value)
                            <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                                {{ $value->name }}</label>
                            <br/>
                        @endforeach
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary float-right">Submit</button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>

    <footer class="main-footer">
        @include('inc/footer')
    </footer>

@endsection

@include('inc/footer_assets')

@push('page_css')

@endpush

@push('scripts')

    <script src="{{asset('/js/prefix/jquery.prefix-input.js')}}"></script>

@endpush
