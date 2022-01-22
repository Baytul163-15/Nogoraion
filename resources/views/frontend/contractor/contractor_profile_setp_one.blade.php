<div class="stepwizard col-md-12">
    <div class="stepwizard-row setup-panel">
        <div class="stepwizard-step">
            <a href="{{ url('contractor_apply') }}" type="button" class="btn btn-perpel btn-circle" > প্রথম ধাপ  </a>
        </div>
        <div class="stepwizard-step">
            <a href="{{ url('contractor_apply?step=two') }}" type="button" class="btn btn-default btn-circle"
                    {!! (($pogress > 1)? 'style="background-color: #d389ff;"': '') !!}
            > দ্বিতীয় ধাপ  </a>

        </div>
        <div class="stepwizard-step">
            <a href="{{ url('contractor_apply?step=three') }}" type="button" class="btn btn-default btn-circle"
                    {!! (($pogress > 2)? 'style="background-color: #d389ff;"': '') !!}
            > তৃতীয় ধাপ </a>
        </div>
    </div>
</div>
<br>
<div class="form-group">
    {{ Form::label('application_type', 'আবেদনের ধরণঃ', array('class' => 'application_type col-sm-3 control-label')) }}
    {{ Form::hidden('step', 'one', []) }}
    {{ Form::hidden('user_id', $user['user_id'], []) }}
    <div class="col-sm-9">
        @php
           // dump($fdata);
        @endphp
        <div class="radio">
            <label>
                {{ Form::radio('application_type', 'New', (!empty($fdata['application_type']) ? ($fdata['application_type'] =='New') ? true : false : true)) }} প্রথমবার আবেদন


            </label>
        </div>
        <div class="radio">
            <label>
                {{ Form::radio('application_type', 'Renewal', (!empty($fdata['application_type']) ? ($fdata['application_type'] =='Renewal') ? true : false : false))}} নবায়নের আবেদন
            </label>
        </div>

    </div>
</div>
<div class="form-group">
    {{ Form::label('reg_notification_no', 'তালিকাভুক্তি বিজ্ঞপ্তি নংঃ', array('class' => 'reg_notification_no col-sm-3 control-label')) }}
    <div class="col-sm-9">
        {{ Form::text('reg_notification_no', (!empty($fdata['reg_notification_no']) ? $fdata['reg_notification_no'] : NULL), ['id' => 'reg_notification_no',  'class' => 'form-control reg_notification_no', 'placeholder' => 'তালিকাভুক্তি বিজ্ঞপ্তি নং...']) }}
    </div>
</div>


<h3><span>আবেদনকারীর তথ্যঃ</span></h3>
<div class="form-group">
    {{ Form::label('applicant_name', 'আবেদনকারীর প্রকৃত নামঃ', array('class' => 'applicant_name col-sm-3 control-label')) }}
    <div class="col-sm-9">
        {{ Form::text('applicant_name', (!empty($fdata['applicant_name']) ? $fdata['applicant_name'] : NULL), ['id' => null,  'class' => 'form-control applicant_name', 'placeholder' => 'আবেদনকারীর প্রকৃত নামঃ..']) }}
    </div>
</div>
<div class="form-group">
    {{ Form::label('applicant_structural', 'আবেদনকারীর গাঠনিক প্রকৃতিঃ', array('class' => 'applicant_structural col-sm-3 control-label')) }}
    <div class="col-sm-9">
        <div class="radio">
            <label>
                {{ Form::radio('applicant_structural', 'Proprietorship', (!empty($fdata['applicant_structural']) ? ($fdata['applicant_structural'] =='Proprietorship') ? true : false : true)) }} প্রোপ্রিয়েটরশীপ

            </label>
        </div>
        <div class="radio">
            <label>
                {{ Form::radio('applicant_structural', 'Partnerships', (!empty($fdata['applicant_structural']) ? ($fdata['applicant_structural'] =='Partnerships') ? true : false : false)) }} পার্টনারশীপ
            </label>
        </div>
        <div class="radio">
            <label>
                {{ Form::radio('applicant_structural', 'Private Ltd', (!empty($fdata['applicant_structural']) ? ($fdata['applicant_structural'] =='Private Ltd') ? true : false : false)) }} প্রাইভেট লিঃ

            </label>
        </div>

    </div>
