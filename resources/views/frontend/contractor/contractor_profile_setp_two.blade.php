<div class="stepwizard col-md-12">
    <div class="stepwizard-row setup-panel">
        <div class="stepwizard-step">
            <a href="{{ url('contractor_apply') }}" type="button" class="btn btn-default btn-circle"
                    {!! (($pogress > 0)? 'style="background-color: #d389ff;"': '') !!}
            > প্রথম ধাপ </a>

        </div>
        <div class="stepwizard-step">
            <a href="{{ url('contractor_apply?step=two') }}" type="button" class="btn btn-perpel btn-circle"> দ্বিতীয়
                ধাপ </a>

        </div>
        <div class="stepwizard-step">
            <a href="{{ url('contractor_apply?step=three') }}" type="button" class="btn btn-default btn-circle"
                    {!! (($pogress > 2)? 'style="background-color: #d389ff;"': '') !!}
            > তৃতীয় ধাপ </a>
        </div>
    </div>
</div>

<h3><span>আবেদনকারীর অন্যান্য তথ্যঃ </span></h3>

<div class="form-group">
    {{ Form::label('applicant_nature', 'আবেদনকারীর প্রকৃতিঃ  ', array('class' => 'shop_ownner col-sm-3 control-label')) }}
    {{ Form::hidden('step', 'two', []) }}

    <div class="col-sm-9">


        @php
            $app_nature = (!empty($fdata['applicant_nature']) ? json_decode($fdata['applicant_nature'],true) : array());
            $check_an = array();
            if($app_nature){
             $check_an = $app_nature['type'];
            }
        @endphp

        <div class="input-group" style="margin-bottom: 5px">
            {{ Form::checkbox('applicant_nature[type][]', 'Bridge', (in_array("Bridge", $check_an))? true : false  ) }}
            পূর্ত ( নির্মাণ, সংস্কার,
            কায়িক
            সেবা )
        </div>
        <div class="input-group" style="margin-bottom: 5px">
            {{ Form::checkbox('applicant_nature[type][]', 'Mechanical', (in_array("Mechanical", $check_an))? true : false ) }}
            যান্ত্রিক
        </div>
        <div class="input-group" style="margin-bottom: 5px">
            {{ Form::checkbox('applicant_nature[type][]', 'Electrical',(in_array("Electrical", $check_an))? true : false ) }}
            ইলেক্ট্রিক্যাল
        </div>
        <div class="input-group" style="margin-bottom: 5px">
            {{ Form::checkbox('applicant_nature[type][]', 'Others',  (in_array("Others", $check_an))? true : false ) }}
            অন্যান্য / বিবিধ
            {{ Form::text('applicant_nature[note]', (($app_nature && $app_nature['note']) ? $app_nature['note'] : false), [ 'class' => 'form-control', 'placeholder' => 'অন্যান্য / বিবিধ..', ]) }}
        </div>

    </div>
</div>

<div class="form-group">
    {{ Form::label('number_of_employees', 'কর্মী সংখ্যাঃ  ', array('class' => 'number_of_employees col-sm-3 control-label')) }}
    @php
        $no_emp = (!empty($fdata['number_of_employees']) ? json_decode($fdata['number_of_employees'],true) : array());
    @endphp
    <div class="col-sm-9">
        [মুখ্য জনবল, কারিগরী জনবলের জীবন বৃত্তান্ত]


        <div class="input-group" style="margin-bottom: 5px">
            <div class="input-group-addon" style="min-width: 165px">
                <div class="input-group-text">কারিগরীঃ</div>
            </div>
            {{ Form::text('number_of_employees[technical]',  (!empty($no_emp['technical']) ? $no_emp['technical'] : null), ['required', 'class' => 'form-control', 'placeholder' => 'কারিগরী...', ]) }}
        </div>
        <div class="input-group" style="margin-bottom: 5px">
            <div class="input-group-addon" style="min-width: 165px">
                <div class="input-group-text"> সহযোগী স্টাফঃ</div>
            </div>
            {{ Form::text('number_of_employees[associate_staff]',  (!empty($no_emp['associate_staff']) ? $no_emp['associate_staff'] : null), ['required', 'class' => 'form-control', 'placeholder' => 'সহযোগী স্টাফ...', ]) }}
        </div>
        <div class="input-group" style="margin-bottom: 5px">
            <div class="input-group-addon" style="min-width: 165px">
                <div class="input-group-text"> অন্যান্যঃ</div>
            </div>
            {{ Form::text('number_of_employees[other]',  (!empty($no_emp['other']) ? $no_emp['other'] : null), ['required', 'class' => 'form-control', 'placeholder' => 'অন্যান্য...', ]) }}
        </div>

    </div>
