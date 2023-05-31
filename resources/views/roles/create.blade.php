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
            Error<br><br>
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
                    {{--<strong class="mb-1 mt-1">Role Name</strong>--}}
                    <div class="form-group">
                        @if(isset($orgType[0]['organization_type']))
                        {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control ibacor_fi' ,'id' =>'name', 'data-prefix'=>"{$orgType[0]['organization_type']}-")) !!}
                        @else
                            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control ibacor_fi' ,'id' =>'name', 'data-prefix'=>"{}-")) !!}
                        @endif

                                {{--<label for="name" class="form-label">Role Name</label>--}}
                                {{--<select id="name" class="select2-single form-control" name="name" autocomplete="off">--}}
                                    {{--<option value="" selected="selected">Select the name</option>--}}
                                    {{--<option value="Establishment Admin">Establishment Admin</option>--}}
                                    {{--<option value="Establishment Head">Establishment Head</option>--}}
                                    {{--<option value="Establishment Subject Clerk">Establishment Subject Clerk</option>--}}

                                    {{--<option value="Bde Admin">Bde Admin</option>--}}
                                    {{--<option value="Bde Comd">Bde Comd</option>--}}
                                    {{--<option value="Bde M">Bde M</option>--}}

                                    {{--<option value="Div Admin">Div Admin</option>--}}
                                    {{--<option value="Div Comd">Div Comd</option>--}}
                                    {{--<option value="Div Col GS">Div Col GS</option>--}}

                                    {{--<option value="SFHQ Admin">SFHQ Admin</option>--}}
                                    {{--<option value="SFHQ BGS">SFHQ BGS</option>--}}
                                    {{--<option value="SFHQ Col GS">SFHQ Col GS</option>--}}
                                    {{--<option value="SFHQ GSO I">SFHQ GSO I</option>--}}
                                    {{--<option value="SFHQ GSO II">SFHQ GSO II</option>--}}
                                    {{--<option value="SFHQ Subject Clerk">SFHQ Subject Clerk</option>--}}

                                    {{--<option value="D-Ops Admin">D-Ops Admin</option>--}}
                                    {{--<option value="D-Ops Director">D-Ops Director</option>--}}
                                    {{--<option value="D-Ops SO (Special Ops)">D-Ops SO (Special Ops)</option>--}}
                                    {{--<option value="D-Ops SO (Coordination Ops)">D-Ops SO (Coordination Ops)</option>--}}
                                    {{--<option value="D-Ops Subject Clerk (Special Ops)">D-Ops Subject Clerk (Special Ops)</option>--}}
                                    {{--<option value="D-Ops Subject Clerk (Coordination Ops)">D-Ops Subject Clerk (Coordination Ops)</option>--}}
                                {{--</select>--}}

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


    <script src="{{asset('/js/prefix/jquery.prefix-input.js')}}"></script>

    <script>
        $(document).ready(function () {

            $('.select2-single').select2({});

        });
    </script>

@endpush