</div>
<div class="form-group">
    {{ Form::label('date_of_creation', 'গঠনের তারিখঃ ', array('class' => 'date_of_creation col-sm-3 control-label')) }}
    <div class="col-sm-9">
        {{ Form::text('date_of_creation', (!empty($fdata['date_of_creation']) ? $fdata['date_of_creation'] : NULL), ['id' => 'date_of_creation',  'class' => 'date-pick form-control date_of_creation', 'placeholder' => 'গঠনের তারিখঃ ..']) }}
    </div>
</div>
<div class="form-group">
    @php
        $business_arr = (!empty($fdata['business_address']) ? json_decode($fdata['business_address'],true) : array());
    @endphp
    {{ Form::label('business_address', 'ব্যাবসায়িক / পত্র যোগাযোগের ঠিকানাঃ ', array('class' => 'shop_ownner col-sm-3 control-label')) }}
    <div class="col-sm-9">
        <div class="row">
            <div class="col-md-6">
                <div class="input-group" style="margin-bottom: 5px">
                    <div class="input-group-addon" style="min-width: 165px">
                        <div class="input-group-text" id="rent_amount_co">গ্রামঃ/রাস্তাঃ</div>
                    </div>
                    {{ Form::text('business_address[village]', (isset($business_arr['village']) ? $business_arr['village'] : null), ['required', 'class' => 'form-control', 'placeholder' => 'গ্রাম/রাস্তা....', ]) }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group" style="margin-bottom: 5px">
                    <div class="input-group-addon" style="min-width: 165px">
                        <div class="input-group-text" id="rent_amount_co"> পোস্ট অফিসঃ</div>
                    </div>
                    {{ Form::text('business_address[post_office]', (isset($business_arr['post_office']) ? $business_arr['post_office'] : null), ['required', 'class' => 'form-control', 'placeholder' => 'পোস্ট অফিস...', ]) }}
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="input-group" style="margin-bottom: 5px">
                    <div class="input-group-addon" style="min-width: 165px">
                        <div class="input-group-text" id="rent_amount_co"> উপজেলাঃ</div>
                    </div>
                    {{ Form::text('business_address[upazila]', (isset($business_arr['upazila']) ? $business_arr['upazila'] : null), ['required', 'class' => 'form-control', 'placeholder' => 'উপজেলা...', ]) }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group" style="margin-bottom: 5px">
                    <div class="input-group-addon" style="min-width: 165px">
                        <div class="input-group-text" id="rent_amount_co"> জেলাঃ</div>
                    </div>
                    {{ Form::text('business_address[district]', (isset($business_arr['district']) ? $business_arr['district'] : null), ['required', 'class' => 'form-control', 'placeholder' => 'জেলা...', ]) }}
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="input-group" style="margin-bottom: 5px">
                    <div class="input-group-addon" style="min-width: 165px">
                        <div class="input-group-text"> পোস্ট কোডঃ</div>
                    </div>
                    {{ Form::text('business_address[postcode]', (isset($business_arr['postcode']) ? $business_arr['postcode'] : null), [ 'class' => 'form-control', 'placeholder' => 'পোস্ট কোড...', ]) }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group" style="margin-bottom: 5px">
                    <div class="input-group-addon" style="min-width: 165px">
                        <div class="input-group-text"> টেলিফোনঃ</div>
                    </div>
                    {{ Form::text('business_address[telephone]', (isset($business_arr['telephone']) ? $business_arr['telephone'] : null), ['class' => 'form-control', 'placeholder' => 'টেলিফোন...', ]) }}
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="input-group" style="margin-bottom: 5px">
                    <div class="input-group-addon" style="min-width: 165px">
                        <div class="input-group-text"> ফ্যাক্সঃ</div>
                    </div>
                    {{ Form::number('business_address[fax]', (isset($business_arr['fax']) ? $business_arr['fax'] : null), ['class' => 'form-control', 'placeholder' => ' ফ্যাক্স..', ]) }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group" style="margin-bottom: 5px">
                    <div class="input-group-addon" style="min-width: 165px">
                        <div class="input-group-text"> ই-মেইলঃ</div>
                    </div>
                    {{ Form::text('business_address[email]', (isset($business_arr['email']) ? $business_arr['email'] : null), ['class' => 'form-control', 'placeholder' => 'টই-মেইল...', ]) }}
                </div>
            </div>

        </div>


    </div>
</div>

<div class="form-group">

    {{ Form::label('vat_reg_number', ' ভ্যাট রেজিস্ট্রেশন নম্বরঃ  ', array('class' => 'vat_reg_number col-sm-3 control-label')) }}
    <div class="col-sm-9">
        {{ Form::text('vat_reg_number', (!empty($fdata['vat_reg_number']) ? $fdata['vat_reg_number'] : NULL), ['id' => 'vat_reg_number', 'class' => 'form-control vat_reg_number', 'placeholder' => ' ভ্যাট রেজিস্ট্রেশন নম্বর....']) }}
    </div>
</div>

<div class="form-group">
    {{ Form::label('tin_no', ' টিআইএনঃ  ', array('class' => 'tin_no col-sm-3 control-label')) }}
    <div class="col-sm-9">
        {{ Form::text('tin_no', (!empty($fdata['tin_no']) ? $fdata['tin_no'] : NULL), ['id' => 'tin_no',  'class' => 'form-control tin_no', 'placeholder' => ' টিআইএন ...']) }}
    </div>
</div>

<div class="form-group">
    {{ Form::label('managing_director', 'স্বত্তাধিকারি/ ব্যাবস্থাপনা পরিচালকঃ  ', array('class' => 'managing_director col-sm-3 control-label')) }}
    @php
        $md_arr = (!empty($fdata['managing_director']) ? json_decode($fdata['managing_director'],true) : array());
    @endphp
    <div class="col-sm-9">
        <div class="row">
            <div class="col-md-6">
                <div class="input-group" style="margin-bottom: 5px">
                    <div class="input-group-addon" style="min-width: 165px">
                        <div class="input-group-text">নামঃ</div>
                    </div>
                    {{ Form::text('managing_director[name]', (!empty($md_arr['name']) ? $md_arr['name'] : NULL), ['required', 'class' => 'form-control', 'placeholder' => 'নাম...', ]) }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group" style="margin-bottom: 5px">

                    {{ Form::radio('managing_director[gender]', 'Male', (!empty($md_arr['gender']) ? ($md_arr['gender'] =='Male') ? true : false : false)) }} পুরুষ
                    {{ Form::radio('managing_director[gender]', 'Female', (!empty($md_arr['gender']) ? ($md_arr['gender'] =='Female') ? true : false : false)) }} নারী
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="input-group" style="margin-bottom: 5px">
                    <div class="input-group-addon" style="min-width: 165px">
                        <div class="input-group-text"> পিতার নামঃ</div>
                    </div>
                    {{ Form::text('managing_director[father_name]', (!empty($md_arr['father_name']) ? $md_arr['father_name'] : NULL), ['required', 'class' => 'form-control', 'placeholder' => 'পিতার নাম...', ]) }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group" style="margin-bottom: 5px">
                    <div class="input-group-addon" style="min-width: 165px">
                        <div class="input-group-text"> মাতার নামঃ</div>
                    </div>
                    {{ Form::text('managing_director[mother_name]', (!empty($md_arr['mother_name']) ? $md_arr['mother_name'] : NULL), ['required', 'class' => 'form-control', 'placeholder' => 'মাতার নাম...', ]) }}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="input-group" style="margin-bottom: 5px">
                    <div class="input-group-addon" style="min-width: 165px">
                        <div class="input-group-text"> বয়সঃ</div>
                    </div>
                    {{ Form::number('managing_director[age]', (!empty($md_arr['age']) ? $md_arr['age'] : NULL), ['required', 'class' => 'form-control', 'placeholder' => 'বয়স...', ]) }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group" style="margin-bottom: 5px">
                    <div class="input-group-addon" style="min-width: 165px">
                        <div class="input-group-text"> শিকক্ষাগত যোগ্যতাঃ</div>
                    </div>
                    {{ Form::text('managing_director[education]', (!empty($md_arr['education']) ? $md_arr['education'] : NULL), ['required', 'class' => 'form-control', 'placeholder' => 'শিকক্ষাগত যোগ্যতাঃ..', ]) }}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="input-group" style="margin-bottom: 5px">
                    <div class="input-group-addon" style="min-width: 165px">
                        <div class="input-group-text"> জাতীয় পরিচয়পত্র (যদি থাকে)
                        </div>
                    </div>
                    {{ Form::text('managing_director[nid]', (!empty($md_arr['nid']) ? $md_arr['nid'] : NULL), ['class' => 'form-control', 'placeholder' => 'জাতীয় পরিচয়পত্র (যদি থাকে)..', ]) }}
                </div>
            </div>
            <div class="col-md-6">

            </div>
        </div>

    </div>
</div>

<div class="form-group">
    {{ Form::label('detailed_contact', 'বিস্তারিত যোগাযোগঃ  ', array('class' => 'detailed_contact col-sm-3 control-label')) }}
    @php
        $dc_arr = (!empty($fdata['detailed_contact']) ? json_decode($fdata['detailed_contact'],true) : array());
    @endphp
    <div class="col-sm-9">
        <div class="row">
            <div class="col-md-6">
                <div class="input-group" style="margin-bottom: 5px">
                    <div class="input-group-addon" style="min-width: 165px">
                        <div class="input-group-text"> টেলিফোনঃ</div>
                    </div>
                    {{ Form::text('detailed_contact[telephon]', (!empty($dc_arr['telephon']) ? $dc_arr['telephon'] : NULL), ['required', 'class' => 'form-control', 'placeholder' => 'টেলিফোন...', ]) }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group" style="margin-bottom: 5px">
                    <div class="input-group-addon" style="min-width: 165px">
                        <div class="input-group-text"> ফ্যাক্সঃ</div>
                    </div>
                    {{ Form::text('detailed_contact[fax]', (!empty($dc_arr['fax']) ? $dc_arr['fax'] : NULL), ['required', 'class' => 'form-control', 'placeholder' => 'ফ্যাক্স..', ]) }}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="input-group" style="margin-bottom: 5px">
                    <div class="input-group-addon" style="min-width: 165px">
                        <div class="input-group-text"> ই-মেইলঃ</div>
                    </div>
                    {{ Form::email('detailed_contact[email]', (!empty($dc_arr['email']) ? $dc_arr['email'] : NULL), [ 'class' => 'form-control', 'placeholder' => 'ই-মেইল...', ]) }}
                </div>
            </div>
            <div class="col-md-6">

            </div>
        </div>


    </div>
</div>

<div class="form-group">
    {{ Form::label('bank_description', 'ব্যাংক হিসাবের বর্ণনাঃ  ', array('class' => 'shop_ownner col-sm-3 control-label')) }}
    @php
        $bd_arr = (!empty($fdata['bank_description']) ? json_decode($fdata['bank_description'],true) : array());
    @endphp
    <div class="col-sm-9">
        <div class="row">
            <div class="col-md-6">
                <div class="input-group" style="margin-bottom: 5px">
                    <div class="input-group-addon" style="min-width: 165px">
                        <div class="input-group-text"> ব্যাংকার নামঃ</div>
                    </div>
                    {{ Form::text('bank_description[bank_name]', (!empty($bd_arr['bank_name']) ? $bd_arr['bank_name'] : NULL), ['required', 'class' => 'form-control', 'placeholder' => 'ব্যাংকার নাম...', ]) }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group" style="margin-bottom: 5px">
                    <div class="input-group-addon" style="min-width: 165px">
                        <div class="input-group-text"> ব্রাঞ্চঃ</div>
                    </div>
                    {{ Form::text('bank_description[bank_branch]', (!empty($bd_arr['bank_branch']) ? $bd_arr['bank_branch'] : NULL), ['required', 'class' => 'form-control', 'placeholder' => 'ব্রাঞ্চ...', ]) }}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="input-group" style="margin-bottom: 5px">
                    <div class="input-group-addon" style="min-width: 165px">
                        <div class="input-group-text"> একাউন্ট নংঃ</div>
                    </div>
                    {{ Form::text('bank_description[bank_account]', (!empty($bd_arr['bank_account']) ? $bd_arr['bank_account'] : NULL), ['required', 'class' => 'form-control', 'placeholder' => 'একাউন্ট নং..', ]) }}
                </div>
            </div>
            <div class="col-md-6">

            </div>
        </div>


    </div>
</div>

<div class="contractor_button">
    <button type="button" class="btn btn-danger pull-left btn-md" data-dismiss="modal">বাতিল</button>
    <button type="submit" class="btn btn-success pull-right btn-md">পরবর্তী ধাপ</button>
</div>
