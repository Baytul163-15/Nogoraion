<!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title> নাগরিক সনদপত্র </title>
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

        .bable2 table, .bable2 th, .bable2 td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        @page {
            header: page-header;
            footer: page-footer;
            margin-top: 250px;:
        }


    </style>
</head>
<body>

<?php

$user = App\User::where(['id' => $data->user_id])->get()->first();

$fee_info =  json_decode($data->fee_info, true);
$vat =  json_decode($data->vat_info, true);
$tax =  json_decode($data->tax_info, true);


?>

@if (Route::has('login'))

    <htmlpageheader name="page-header">
        <table border="0" style="width:100%;margin:auto;">
            <tr>
                <td colspan="4"
                    style="width: 100%; padding: 20px;background: #9E57B5; border: 0px solid #000; color: #FFFFFF;">
                    <table style="width: 100%;  border: 0px solid #000;">
                        <tr>
                            <td>
                                <img src="{{ $settings->com_logourl }}" alt="" width="80" height="80">
                            </td>
                            <td style="width:90%;padding-left:30px; font-size: 35px; color:#FFF; text-align: center; font-weight: bold">
                                {{ $settings->com_name }}
                                <p style="font-size: 25px; color:#FFF; ">
                                    তালিকাভূক্তি / তালিকাভূক্তি নবায়নের আবেদন  বিবিধ আদায় রশিদ
                                </p>
                            </td>


                        </tr>
                    </table>
                </td>
            </tr>


        </table>
    </htmlpageheader>
    <htmlpagefooter name="page-footer">
        <table border="0" style="width:100%;margin:auto;">
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

    <div style="margin:20px; padding-top: 30px">


        <table border="0" style="width:100%;margin:auto;">
            <tr>
                <td style="width: 20%"></td>
                <td style="width: 20%"></td>
                <td style="width: 20%"></td>
                <td style="width: 20%"></td>
                <td style="width: 20%"></td>
            </tr>

            <tr>
                <td colspan="3" style="text-align: left; display: block;padding-left: 15px;padding: 30px 0">
                    বিবিধ আদায় রশিদ নং - {{e_to_b($data->id)}}
                </td>
                <td colspan="3" style="text-align: right; display: block;padding-left: 15px;padding: 30px 0">
                    <?php $date = date("d-F-Y", strtotime($data->payment_date));?>
                    তারিখ:- {{e_to_b($date)}} ইং


                </td>
            </tr>
            <tr>
                <td style="width: 20%">
                    <b> নাম</b>
                </td>
                <td colspan="4" style=" border-bottom: 2px dotted; display: block;padding-left: 15px;">

                    {{ ($user->bnname)?$user->bnname:$user->name }}

                </td>
            </tr>
            <tr>
                <td style="width: 20%">
                    <b> পিতার নাম </b>
                </td>
                <td colspan="4" style=" border-bottom: 2px dotted; display: block;padding-left: 15px;">

                    {{ ($user->bnfathername)?$user->bnfathername:$user->enfathername }}

                </td>
            </tr>
            <tr>
                <td>
                    <b> মোবাইল</b>
                </td>
                <td colspan="4" style=" border-bottom: 2px dotted; display: block;padding-left: 15px;">
                    {{ e_to_b($user->phone) }}
                </td>
            </tr>





        </table>


        <table style="width:100%; margin-top: 30px" class="bable2">
            <tr style="background: #ccc; color: #fff">
                <th>নাম</th>
                <th>পে অর্ডার/ব্যাংক ড্রাফট নং</th>
                <th>তারিখ</th>
                <th>ব্যাংকের নাম</th>
                <th>শাখা</th>
                <th>টাকার পরিমাণ</th>
            </tr>
            <tr>
                <td>সেলামীর অর্থ বাবদ</td>
                <td> {{ e_to_b($fee_info['payorder']) }}</td>
                <td> {{ e_to_b($fee_info['date']) }}</td>
                <td> {{ e_to_b($fee_info['bank']) }}</td>
                <td> {{ e_to_b($fee_info['branch']) }}</td>
                <td style="text-align: right"> {{ e_to_b($fee_info['amount']) }} টাকা</td>
            </tr>
            <tr>
                <td>ভ্যাটের পরিমাণ	</td>
                <td> {{ e_to_b($vat['payorder']) }}</td>
                <td> {{ e_to_b($vat['date']) }}</td>
                <td> {{ e_to_b($vat['bank']) }}</td>
                <td> {{ e_to_b($vat['branch']) }}</td>
                <td style="text-align: right"> {{ e_to_b($vat['amount']) }} টাকা</td>
            </tr>
            <tr>
                <td>আয়করে পরিমাণ	</td>
                <td> {{ e_to_b($tax['payorder']) }}</td>
                <td> {{ e_to_b($tax['date']) }}</td>
                <td> {{ e_to_b($tax['bank']) }}</td>
                <td> {{ e_to_b($tax['branch']) }}</td>
                <td style="text-align: right"> {{ e_to_b($tax['amount']) }} টাকা</td>
            </tr>

            <tr>
                <td colspan="5" style="text-align: right">মোটঃ</td>

                <td style="text-align: right"> {{ e_to_b($tax['amount']+$fee_info['amount']+$vat['amount']) }} টাকা</td>
            </tr>
        </table>



        {{--    Footer --}}

        <table border="0" style="width:100%;margin:auto;">
            <tr>
                <td style="width: 20%"></td>
                <td style="width: 20%"></td>
                <td style="width: 20%"></td>
                <td style="width: 20%"></td>
                <td style="width: 20%"></td>
            </tr>



            <tr>
                <td>
                    <img src="{{ asset('public/img/paid.png') }}" style="width: 100px;">

                </td>
                <td colspan="4" style="display: block;padding-left: 15px; text-align: right; padding-top: 60px">

                    আদায়কারীর স্বাক্ষর

                </td>
            </tr>

        </table>


    </div>


@endif
</body>
</html>