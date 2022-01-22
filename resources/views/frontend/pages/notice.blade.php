@extends('frontend.layouts.app')

@section('content')



<!-- main content section start -->
<div class="container">
    <div class="row">
        <div class="col-md-9 col-sm-12">




            @if($count > 0)
            <table class="table table-bordered">

                <tbody>
                    <tr>
                        <th class="afotie" style="color:#000; font-weight:bold" scope="row">
                            SL
                        </th>

                        <td style="color:#000; font-weight:bold">
                            Title
                        </td>
                        <td style="text-align:center; color:#000; font-weight:bold">
                            Date of publication</td>
                        <th class="afotie" style="color:#000; font-weight:bold" scope="row">
                            Download
                        </th>
                    </tr>

                    @php
                    $sl = $mdata->perPage() * ($mdata->currentPage() - 1) +1;

                    @endphp
                    @foreach($mdata as $key => $data)
                    <tr>
                        <th class="afotie" scope="row">{{$key+$sl}}</th>

                        <td><a href="{{url('post/'.$data->slug)}}" target="_blank">
                                {{ $data->title }}
                            </a>
                        </td>
                        <td style="text-align:center">
                            <a href="javascript:void(0)">
                                <span class="entry-date">
                                    {{ date('F d, Y', strtotime($data->created_at))}}
                                </span>
                            </a>
                        </td>
                        <th class="afotie" scope="row">
                            @if($data->files && $files = json_decode($data->files, true))
                             @foreach($files as $file)
                               <a href="{{ asset('storage/'.$file['download_link'])}}" target="_blank">
                                    <i class="fa fa-file-pdf-o"></i>
                                </a>
                             @endforeach
                            @endif
                        </th>
                    </tr>
                    @endforeach

                </tbody>
            </table>

            {{ $mdata->links() }}


            @else

            <div class="flex-center position-ref full-height">
                <div class="code"> 404 </div>

                <div class="message" style="padding: 10px;"> Not Found </div>
            </div>
            @endif


        </div>



        @include('frontend.theme.'.lv_theme().'.sidebar_right')




    </div>
</div>
</div>
</div>
</div>
</div>





@endsection

@section('cusjs')

@endsection
