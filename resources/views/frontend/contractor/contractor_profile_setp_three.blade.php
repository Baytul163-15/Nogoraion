<div class="stepwizard col-md-12">
    <div class="stepwizard-row setup-panel">
        <div class="stepwizard-step">
            <a href="{{ url('contractor_apply') }}" type="button" class="btn btn-default btn-circle"
                    {!! (($pogress > 0)? 'style="background-color: #d389ff;"': '') !!}
            > প্রথম ধাপ </a>

        </div>
        <div class="stepwizard-step">
            <a href="{{ url('contractor_apply?step=two') }}" type="button" class="btn btn-default btn-circle"
                    {!! (($pogress > 1)? 'style="background-color: #d389ff;"': '') !!}
            > দ্বিতীয় ধাপ </a>

        </div>
        <div class="stepwizard-step">
            <a href="{{ url('contractor_apply?step=three') }}" type="button" class="btn btn-perpel btn-circle"> তৃতীয়
                ধাপ </a>
        </div>
    </div>
</div>
<br>
{{ Form::hidden('step', 'three', []) }}


<h3><span>প্রয়োজনীয় যোগ্যতাঃ</span></h3>
<div class="form-group">

    <div class="col-sm-12">
        প্রয়োজনীয় যোগ্যতাঃ <br>
        ক. বৈধ ট্রেড লাইসেন্স <br>
        খ. টিআইএন সনদ <br>
        গ. ২৫,০০০,০০/- (পঁচিশ লক্ষ) টাকার ব্যাংক স্বচ্ছলতার সনদ <br>
        ঘ. ভ্যাট রেজিস্ট্রেশন <br>


    </div>
</div>


<h3><span>সংযুক্তি</span></h3>