</div>

<div class="form-group">
    {{ Form::label('shop_witch_type', 'নির্মাণ যন্ত্রপাতি ( যদি থাকে )  ', array('class' => 'shop_ownner col-sm-3 control-label')) }}
    @php
        $c_machinery = (!empty($fdata['construction_machinery']) ? json_decode($fdata['construction_machinery'],true) : array());


    @endphp
    <div class="col-sm-9">
        <div>
            <table class="table" id="construction_machinery_table">

                <thead>
                <tr>
                    <th>নং</th>
                    <th> যন্ত্রপাতির নাম</th>
                    <th> সংখ্যা</th>
                    <th>সংগ্রহ / ক্রয়ের বছর</th>
                    <th>বর্তমান অবস্থা</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>

                @if(count($c_machinery) > 0)
                    @php
                        $x = 0;
                    @endphp

                    @foreach($c_machinery as $data)

                        @php
                            ++$x;
                        @endphp
                        <tr>

                            <th scope="row">{{e_to_b($x)}}</th>
                            <td>{{ Form::text('construction_machinery['.$x.'][equipment_name]',
                                     (!empty($data['equipment_name']) ? $data['equipment_name'] : null),
                                      ['required', 'class' => 'form-control', 'placeholder' => 'যন্ত্রপাতির নাম..', ]) }}</td>

                            <td>{{ Form::number('construction_machinery['.$x.'][qty]',
                                   (!empty($data['qty']) ? $data['qty'] : null),
                                    ['required', 'class' => 'form-control', 'placeholder' => 'সংখ্যা..', ]) }}</td>

                            <td>{{ Form::text('construction_machinery['.$x.'][purchase_year]',
                                  (!empty($data['purchase_year']) ? $data['purchase_year'] : null),
                                    ['required', 'class' => 'form-control', 'placeholder' => 'সংগ্রহ / ক্রয়ের বছর..', ]) }}</td>

                            <td>{{ Form::text('construction_machinery['.$x.'][current_status]',
                                    (!empty($data['current_status']) ? $data['current_status'] : null),
                                    ['required', 'class' => 'form-control', 'placeholder' => 'টবর্তমান অবস্থা..', ]) }}</td>
                            <td>
                                <a class="btn btn-danger btn-xs" href="javascript:void(0)"
                                   @if($x != 1)
                                   onclick="remove_construction_machinery(this);"
                                        @endif
                                >
                                    <i class="fa fa-minus-square" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>


                        </tr>
                    @endforeach

                @else

                    @for($x = 1; $x <= 3; $x++)
                        <tr>
                            <th scope="row">{{e_to_b($x)}}</th>
                            <td>{{ Form::text('construction_machinery['.$x.'][equipment_name]',
                     (!empty($c_machinery[$x]['equipment_name']) ?$c_machinery[$x]['equipment_name'] : null),
                      ['required', 'class' => 'form-control', 'placeholder' => 'যন্ত্রপাতির নাম..', ]) }}</td>

                            <td>{{ Form::number('construction_machinery['.$x.'][qty]',
                   (!empty($c_machinery[$x]['qty']) ?$c_machinery[$x]['qty'] : null),
                    ['required', 'class' => 'form-control', 'placeholder' => 'সংখ্যা..', ]) }}</td>

                            <td>{{ Form::text('construction_machinery['.$x.'][purchase_year]',
                  (!empty($c_machinery[$x]['purchase_year']) ?$c_machinery[$x]['purchase_year'] : null),
                    ['required', 'class' => 'form-control', 'placeholder' => 'সংগ্রহ / ক্রয়ের বছর..', ]) }}</td>

                            <td>{{ Form::text('construction_machinery['.$x.'][current_status]',
                    (!empty($c_machinery[$x]['current_status']) ?$c_machinery[$x]['current_status'] : null),
                    ['required', 'class' => 'form-control', 'placeholder' => 'টবর্তমান অবস্থা..', ]) }}</td>
                            <td>
                                <a class="btn btn-danger btn-xs" href="javascript:void(0)"
                                   @if($x != 1)
                                   onclick="remove_construction_machinery(this);"
                                        @endif
                                >
                                    <i class="fa fa-minus-square" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>

                    @endfor
                @endif


                </tbody>
            </table>


            <a class="btn btn-info btn-xs" href="javascript:void(0)" data-sl="{{$x}}"
               onclick="add_construction_machinery(this);">আরো যোগ করুন </a>
        </div>


    </div>
</div>

