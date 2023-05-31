@extends('layouts.app')

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Organization Resources</h1>
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
                            <div class="col-md-12">
                                <input type="hidden" value="{{isset($orgArmoury)?$orgArmoury[0]['armory_api_id']:''}}" id="armory_api_id">
                                Organization weapon details <span class="float-right">Armoury - {{isset($orgArmoury)?$orgArmoury[0]['armory']:''}}</span>
                            </div>

                            <div class="col-md-12">
                                <div class="dropdown">
                                    <label for="weaponList" class="form-label">Select Weapons</label>
                                    <select aria-hidden="true" id="weaponList" name="weaponList[]"
                                            class="form-control weapon-list" multiple="multiple">
                                        {{--@if(isset($selectedMapData))--}}
                                            {{--<option value="{{$selectedMapData[0]->armory_api_id}}">{{$selectedMapData[0]->armory}}</option>--}}
                                        {{--@else--}}
                                            {{--<option value="">Select Armoury</option>--}}
                                        {{--@endif--}}
                                    </select>
                                </div>
                            </div>
                            <div class="button-container mt-2">
                                <button type="button" class="btn btn-sm btn-primary" id="selectAll">Select All</button>
                                <button type="button" class="btn btn-sm btn-primary" id="deselectAll">Deselect All</button>
                            </div>
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

                        <div class="row">
                            <div class="col-md-12">
                                Organization strength details
                            </div>



                            <div class="col-md-12">
                                <div class="dropdown">
                                    <label for="strengthList" class="form-label">Select Person</label>
                                    <select aria-hidden="true" id="strengthList" name="strengthList[]"
                                            class="form-control weapon-list" multiple="multiple">
                                        {{--@if(isset($selectedMapData))--}}
                                        {{--<option value="{{$selectedMapData[0]->armory_api_id}}">{{$selectedMapData[0]->armory}}</option>--}}
                                        {{--@else--}}
                                        {{--<option value="">Select Armoury</option>--}}
                                        {{--@endif--}}
                                    </select>
                                </div>
                            </div>
                            <div class="button-container mt-2">
                                <button type="button" class="btn btn-sm btn-primary" id="selectAllStrength">Select All</button>
                                <button type="button" class="btn btn-sm btn-primary" id="deselectAllStrength">Deselect All</button>
                            </div>
                        </div>

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

            $('.weapon-list').select2({});


            let armouryId = $('#armory_api_id').val();

            //weapons
            $.ajax({
                url: 'http://10.7.113.86/wims/api/location_wpn/get_location_wpn.php?id='+armouryId,
                method: 'GET',
                cache: false,
                dataType: 'json',
                // data: {
                //     "str-token": "1189d8dde195a36a9c4a721a390a74e6"
                // },
                success: function (data) {
                    var weaponArray = [];
                    // console.log(data)
                    $.each(data.data, function (id, name) {
                        weaponArray.push({id: name.current_wpn_number, text: name.current_wpn_number +' - '+name.wpn_name});
                    });
                    $('#weaponList').select2({
                        data: weaponArray
                    });
                    $("#weaponList").next('span').find('span span').addClass("armoury-select");
                },
                error: function (e) {
                    // console.log(e)
                }
            });


            $('#selectAll').on('click', function () {
                selectAll()
            });
            $('#deselectAll').on('click', function () {
                deselectAll()
            });

            function selectAll() {
                $("#weaponList > option").prop("selected", true);
                $("#weaponList").trigger("change");
            }
            function deselectAll() {
                $("#weaponList > option").prop("selected", false);
                $("#weaponList").trigger("change");
            }






            //strength
            $.ajax({
                url: 'https://172.16.60.51/beta/api/get_establishments/',
                method: 'GET',
                cache: false,
                async: false,
                dataType: 'json',
                data: {
                    "str-token": "1189d8dde195a36a9c4a721a390a74e6"
                },
                success: function (data) {

                    var strengthArray = [];
                    $.each(data, function (id, name) {
                        strengthArray.push({id: name.id, text: name.name +' - '+name.abb});
                    });

                    $('#strengthList').select2({
                        data: strengthArray
                    });
                    $("#strengthList").next('span').find('span span').addClass("armoury-select");
                },
                error: function (e) {
                    console.log(e)
                }
            });




        });

    </script>
@endpush

@push('page_css')
    <style>
    .weapon-list
        {
            height: 35px !important;
        }


    .select2-container--default .select2-dropdown .select2-search__field:focus, .select2-container--default .select2-search--inline .select2-search__field:focus {
        outline: none !important;
        border: none !important;
        color: #fff;

    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #007bff;
        border-color: #006fe6;
        margin-left: 5px;
        margin-right: -2px;
        color: #fff;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice__display {
        cursor: default;
        padding-left: 10px;
        padding-right: 10px;
    }
    </style>

@endpush
