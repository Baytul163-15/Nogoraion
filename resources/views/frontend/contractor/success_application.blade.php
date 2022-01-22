@php
    $tenders = App\ContactorRequest::Where(['user_id' => $user['user_id'], 'request_status' => 'Granted'])->get();

   // dump($tenders);
    $data_count =$tenders->count();
    $sl = 0;


@endphp

@if($data_count > 0)



    <div class="panel-body">
        <table class="table table-striped table-bordered styled-table_o">
            <tr>
                <th>ক্রঃ নং</th>


                <th>ইজারার টাকা</th>
                <th>ভ্যাটের টাকা</th>
                <th>ট্যাক্সের টাকা</th>
                <th>আবেদন</th>
            </tr>

            <tbody>
            @foreach($tenders as $list)

                @php
                    $sl++;

                    $tender = App\LandSession::Where(['id' => $list->tender_id])->get()->first();
                   // dump($tender);
                   $tp_info = json_decode($list->tender_payment_info, true);
                  // dump($list);




                @endphp
                <tr>
                    <td>{{ $sl }}</td>



                    <td>
                        @if($list->fee_info)
                            @php
                                $fee = json_decode($list->fee_info, true);
                            @endphp

                            <small>
                                <b title="দোকানের ভাড়াঃ">টাকার পরিমাণঃ </b>{{ e_to_b($fee['amount']) }} টাকা <br>
                                <b title="দোকানের সেলামীঃ">পে অর্ডার / ব্যাংক ড্রাফট
                                    নং </b>{{ e_to_b($fee['payorder']) }}
                                <br>
                                <b title="দোকানের ভ্যাটঃ">তারিখঃ </b>{{ e_to_b($fee['date']) }} <br>
                                <b title="দোকানের আয়করঃ">ব্যাংকের নামঃ </b>{{ $fee['bank'] }} <br>
                                <b title="দোকানের আয়করঃ">শাখাঃ </b>{{ $fee['branch'] }}
                            </small>

                        @else

                        @endif
                    </td>
                    <td>
                        @if($list->vat_info)
                            @php
                                $vat = json_decode($list->vat_info, true);
                            @endphp
                            <small>
                                <b title="দোকানের ভাড়াঃ">টাকার পরিমাণঃ </b>{{ e_to_b($vat['amount']) }} টাকা <br>
                                <b title="দোকানের সেলামীঃ">পে অর্ডার / ব্যাংক ড্রাফট
                                    নং </b>{{ e_to_b($vat['payorder']) }}
                                <br>
                                <b title="দোকানের ভ্যাটঃ">তারিখঃ </b>{{ e_to_b($vat['date']) }} <br>
                                <b title="দোকানের আয়করঃ">ব্যাংকের নামঃ </b>{{ $vat['bank'] }} <br>
                                <b title="দোকানের আয়করঃ">শাখাঃ </b>{{ $vat['branch'] }}
                            </small>
                        @else

                        @endif
                    </td>
                    <td>
                        @if($list->tax_info)
                            @php
                                $tax = json_decode($list->tax_info, true);
                            @endphp
                            <small>
                                <b title="দোকানের ভাড়াঃ">টাকার পরিমাণঃ </b>{{ e_to_b($tax['amount']) }} টাকা <br>
                                <b title="দোকানের সেলামীঃ">পে অর্ডার / ব্যাংক ড্রাফট
                                    নং </b>{{ e_to_b($vat['payorder']) }}
                                <br>
                                <b title="দোকানের ভ্যাটঃ">তারিখঃ </b>{{ e_to_b($tax['date']) }} <br>
                                <b title="দোকানের আয়করঃ">ব্যাংকের নামঃ </b>{{ $tax['bank'] }} <br>
                                <b title="দোকানের আয়করঃ">শাখাঃ </b>{{ $tax['branch'] }}
                            </small>
                        @else

                        @endif
                    </td>
                    <td>
                        @if($list->payment_status)
                            <button class="btn btn-info btn-xs"> {{e_to_b($list->payment_status)}}
                            </button>
                            <a  href="contractor_final_money_reicept/{{$list->id}}" target="_blank" class="btn btn-danger btn-xs">
                                <i class="fa fa-print" aria-hidden="true"></i>
                            </a>
                        @else


                            <button class="btn btn-info btn-xs" data-toggle="modal"
                                    data-target="#payment-option-land-{{$list->id}}">পেমেন্ট অপশন
                            </button>

                            @include('frontend.contractor.con_payment')

                        @endif


                    </td>


                </tr>
            @endforeach
            </tbody>
        </table>

    </div>

@else

    <div class="sorry_not_font">
        <h3>দুঃখিত, এখন আবেদন করার জন্য কোন জমি নেই।</h3>
    </div>

@endif

