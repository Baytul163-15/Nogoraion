@php
    $con_req = App\ContactorRequest::Where(['user_id' => $user['user_id']])->get();

   // dump($con_req);
    $data_count =$con_req->count();
    $sl = 0;


@endphp

@if($data_count > 0)



    <div class="panel-body">
        <table class="table table-striped table-bordered styled-table_o">
            <tr>
                <th>ক্রঃ নং</th>
                <th>আবেদনের প্রকার</th>
                <th>টাকার বিবরণ </th>
                <th>তারিখ</th>
                <th>স্ট্যাটাস</th>
                <th>আবেদন</th>
            </tr>

            <tbody>
            @foreach($con_req as $list)

                @php
                    $sl++;
                $tp_info = json_decode($list->request_fee_info, true);

                @endphp
                <tr>
                    <td>{{ e_to_b($sl) }}</td>
                    <td>
                        {{ e_to_b($list->application_type) }}


                    </td>


                    <td>
                        <b title=" পেমেন্ট মেথডঃ ">পেমেন্ট মেথডঃ  </b> {{e_to_b($tp_info['payment_method'])}}<br>
                        <b title=" টাকার পরিমাণঃ ">টাকার পরিমাণঃ </b> {{e_to_b($tp_info['amount'])}} টাকা<br>
                        @if(!$tp_info['bank'])
                            <b title=" মোবাইল নম্বর ">মোঃ নং </b> {{e_to_b($tp_info['number'])}}<br>
                            <b title=" ট্যাক্স আইডি">ট্যাক্স আইডিঃ </b> {{$tp_info['tid']}}<br>
                        @else
                            <b title=" পে অর্ডার নং ">পে অর্ডার নং </b> {{e_to_b($tp_info['payorder'])}}<br>
                            <b title="ব্যাংকঃ ">ব্যাংকঃ </b> {{e_to_b($tp_info['bank'])}}<br>
                            <b title=" শাখা ">শাখাঃ </b> {{e_to_b($tp_info['branch'])}}<br>
                        @endif
                    </td>
                    <td>
                        {{ e_to_b(date('d-F-Y', strtotime($list->request_date))) }}
                    </td>
                    <td>
                        <button type="button" class="btn btn-default btn-sm" disabled>
                            {{ e_to_b($list->request_status) }}
                        </button>
                    </td>

                    <td>




                        <div class="btn-group disabled " role="group" disabled="disabled">

                            <button type="button" class="btn btn-xs btn-danger dropdown-toggle"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                <i class="fa fa-print" aria-hidden="true"></i>
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" style="right: 0; left: inherit">
                                <li><a href="lease_aplication_print/{{$list->id}}" target="_blank">আবেদন</a></li>
                                <li><a href="contractor_request_money_reicept/{{$list->id}}" target="_blank">মানি রিসিপ্ট</a></li>
                            </ul>
                        </div>


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
