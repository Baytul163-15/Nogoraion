<!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title> তালিকাভূক্তি / তালিকাভূক্তি নবায়নের আবেদন </title>
    <style type="text/css">
        body {
            font-family: 'Nikosh', 'Arial', sans-serif;
            font-size: 17px;
        }

        table, th, td {
            border-collapse: collapse;
            border: 0px solid #EEEEEE !important;
            padding: 3px 5px;
        }


        table > tr > td > table > tr > td {
            border: 0px solid #000000 !important;
        }

        .table_border, .table_border th, .table_border td {
            border-collapse: collapse;
            border: 1px solid #000000 !important;
            padding: 3px 5px;
        }

        .bable2 table, .bable2 th, .bable2 td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        .table3 {
            border-collapse: collapse;
            width: 100%;
        }

        .table3 td, .table3 th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        .table3 tr:nth-child(even) {
            background-color: #dddddd;
        }

        @page {
            header: page-header;
            footer: page-footer;
            margin-top: 135px;
        }


    </style>
</head>
<body>

<?php
//dd($data);
$user = App\User::where(['id' => $data->user_id])->get()->first();

//dump($data);
$tp_info = json_decode($data->request_fee_info, true);

?>

@if (Route::has('login'))

    <htmlpageheader name="page-header">
        <table border="0" style="width:100%;margin:auto;">
            <tr>
                <td colspan="4"
                    style="width: 100%; padding: 20px; border: 0px solid #000; color: #000;">
                    <table style="width: 100%;  border: 0px solid #000;">
                        <tr>
                            <td style="width:10%;">
                                <img src="{{ $settings->com_logourl }}" alt="" width="80" height="80">
                            </td>
                            <td style="width:80%;padding-left:30px; font-size: 35px; color:#000; text-align: center; font-weight: bold">
                                {{ $settings->com_name }}
                                <p style="font-size: 25px; color:#000; ">
                                    তালিকাভূক্তি / তালিকাভূক্তি নবায়নের আবেদন
                                </p>
                            </td>
                            <td style="width:10%;">

                            </td>


                        </tr>
                    </table>
                </td>
            </tr>


        </table>
        <hr style="height: 5px; color: #923dc4">
    </htmlpageheader>
    <htmlpagefooter name="page-footer">


        <table border="0" style="width:100%;margin:auto;">
            <tr style="background:#ADD3CA">

                <td colspan="4" style="padding: 10px; text-align: right; font-size:17px;">

                    পৃষ্ঠা নং {PAGENO}  / {nb}
                </td>

            </tr>
            <tr style="background:#ADD3CA">

                <td colspan="2" style="padding: 10px; text-align: left; font-size:17px;">
                    ফ্রীলান্সার আইটি কর্তৃক সর্বসত্ত্ব সংরক্ষিত ।
                </td>
                <td colspan="2" style="padding: 10px; text-align: right; font-size: 17px;">
                    ডিজিটাল বাংলাদেশ বিনির্মাণে আমরা অঙ্গীকারব্ধ ।
                </td>

            </tr>


        </table>
    </htmlpagefooter>

    <div style="margin:20px;">

        <table style="width:100%" class="table_border">
            <tr>
                <td>
                    বরাবর <br>
                    প্রধান নির্বাহী কর্মকর্তা <br>
                    {{ $settings->com_name }}
                </td>

            </tr>
            <tr>
                <td>
                    আবেদনের ধরণঃ

                </td>

            </tr>

        </table>
        <br>
        <br>

        <table style="width:100%" class="table_border">
            <tr style="background: #90db59; ">
                <td style="font-size: 25px; font-weight: bold"><b> {{e_to_b(1)}}.</b></td>
                <td colspan="2" style="font-size: 25px; font-weight: bold"> <b> আবেদনকারীর তথ্যঃ </b></td>
            </tr>
            <tr>
                <td style="width: 5%">{{e_to_b(1.1)}}</td>
                <td style="width: 40%">আবেদনকারীর প্রকৃত নামঃ</td>
                <td style="width: 60%">{{($data->applicant_name)? e_to_b($data->applicant_name): null}}</td>
            </tr>
            <tr>
                <td style="width: 5%">{{e_to_b(1.2)}}</td>
                <td style="width: 40%">আবেদনকারীর গাঠনিক প্রকৃতিঃ</td>
                <td style="width: 60%"> {{($data->applicant_structural)? e_to_b($data->applicant_structural): null}} </td>
            </tr>
            <tr>
                <td style="width: 5%">{{e_to_b(1.3)}}</td>
                <td style="width: 40%">গঠনের তারিখঃ</td>
                <td style="width: 60%">{{($data->date_of_creation)? e_to_b(date('d-F-Y',strtotime($data->date_of_creation))): null}}</td>
            </tr>
            <tr>
                <td style="width: 5%">{{e_to_b(1.4)}}</td>
                <td style="width: 40%">ব্যাবসায়িক / পত্র যোগাযোগের ঠিকানাঃ</td>
                <td style="width: 60%">
                    @if($data->business_address)
                        @php
                            $b_address = json_decode($data->business_address, true);
                        @endphp
                        গ্রামঃ/রাস্তাঃ {{($b_address['village'])? $b_address['village']: null}}<br>
                        পোস্ট অফিসঃ {{($b_address['post_office'])? $b_address['post_office']: null}}<br>
                        উপজেলাঃ {{($b_address['upazila'])? $b_address['upazila']: null}}<br>
                        জেলাঃ {{($b_address['district'])? $b_address['district']: null}}<br>
                        পোস্ট কোডঃ {{($b_address['postcode'])? $b_address['postcode']: null}}<br>
                        টেলিফোনঃ {{($b_address['telephone'])? $b_address['telephone']: null}}<br>
                        ফ্যাক্সঃ {{($b_address['fax'])? $b_address['fax']: null}}<br>
                        ই-মেইলঃ {{($b_address['email'])? $b_address['email']: null}}


                    @endif

                </td>
            </tr>
            <tr>
                <td style="width: 5%">{{e_to_b(1.5)}}</td>
                <td style="width: 40%">ভ্যাট রেজিস্ট্রেশন নম্বরঃ</td>
                <td style="width: 60%">{{($data->vat_reg_number)? $data->vat_reg_number: null}}</td>
            </tr>
            <tr>
                <td style="width: 5%">{{e_to_b(1.6)}}</td>
                <td style="width: 40%">টিআইএনঃ</td>
                <td style="width: 60%">{{($data->tin_no)? $data->tin_no: null}}</td>
            </tr>
            <tr>
                <td style="width: 5%">{{e_to_b(1.7)}}</td>
                <td style="width: 40%">স্বত্তাধিকারি/ ব্যাবস্থাপনা পরিচালকঃ</td>
                <td style="width: 60%">
                    @if($data->managing_director)
                        @php
                            $md_address = json_decode($data->managing_director, true);
                        @endphp
                        নামঃ {{($md_address['name'])? $md_address['name']: null}}<br>
                        লিঙ্গঃ {{($md_address['gender'])? $md_address['gender']: null}}<br>
                        পিতার নামঃ  {{($md_address['father_name'])? $md_address['father_name']: null}}<br>
                        মাতার নামঃ  {{($md_address['mother_name'])? $md_address['mother_name']: null}}<br>
                        বয়সঃ  {{($md_address['age'])? $md_address['age']: null}}<br>
                        শিকক্ষাগত যোগ্যতাঃ  {{($md_address['education'])? $md_address['education']: null}}<br>
                        জাতীয় পরিচয়পত্রঃ  {{($md_address['nid'])? $md_address['nid']: null}}<br>
                    @endif


                </td>
            </tr>
            <tr>
                <td style="width: 5%">{{e_to_b(1.8)}}</td>
                <td style="width: 40%">বিস্তারিত যোগাযোগঃ</td>
                <td style="width: 60%">
                    @if($data->detailed_contact)
                        @php
                            $d_contact = json_decode($data->detailed_contact, true);
                        @endphp
                        টেলিফোনঃ  {{($d_contact['telephon'])? $d_contact['telephon']: null}}<br>
                        ফ্যাক্সঃ  {{($d_contact['fax'])? $d_contact['fax']: null}}<br>
                        ই-মেইলঃ  {{($d_contact['email'])? $d_contact['email']: null}}<br>
                    @endif

                </td>
            </tr>
            <tr>
                <td style="width: 5%">{{e_to_b(1.9)}}</td>
                <td style="width: 40%">ব্যাংক হিসাবের বর্ণনাঃ</td>
                <td style="width: 60%">

                    @if($data->bank_description)
                        @php
                            $bank_d = json_decode($data->bank_description, true);
                        @endphp
                        ব্যাংকার নামঃ {{($bank_d['bank_name'])? $bank_d['bank_name']: null}}<br>
                        ব্রাঞ্চঃ  {{($bank_d['bank_branch'])? $bank_d['bank_branch']: null}}<br>
                        ই-একাউন্ট নংঃ {{($bank_d['bank_account'])? $bank_d['bank_account']: null}}<br>
                    @endif

                </td>
            </tr>


        </table>
        <br>
        <br>
        <table style="width:100%" class="table_border">

            <tr style="background: #90db59; ">
                <td style="font-size: 25px; font-weight: bold"><b> {{e_to_b(2)}}.</b></td>
                <td colspan="2" style="font-size: 25px; font-weight: bold"> <b> আবেদনকারীর অন্যান্য তথ্যঃ </b></td>
            </tr>
            <tr>
                <td style="width: 5%">{{e_to_b(2.1)}}</td>
                <td style="width: 40%">আবেদনকারীর প্রকৃতিঃ</td>
                <td style="width: 60%">

                    @if($data->applicant_nature)
                        @php
                            $applicant_nature = json_decode($data->applicant_nature, true);

                        @endphp
                        @foreach($applicant_nature['type'] as $list)
                            {{ ($list == 'Others')? e_to_b($list). ' ('.$applicant_nature['note'].')': e_to_b($list) }} <br>
                        @endforeach
                    @endif
                </td>
            </tr>
            <tr>
                <td style="width: 5%">{{e_to_b(2.2)}}</td>
                <td style="width: 40%">কর্মী সংখ্যাঃ</td>
                <td style="width: 60%">
                    @if($data->number_of_employees)
                        @php
                            $no_emp = json_decode($data->number_of_employees, true);


                        @endphp
                        কারিগরীঃ {{($no_emp['technical'])? $no_emp['technical']: null}}<br>
                        সহযোগী স্টাফঃ {{($no_emp['associate_staff'])? $no_emp['associate_staff']: null}}<br>
                        অন্যান্যঃ {{($no_emp['other'])? $no_emp['other']: null}}<br>
                    @endif

                </td>
            </tr>
            <tr>
                <td style="width: 5%">{{e_to_b(2.3)}}</td>
                <td style="width: 40%">নির্মাণ যন্ত্রপাতি ( যদি থাকে )</td>
                <td style="width: 60%">


                    @if($data->construction_machinery)
                        @php
                            $con_machinery = json_decode($data->construction_machinery, true);
                            //dump($con_machinery);
                        @endphp
                        <table style="width: 100%" class="table3">
                            <tr>
                                <td>নং</td>
                                <td>যন্ত্রপাতির নাম	</td>
                                <td>সংখ্যা</td>
                                <td>সংগ্রহ / ক্রয়ের বছর	</td>
                                <td>বর্তমান অবস্থা	</td>
                            </tr>
                            @foreach($con_machinery as $key => $list)

                                <tr>
                                    <td>{{e_to_b($key)}}</td>
                                    <td>{{$list['equipment_name']}}</td>
                                    <td>{{$list['qty']}}</td>
                                    <td>{{$list['purchase_year']}}</td>
                                    <td>{{$list['current_status']}}</td>

                                </tr>
                                @endforeach
                        </table>

                    @endif

                </td>
            </tr>
            <tr>
                <td style="width: 5%">{{e_to_b(2.4)}}</td>
                <td style="width: 40%">নির্মাণকালীন খরচ বহনের আর্থিক সক্ষমতাঃ</td>
                <td style="width: 60%">

                    @if($data->financial_ability)
                        @php
                            $financial_a = json_decode($data->financial_ability, true);
                            //dump($financial_a);
                        @endphp
                        <table style="width: 100%" class="table3">
                            <tr>
                                <td>নং</td>
                                <td>অর্থের উৎস	</td>
                                <td>অর্থের পরিমান	</td>

                            </tr>
                            @foreach($financial_a as $key => $list)

                                <tr>
                                    <td>{{e_to_b($key)}}</td>
                                    <td>{{$list['source_of_money']}}</td>
                                    <td>{{$list['amount']}}</td>


                                </tr>
                            @endforeach
                        </table>

                    @endif

                </td>
            </tr>

            <tr style="background: #90db59; ">
                <td style="font-size: 25px; font-weight: bold"><b> {{e_to_b(3)}}.</b></td>
                <td colspan="2" style="font-size: 25px; font-weight: bold"> <b> নিষিদ্ধকরণ তথ্যঃ </b></td>
            </tr>
            <tr>
                <td style="width: 5%">{{e_to_b(3.1)}}</td>
                <td style="width: 40%">আপনি কি সরকারি কোনো প্রতিষ্ঠান হতে কখনো নিষিদ্ধ হয়েছেন?</td>
                <td style="width: 60%">
                    @if($data->forbidden_info)
                        @php
                            $forbidden_info = json_decode($data->forbidden_info, true);
                        @endphp
                       {{($forbidden_info['is_forbidden'])? e_to_b($forbidden_info['is_forbidden']): null}}<br>
                        {{ ($forbidden_info['is_forbidden'] == 'Yes')? '('.$forbidden_info['reason'].')': null }}
                    @endif

                </td>
            </tr>

            <tr style="background: #90db59; ">
                <td style="font-size: 25px; font-weight: bold"><b> {{e_to_b(4)}}.</b></td>
                <td colspan="2" style="font-size: 25px; font-weight: bold"> <b> প্রয়োজনীয় যোগ্যতাঃ </b></td>
            </tr>
            <tr>
                <td style="width: 5%">{{e_to_b(4.1)}}</td>
                <td colspan="2">
                    ক. বৈধ ট্রেড লাইসেন্স <br>
                    খ. টিআইএন সনদ <br>
                    গ. ২৫,০০০,০০/- (পঁচিশ লক্ষ) টাকার ব্যাংক স্বচ্ছলতার সনদ <br>
                    ঘ. ভ্যাট রেজিস্ট্রেশন <br>
                </td>

            </tr>
        </table>
        <br>
        <br>
        <table style="width:100%" class="table_border">

            <tr style="background: #90db59; ">
                <td style="font-size: 25px; font-weight: bold"><b> {{e_to_b(5)}}.</b></td>
                <td colspan="2" style="font-size: 25px; font-weight: bold"> <b> সংযুক্তি </b></td>
            </tr>
            <tr>
                <td style="width: 5%">{{e_to_b(1)}}</td>
                <td style="width: 80%">স্বত্বাধিকারী/ ব্যবস্থাপনা পরিচালন- এর ১ কপি পাসপোর্ট সাইজের ফটো ( নতুন আবেদনের
                    ক্ষেত্রে)
                </td>
                <td style="width: 10%">
                    {{ ($data->management)? ' হাঁ ': ' না' }}

                </td>
            </tr>
            <tr>
                <td style="width: 5%">{{e_to_b(2)}}</td>
                <td style="width: 80%">হালনাগাদ ( সর্বশেষ টিআইএন সনদ অথবা আয়কর রিটার্ন প্রাপ্তিস্বীকার প্রত্র।</td>
                <td style="width: 10%">
                    {{ ($data->tin_doc)? ' হাঁ ': ' না' }}

                </td>
            </tr>
            <tr>
                <td style="width: 5%">{{e_to_b(3)}}</td>
                <td style="width: 80%">ভ্যাট রেজিস্ট্রেশন সনদ।</td>
                <td style="width: 10%">
                    {{ ($data->vat_doc)? ' হাঁ ': ' না' }}

                </td>
            </tr>
            <tr>
                <td style="width: 5%">{{e_to_b(4)}}</td>
                <td style="width: 80%">এফিডেভিট / আর্টিকেল অফ এসোসিয়েশন (প্রযোজ্য ক্ষেত্রে)</td>
                <td style="width: 10%">
                    {{ ($data->article_of_association)? ' হাঁ ': ' না' }}

                </td>
            </tr>
            <tr>
                <td style="width: 5%">{{e_to_b(5)}}</td>
                <td style="width: 80%">বৈধ হালনাগাদ ট্রেড লাইসেন্স।</td>
                <td style="width: 10%">
                    {{ ($data->trade_licenses)? ' হাঁ ': ' না' }}

                </td>
            </tr>
            <tr>
                <td style="width: 5%">{{e_to_b(6)}}</td>
                <td style="width: 80%">স্বত্বাধিকারী/ ব্যবস্থাপনা পরিচাক বয়সের সপক্ষে কাগজপত্র (এন আই ডি)।</td>
                <td style="width: 10%">
                    {{ ($data->management_nid)? ' হাঁ ': ' না' }}

                </td>
            </tr>
            <tr>
                <td style="width: 5%">{{e_to_b(7)}}</td>
                <td style="width: 80%">মুখ্য কারিগরি জনবলের জীবন বৃত্তান্ত।</td>
                <td style="width: 10%">
                    {{ ($data->chief_manpower)? ' হাঁ ': ' না' }}

                </td>
            </tr>
            <tr>
                <td style="width: 5%">{{e_to_b(8)}}</td>
                <td style="width: 80%">স্থানীয় সরকার প্রতিষ্ঠান হতে স্বত্বাধিকারী/ ব্যবস্থাপনা পরিচালক - এর জাতীয়তা/
                    চারিত্রিক সনদ।
                </td>
                <td style="width: 10%">
                    {{ ($data->legally_bound)? ' হাঁ ': ' না' }}

                </td>
            </tr>
            <tr>
                <td style="width: 5%">{{e_to_b(9)}}</td>
                <td style="width: 80%">নিম্নোক্ত বিষয়ের নিশ্চয়তা স্বরূপ এফিডেভিটঃ আবেদনকারী আইনতভাবে ক্রয়কারী সত্তার
                    সাথে চুক্তিতে আবদ্ধ হতে সক্ষম এবং বাংলাদেশ সরকারের কোন প্রতিষ্ঠান কর্তৃক কারণে কখনো অযোগ্য বিবেচিত
                    হয় নি।
                </td>
                <td style="width: 10%">
                    {{ ($data->md_character)? ' হাঁ ': ' না' }}

                </td>
            </tr>


        </table>


    </div>


@endif
</body>
</html>