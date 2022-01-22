@extends('frontend.layouts.app')
@section('content')

    <div class="container user_panel">

        @php
            $is_date = false;
        if(Request::get('start_date') && Request::get('end_date')){
           $start = date( 'Y-m-d', strtotime(Request::get('start_date')));
           $end = date( 'Y-m-d', strtotime(Request::get('end_date')));
           $is_date = true;
        }

        @endphp


        @if (Route::has('login'))
            <div class="jumbotron" style="margin-top: 15px">
                <div class="row">

                    <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
                        <div class="man-service_one contactor-menu" style="background: #21729e">
                            <div class="">
                                <a target="_blank" class="Bn_lang" href="{{ url('contractor_apply') }}">
                                    <i class="fa fa-address-book" aria-hidden="true"></i>
                                    প্রোফাইল
                                </a>
                            </div>
                        </div>
                    </div>
                    @if($mdata)

                    <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
                        <div class="man-service_one contactor-menu" style="background: #9e5bba">
                            <div class="">
                                <a class="Bn_lang" href="{{'contractor_request'}}">
                                    <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                    আবেদন
                                </a>

                            </div>
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
                        <div class="man-service_one contactor-menu" style="background: #42cca2">
                            <div class="">
                                <a target="_blank" class="Bn_lang" href="{{ url('contractor_request') }}">
                                    <i class="fa fa-refresh" aria-hidden="true"></i>
                                    নবায়ন
                                </a>

                            </div>
                        </div>
                    </div>


                    <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
                        <div class="man-service_one contactor-menu" style="background: #e20400">
                            <div class="">
                                <a target="_blank" class="Bn_lang" href="{{ url('contractor_print/'.$mdata->id) }}">
                                    <i class="fa fa-print" aria-hidden="true"></i>
                                    প্রিন্ট
                                </a>

                            </div>
                        </div>
                    </div>
                        @endif




                </div>
            </div>


            <div>

                <!-- Nav tabs -->
                <ul class="nav nav-tabs p_nav_tabs" role="tablist">


                    <li role="presentation"><a href="#success_application" aria-controls="success_application" role="tab" data-toggle="tab">সফল আবেদন</a> </li>
                    <li role="presentation"> <a href="#cance_application" aria-controls="cance_application" role="tab"  data-toggle="tab">বাতিল আবেদন</a>  </li>
                    <li role="presentation"><a href="#all_application" aria-controls="all_application" role="tab" data-toggle="tab">সব আবেদন</a> </li>


                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="success_application">
                        @include('frontend.contractor.success_application')
                    </div>

                    <div role="tabpanel" class="tab-pane" id="cance_application">
{{--                        @include('frontend.service.land_lease.all_application')--}}
                    </div>

                    <div role="tabpanel" class="tab-pane" id="all_application">
                        @include('frontend.contractor.all_application')
                    </div>

                </div>

            </div>


        @endif
    </div>
@endsection

@section('cusjs')
    <script>
        $(document).ready(function () {

            // show active tab on reload
            if (location.hash !== '') $('a[href="' + location.hash + '"]').tab('show');

            // remember the hash in the URL without jumping
            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                if (history.pushState) {
                    var main = "{{url('my_shop')}}";
                    var has = '#' + $(e.target).attr('href').substr(1);

                    $('#market_f_searche').attr('action', main + has);
                    history.pushState(null, null, '#' + $(e.target).attr('href').substr(1));
                } else {
                    location.hash = '#' + $(e.target).attr('href').substr(1);
                }
            });


            master_function();
            $(function () {
                $(".date-pick").datepicker({format: 'dd-mm-yyyy'}).val();
            });


            function master_function() {


            }


            window.payment_option = function (self) {
                var id = $(self).data('id')
                var valu = $(self).val();
                var charge = $(self).data('charge');
                var total = $(self).data('total');
                var g_total = charge + total;
                $('#payment-charge' + id).val(charge);
                $('#payment-total' + id).val(g_total);
                // alert(charge + '--' + total)
                if (valu == 'Bkash' || valu == 'Nagat') {

                    $('#bkash-nogot-' + id).removeClass("hidden");
                    $('#bank-draft-' + id).addClass("hidden");

                } else {
                    $('#bkash-nogot-' + id).addClass("hidden");
                    $('#bank-draft-' + id).removeClass("hidden");
                }

                //alert('bkash-nogot-'+id);

            }

        });


    </script>
@endsection