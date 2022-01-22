

<div class="modal fade" id="payment-option-land-{{$list->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            {{Form::open(array('url' => 'contractor_final_payment', 'method' => 'post'))}}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">

                </h4>
            </div>
            <div class="modal-body">
                @php
                $con_set = App\ContactorSettings::get()->first();
                //dd($con_set);
                    $tax_p = $con_set->contractor_tax;
                    $tax_a = round((($con_set->contractor_fee*$tax_p)/100),2);
                    $vat_p = $con_set->contractor_vat;
                    $vat_a = round((($con_set->contractor_fee*$vat_p)/100),2);

                @endphp

                    {{ Form::hidden('id', $list->id, ['required']) }}
                <div class="form-group">
                    {{ Form::label('fee_info', 'ইজারার টাকার পরিমান', array('class' => 'fee_info', 'autocomplete' => 'off')) }}
                    <div class="input-group" style="margin-bottom: 5px">
                        <div class="input-group-addon" style="min-width: 165px">
                            <div class="input-group-text" id="rent_amount_co">টাকার পরিমাণ</div>
                        </div>
                        {{ Form::number('fee_info[amount]',  $con_set->contractor_fee, ['required', 'class' => 'form-control', 'placeholder' => 'টাকার পরিমাণ..', 'readonly']) }}

                        <div class="input-group-addon">
                            <div class="input-group-text">টাকা</div>
                        </div>
                    </div>
                    <div class="input-group" style="margin-bottom: 5px">
                        <div class="input-group-addon" style="min-width: 165px">
                            <div class="input-group-text" id="rent_amount_co">পে অর্ডার / ব্যাংক ড্রাফট নং  </div>
                        </div>
                        {{ Form::number('fee_info[payorder]', null , ['required', 'class' => 'form-control', 'placeholder' => 'পে অর্ডার / ব্যাংক ড্রাফট নং..', 'autocomplete' => 'off']) }}


                    </div>
                    <div class="input-group" style="margin-bottom: 5px">
                        <div class="input-group-addon" style="min-width: 165px">
                            <div class="input-group-text" id="rent_amount_co">তারিখ </div>
                        </div>
                        {{ Form::text('fee_info[date]', NULL, ['required', 'class' => 'form-control date-pick', 'placeholder' => 'তারিখ..', 'autocomplete' => 'off']) }}


                    </div>
                    <div class="input-group" style="margin-bottom: 5px">
                        <div class="input-group-addon" style="min-width: 165px">
                            <div class="input-group-text" id="rent_amount_co">ব্যাংকের নাম </div>
                        </div>
                        {{ Form::text('fee_info[bank]',  NULL, ['required', 'class' => 'form-control', 'placeholder' => 'ব্যাংকের নাম..', 'autocomplete' => 'off']) }}


                    </div>
                    <div class="input-group" style="margin-bottom: 5px">
                        <div class="input-group-addon" style="min-width: 165px">
                            <div class="input-group-text" id="rent_amount_co">শাখা </div>
                        </div>
                        {{ Form::text('fee_info[branch]', NULL, ['required', 'class' => 'form-control', 'placeholder' => 'শাখা..', 'autocomplete' => 'off']) }}


                    </div>

                </div>

                <div class="form-group">
                    {{ Form::label('vat_info', 'ভ্যাটের পরিমান ('.$vat_p.' % হরে)', array('class' => 'vat_info')) }}
                    <div class="input-group" style="margin-bottom: 5px">
                        <div class="input-group-addon" style="min-width: 165px">
                            <div class="input-group-text" id="rent_amount_co">টাকার পরিমাণ</div>
                        </div>
                        {{ Form::number('vat_info[amount]', $vat_a, ['required', 'class' => 'form-control', 'placeholder' => 'টাকার পরিমাণ..',  'readonly']) }}

                        <div class="input-group-addon">
                            <div class="input-group-text">টাকা</div>
                        </div>
                    </div>
                    <div class="input-group" style="margin-bottom: 5px">
                        <div class="input-group-addon" style="min-width: 165px">
                            <div class="input-group-text" id="rent_amount_co">পে অর্ডার / ব্যাংক ড্রাফট নং  </div>
                        </div>
                        {{ Form::number('vat_info[payorder]', null, ['required', 'class' => 'form-control', 'placeholder' => 'পে অর্ডার / ব্যাংক ড্রাফট নং ..', 'autocomplete' => 'off']) }}


                    </div>
                    <div class="input-group" style="margin-bottom: 5px">
                        <div class="input-group-addon" style="min-width: 165px">
                            <div class="input-group-text" id="rent_amount_co">তারিখ </div>
                        </div>
                        {{ Form::text('vat_info[date]', null, ['required', 'class' => 'form-control date-pick', 'placeholder' => 'তারিখ..', 'autocomplete' => 'off']) }}


                    </div>
                    <div class="input-group" style="margin-bottom: 5px">
                        <div class="input-group-addon" style="min-width: 165px">
                            <div class="input-group-text" id="rent_amount_co">ব্যাংকের নাম </div>
                        </div>
                        {{ Form::text('vat_info[bank]', null, ['required', 'class' => 'form-control', 'placeholder' => 'ব্যাংকের নাম ..', 'autocomplete' => 'off']) }}


                    </div>
                    <div class="input-group" style="margin-bottom: 5px">
                        <div class="input-group-addon" style="min-width: 165px">
                            <div class="input-group-text" id="rent_amount_co">শাখা </div>
                        </div>
                        {{ Form::text('vat_info[branch]', null, ['required', 'class' => 'form-control', 'placeholder' => 'শাখা..', 'autocomplete' => 'off']) }}


                    </div>

                </div>

                <div class="form-group">
                    {{ Form::label('tax_info', 'আয়করের পরিমান ('.$tax_p.' % হরে)', array('class' => 'tax_info')) }}

                    <div class="input-group" style="margin-bottom: 5px">
                        <div class="input-group-addon" style="min-width: 165px">
                            <div class="input-group-text" id="rent_amount_co">টাকার পরিমাণ</div>
                        </div>
                        {{ Form::number('tax_info[amount]',$tax_a, ['required', 'class' => 'form-control', 'placeholder' => 'টাকার পরিমাণ..','readonly']) }}

                        <div class="input-group-addon">
                            <div class="input-group-text">টাকা</div>
                        </div>
                    </div>

                    <div class="input-group" style="margin-bottom: 5px">
                        <div class="input-group-addon" style="min-width: 165px">
                            <div class="input-group-text" id="rent_amount_co">পে অর্ডার / ব্যাংক ড্রাফট নং  </div>
                        </div>
                        {{ Form::number('tax_info[payorder]', null, ['required', 'class' => 'form-control', 'placeholder' => 'পে অর্ডার / ব্যাংক ড্রাফট নং..', 'autocomplete' => 'off']) }}


                    </div>
                    <div class="input-group" style="margin-bottom: 5px">
                        <div class="input-group-addon" style="min-width: 165px">
                            <div class="input-group-text" id="rent_amount_co">তারিখ </div>
                        </div>
                        {{ Form::text('tax_info[date]', null, ['required', 'class' => 'form-control date-pick', 'placeholder' => 'তারিখ..', 'autocomplete' => 'off']) }}


                    </div>
                    <div class="input-group" style="margin-bottom: 5px">
                        <div class="input-group-addon" style="min-width: 165px">
                            <div class="input-group-text" id="rent_amount_co">ব্যাংকের নাম </div>
                        </div>
                        {{ Form::text('tax_info[bank]', null, ['required', 'class' => 'form-control', 'placeholder' => 'ব্যাংকের নাম..', 'autocomplete' => 'off']) }}

                    </div>
                    <div class="input-group" style="margin-bottom: 5px">
                        <div class="input-group-addon" style="min-width: 165px">
                            <div class="input-group-text" id="rent_amount_co">শাখা </div>
                        </div>
                        {{ Form::text('tax_info[branch]', null, ['required', 'class' => 'form-control', 'placeholder' => 'শাখা..', 'autocomplete' => 'off']) }}

                    </div>

                </div>





            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">বাতিল</button>
                <button type="submit" class="btn btn-success" >জমা দিন</button>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>