<div class="form-group">
    {{ Form::label('financial_ability', '  নির্মাণকালীন খরচ বহনের আর্থিক সক্ষমতাঃ  ', array('class' => ' col-sm-3 control-label')) }}
    @php
        $f_ability = (!empty($fdata['financial_ability']) ? json_decode($fdata['financial_ability'],true) : array());
       // dump($f_ability);


    @endphp
    <div class="col-sm-9">

        <div>
            <table class="table" id="financial_ability_table">

                <thead>
                <tr>
                    <th>নং</th>
                    <th> অর্থের উৎস</th>
                    <th>অর্থের পরিমান</th>
                    <th></th>

                </tr>
                </thead>
                <tbody>
                @if(count($f_ability) > 0)
                    @php
                        $x = 0;
                    @endphp

                    @foreach($f_ability as $data)

                        @php
                            ++$x;
                        @endphp

                        <tr>
                            <th>{{e_to_b($x)}}</th>
                            <td>{{ Form::text('financial_ability['.$x.'][source_of_money]',
                      (!empty($data['source_of_money']) ?$data['source_of_money'] : null),
                      ['required', 'class' => 'form-control', 'placeholder' => 'অর্থের উৎস..', ]) }}</td>

                            <td>
                                {{ Form::text('financial_ability['.$x.'][amount]',
                            (!empty($data['amount']) ? $data['amount'] : null),
                            ['required', 'class' => 'form-control', 'placeholder' => 'অর্থের পরিমান..', ]) }}
                            </td>

                            <td>
                                <a class="btn btn-danger btn-xs" href="javascript:void(0)"
                                   @if($x != 1)
                                   onclick="remove_financial_ability(this);"
                                        @endif
                                >
                                    <i class="fa fa-minus-square" aria-hidden="true"></i>
                                </a>
                            </td>


                        </tr>
                    @endforeach

                @else

                    @for($x = 1; $x <= 3; $x++)
                        <tr>
                            <th>{{e_to_b($x)}}</th>
                            <td>{{ Form::text('financial_ability['.$x.'][source_of_money]',
                      (!empty($f_ability[$x]['source_of_money']) ?$f_ability[$x]['source_of_money'] : null),
                      ['required', 'class' => 'form-control', 'placeholder' => 'অর্থের উৎস..', ]) }}</td>

                            <td>
                                {{ Form::text('financial_ability['.$x.'][amount]',
                            (!empty($f_ability[$x]['amount']) ?$f_ability[$x]['amount'] : null),
                            ['required', 'class' => 'form-control', 'placeholder' => 'অর্থের পরিমান..', ]) }}
                            </td>
                            <td>
                                <a class="btn btn-danger btn-xs" href="javascript:void(0)"
                                   @if($x != 1)
                                   onclick="remove_financial_ability(this);"
                                        @endif
                                >
                                    <i class="fa fa-minus-square" aria-hidden="true"></i>
                                </a>
                            </td>

                        </tr>
                    @endfor
                @endif

                </tbody>
            </table>

            <a class="btn btn-info btn-xs" href="javascript:void(0)" data-sl="{{$x}}"
               onclick="add_financial_ability(this);">আরো যোগ করুন </a>
        </div>

    </div>
</div>

<h3><span>নিষিদ্ধকরণ তথ্যঃ</span></h3>
<table class="table table-bordered">
    <tbody>
    @php
        $forbidden_info = (!empty($fdata['forbidden_info']) ? json_decode($fdata['forbidden_info'],true) : array());
    @endphp
    <tr>
        <th>আপনি কি সরকারি কোনো প্রতিষ্ঠান হতে কখনো নিষিদ্ধ হয়েছেন?</th>
        <td>
            {{ Form::radio('forbidden_info[is_forbidden]', 'Yes', (($forbidden_info && $forbidden_info['is_forbidden'] == 'Yes') ? true : false)) }}
            হাঁ<br>
            {{ Form::radio('forbidden_info[is_forbidden]', 'No', (($forbidden_info && $forbidden_info['is_forbidden'] == 'No') ? true : false)) }}
            না

        </td>
        <td>
            উত্তর হলে, কখন এবং কোথায় উল্লেখ করুন?<br>
            {{ Form::text('forbidden_info[reason]', (($forbidden_info && $forbidden_info['reason']) ? $forbidden_info['reason'] : false), ['class' => 'form-control', 'placeholder' => 'উত্তর হলে, কখন এবং কোথায় উল্লেখ করুন?..', ]) }}
        </td>
    </tr>
    </tbody>
</table>


<div class="contractor_button">
    <button type="button" class="btn btn-danger pull-left btn-md" data-dismiss="modal">পিছনে</button>
    <button type="submit" class="btn btn-success pull-right btn-md">পরবর্তী ধাপ</button>

</div>