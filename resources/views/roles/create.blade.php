@extends('layouts.app')

@section('content')


    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="pull-left">
                    <h2>Create New Role</h2>
                </div>
                <div class="text-end">
                    <a class="btn btn-dark mt-5 mb-2" href="{{ route('roles.index') }}">Back</a>
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
            {!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <strong class="mb-1 mt-1">Role Name</strong>
                    <div class="form-group">
                        {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <strong class="mt-1">Select Role Permissions</strong>
                    <div class="form-group">
                        <br/>
                        @foreach($permission as $value)
                            <label>{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
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

@endpush