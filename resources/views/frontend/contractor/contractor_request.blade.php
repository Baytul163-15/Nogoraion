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
        $request_fee = ($type == 'New')? $mdata->application_fee :  $mdata->renew_application_fee;

        @endphp


        @if (Route::has('login'))

            {{Form::open(array('url' => 'contractor_request_application', 'method' => 'post', 'autocomplete' => 'off'))}}
            <div class="form-group">
                <div class="radio">
                    <label>
                        <input type="radio" name="payment_info[payment_method]"
                               id="pm_bankdraft"
                               value="Bank draft" onchange="payment_option(this);" checked>
                        পে অর্ডার / ব্যাংক ড্রাফট
                    </label>
                </div>

                <div class="radio">
                    <label>
                        <input type="radio" name="payment_info[payment_method]"
                               id="pm_bkash"
                               value="Bkash" onchange="payment_option(this);">
                        বিকাশ
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="payment_info[payment_method]"
                               id="pm_nagot"
                               value="Nagat" onchange="payment_option(this);">
                        নগদ
                    </label>
                </div>
            </div>

                    {{ Form::hidden('application_type', $type, ['required','readonly']) }}


            <div class="form-group">
                <div class="input-group" style="margin-bottom: 5px">
                    <div class="input-group-addon" style="min-width: 165px">
                        <div class="input-group-text" id="rent_amount_co">টাকার
                            পরিমাণ ({{ e_to_b($type) }})
                        </div>
                    </div>
                    {{ Form::number('payment_info[amount]', $request_fee, ['required', 'class' => 'form-control', 'placeholder' => 'টাকার পরিমাণ..','readonly']) }}

                    <div class="input-group-addon">
                        <div class="input-group-text">টাকা</div>
                    </div>
                </div>
            </div>

            <div id="bank-draft">
                <div class="form-group">


                    <div class="input-group" style="margin-bottom: 5px">
                        <div class="input-group-addon" style="min-width: 165px">
                            <div class="input-group-text" id="rent_amount_co">পে অর্ডার
                                / ব্যাংক ড্রাফট নং
                            </div>
                        </div>
                        {{ Form::number('payment_info[payorder]', null, ['class' => 'form-control', 'placeholder' => 'পে অর্ডার / ব্যাংক ড্রাফট নং..','autocomplete' => 'off']) }}


                    </div>
                    <div class="input-group" style="margin-bottom: 5px">
                        <div class="input-group-addon" style="min-width: 165px">
                            <div class="input-group-text" id="rent_amount_co">তারিখ
                            </div>
                        </div>
                        {{ Form::text('payment_info[date]', null, ['class' => 'form-control date-pick', 'placeholder' => 'তারিখ..','autocomplete' => 'off']) }}


                    </div>
                    <div class="input-group" style="margin-bottom: 5px">
                        <div class="input-group-addon" style="min-width: 165px">
                            <div class="input-group-text" id="rent_amount_co">ব্যাংকের
                                নাম
                            </div>
                        </div>
                        {{ Form::text('payment_info[bank]', null, ['class' => 'form-control', 'placeholder' => 'ব্যাংকের নাম..','autocomplete' => 'off']) }}

                    </div>
                    <div class="input-group" style="margin-bottom: 5px">
                        <div class="input-group-addon" style="min-width: 165px">
                            <div class="input-group-text" id="rent_amount_co">শাখা</div>
                        </div>
                        {{ Form::text('payment_info[branch]', null, ['class' => 'form-control', 'placeholder' => 'শাখা..','autocomplete' => 'off']) }}

                    </div>

                </div>
            </div>

            <div id="bkash-nogot" class="hidden">
                <div class="form-group">


                    <div class="input-group" style="margin-bottom: 5px">
                        <div class="input-group-addon" style="min-width: 165px">
                            <div class="input-group-text" id="rent_amount_co">লেনদেন
                                নম্বর লিখুন
                            </div>
                        </div>
                        {{ Form::number('payment_info[number]', null, ['class' => 'form-control', 'placeholder' => ' লেনদেন নম্বর লিখুন...','autocomplete' => 'off']) }}


                    </div>
                    <div class="input-group" style="margin-bottom: 5px">
                        <div class="input-group-addon" style="min-width: 165px">
                            <div class="input-group-text" id="rent_amount_co">তারিখ
                            </div>
                        </div>
                        {{ Form::text('payment_info[date]', null, ['class' => 'form-control date-pick', 'placeholder' => 'তারিখ..','autocomplete' => 'off']) }}


                    </div>
                    <div class="input-group" style="margin-bottom: 5px">
                        <div class="input-group-addon" style="min-width: 165px">
                            <div class="input-group-text" id="rent_amount_co">
                                ট্রানস্যাকশন আইডি
                            </div>
                        </div>
                        {{ Form::text('payment_info[tid]', null, ['class' => 'form-control', 'placeholder' => 'ট্রানস্যাকশন আইডি..','autocomplete' => 'off']) }}

                    </div>
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('notes', 'যনোট / মন্তব্য', array('class' => 'notes')) }}
                {{ Form::textarea('payment_info[notes]', NULL, ['id' => null, 'rows' => 2, 'class' => 'form-control', 'placeholder' => 'যযনোট / মন্তব্য...','autocomplete' => 'off']) }}
                {{ Form::hidden('user_id', auth()->user()->id, []) }}


            </div>


            <button type="button" class="btn btn-danger" data-dismiss="modal">বাতিল
            </button>
            <button type="submit" class="btn btn-success pull-right">জমা দিন</button>

            {{ Form::close() }}

            <br>
            <br>
            <br>




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

                var valu = $(self).val();
                var charge = $(self).data('charge');
                var total = $(self).data('total');
                var g_total = charge + total;
                $('#payment-charge').val(charge);
                $('#payment-total').val(g_total);
                // alert(charge + '--' + total)
                if (valu == 'Bkash' || valu == 'Nagat') {
                    //  alert('woking');
                    $('#bkash-nogot').removeClass("hidden");
                    $('#bank-draft').addClass("hidden");

                } else {
                    //  alert('woking2');
                    $('#bkash-nogot').addClass("hidden");
                    $('#bank-draft').removeClass("hidden");
                }

                //alert('bkash-nogot-'+id);

            }

        });


    </script>
@endsection