<div class="form-group">

    <div class="col-sm-12">
        <div class="bs-example" data-example-id="bordered-table">
            <table class="table table-bordered">

                <tbody>

                <tr>
                    <td style="width: 5%"> {{e_to_b(1)}}</td>
                    <td style="width: 80%">
                        স্বত্বাধিকারী/ ব্যবস্থাপনা পরিচালন- এর ১ কপি পাসপোর্ট সাইজের ফটো ( নতুন আবেদনের
                        ক্ষেত্রে)

                    </td>

                    <td>
                        @if(!empty($fdata['management']))
                            <img src="{{ url($fdata['management']) }}" class="xhmx-thum-120" />
                        @endif
                    </td>

                    <td>

                        <a href="javascript:void(0)" class="btn btn-sm btn-info" data-name="management"
                           data-id="{{ !empty($fdata['id']) ? $fdata['id'] : NULL }}"
                           onclick="upload_contactor_file(this);"> ফাইল পছন্দ করুন</a>

                    </td>

                <tr>
                    <td> {{e_to_b(2)}}</td>
                    <td>
                        হালনাগাদ ( সর্বশেষ টিআইএন সনদ অথবা আয়কর রিটার্ন প্রাপ্তিস্বীকার প্রত্র।

                    </td>

                    <td>
                        @if(!empty($fdata['tin_doc']))
                            <img src="{{ url($fdata['tin_doc']) }}" class="xhmx-thum-120" />
                        @endif
                    </td>

                    <td>

                        <a href="javascript:void(0)" class="btn btn-sm btn-info" data-name="tin_doc"
                           data-id="{{ !empty($fdata['id']) ? $fdata['id'] : NULL }}"
                           onclick="upload_contactor_file(this);"> ফাইল পছন্দ করুন</a>

                    </td>

                </tr>
                <tr>
                    <td> {{e_to_b(3)}}</td>
                    <td>
                        ভ্যাট রেজিস্ট্রেশন সনদ।

                    </td>

                    <td>
                        @if(!empty($fdata['vat_doc']))
                            <img src="{{ url($fdata['vat_doc']) }}" class="xhmx-thum-120" />
                        @endif
                    </td>

                    <td>

                        <a href="javascript:void(0)" class="btn btn-sm btn-info" data-name="vat_doc"
                           data-id="{{ !empty($fdata['id']) ? $fdata['id'] : NULL }}"
                           onclick="upload_contactor_file(this);"> ফাইল পছন্দ করুন</a>

                    </td>

                </tr>
                <tr>
                    <td> {{e_to_b(4)}}</td>
                    <td>
                        এফিডেভিট / আর্টিকেল অফ এসোসিয়েশন (প্রযোজ্য ক্ষেত্রে)

                    </td>


                    <td>
                        @if(!empty($fdata['article_of_association']))
                            <img src="{{ url($fdata['article_of_association']) }}" class="xhmx-thum-120" />
                        @endif
                    </td>

                    <td>

                        <a href="javascript:void(0)" class="btn btn-sm btn-info" data-name="article_of_association"
                           data-id="{{ !empty($fdata['id']) ? $fdata['id'] : NULL }}"
                           onclick="upload_contactor_file(this);"> ফাইল পছন্দ করুন</a>

                    </td>

                </tr>
                <tr>
                    <td> {{e_to_b(5)}}</td>
                    <td>

                        বৈধ হালনাগাদ ট্রেড লাইসেন্স।
                    </td>

                    <td>
                        @if(!empty($fdata['trade_licenses']))
                            <img src="{{ url($fdata['trade_licenses']) }}" class="xhmx-thum-120" />
                        @endif
                    </td>

                    <td>

                        <a href="javascript:void(0)" class="btn btn-sm btn-info" data-name="trade_licenses"
                           data-id="{{ !empty($fdata['id']) ? $fdata['id'] : NULL }}"
                           onclick="upload_contactor_file(this);"> ফাইল পছন্দ করুন</a>

                    </td>

                </tr>
                <tr>
                    <td> {{e_to_b(6)}}</td>
                    <td>
                        স্বত্বাধিকারী/ ব্যবস্থাপনা পরিচাক বয়সের সপক্ষে কাগজপত্র (এন আই ডি)।

                    </td>

                    <td>
                        @if(!empty($fdata['management_nid']))
                            <img src="{{ url($fdata['management_nid']) }}" class="xhmx-thum-120" />
                        @endif
                    </td>

                    <td>

                        <a href="javascript:void(0)" class="btn btn-sm btn-info" data-name="management_nid"
                           data-id="{{ !empty($fdata['id']) ? $fdata['id'] : NULL }}"
                           onclick="upload_contactor_file(this);"> ফাইল পছন্দ করুন</a>

                    </td>

                </tr>
                <tr>
                    <td> {{e_to_b(7)}}</td>
                    <td>
                        মুখ্য কারিগরি জনবলের জীবন বৃত্তান্ত।

                    </td>


                    <td>
                        @if(!empty($fdata['chief_manpower']))
                            <img src="{{ url($fdata['chief_manpower']) }}" class="xhmx-thum-120" />
                        @endif
                    </td>

                    <td>

                        <a href="javascript:void(0)" class="btn btn-sm btn-info" data-name="chief_manpower"
                           data-id="{{ !empty($fdata['id']) ? $fdata['id'] : NULL }}"
                           onclick="upload_contactor_file(this);"> ফাইল পছন্দ করুন</a>

                    </td>

                </tr>
                <tr>
                    <td> {{e_to_b(8)}}</td>
                    <td>
                        স্থানীয় সরকার প্রতিষ্ঠান হতে স্বত্বাধিকারী/ ব্যবস্থাপনা পরিচালক - এর জাতীয়তা/
                        চারিত্রিক সনদ।
                    </td>


                    <td>
                        @if(!empty($fdata['md_character']))
                            <img src="{{ url($fdata['md_character']) }}" class="xhmx-thum-120" />
                        @endif
                    </td>

                    <td>

                        <a href="javascript:void(0)" class="btn btn-sm btn-info" data-name="md_character"
                           data-id="{{ !empty($fdata['id']) ? $fdata['id'] : NULL }}"
                           onclick="upload_contactor_file(this);"> ফাইল পছন্দ করুন</a>

                    </td>
                </tr>
                <tr>
                    <td> {{e_to_b(9)}}</td>
                    <td>
                        নিম্নোক্ত বিষয়ের নিশ্চয়তা স্বরূপ এফিডেভিটঃ
                        আবেদনকারী আইনতভাবে ক্রয়কারী সত্তার সাথে চুক্তিতে আবদ্ধ হতে সক্ষম এবং বাংলাদেশ
                        সরকারের কোন প্রতিষ্ঠান কর্তৃক কারণে কখনো অযোগ্য বিবেচিত হয় নি।
                    </td>

                    <td>
                        @if(!empty($fdata['legally_bound']))
                            <img src="{{ url($fdata['legally_bound']) }}" class="xhmx-thum-120" />
                        @endif
                    </td>

                    <td>

                            <a href="javascript:void(0)" class="btn btn-sm btn-info" data-name="legally_bound"
                               data-id="{{ !empty($fdata['id']) ? $fdata['id'] : NULL }}"
                               onclick="upload_contactor_file(this);"> ফাইল পছন্দ করুন</a>

                    </td>
                </tr>

                </tbody>
            </table>
        </div>


    </div>
</div>

<div class="contractor_button">
    <button type="button" class="btn btn-danger pull-left btn-lg" data-dismiss="modal">বাতিল</button>
    <button type="submit" class="btn btn-success pull-right btn-lg">জমা দিন</button>

</div>


