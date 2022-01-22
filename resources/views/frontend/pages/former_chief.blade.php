@extends('frontend.layouts.app')

@section('content')



<!-- main content section start -->
<div class="container">
    <div class="row">
        <div class="col-md-9 col-sm-12" style="padding: 0">

            @if($cat)
            <div class="notice-title section-title">
                <h2>{{ $cat->name }} </h2>
            </div>
            @endif


            @if($count > 0)

            <div class="row  former_chief_wp">

                @php
                $sl = $mdata->perPage() * ($mdata->currentPage() - 1) +1;
                @endphp
                @foreach($mdata as $key => $data)

                <div class="col-md-4">
                    <div class="single_former_chief">
                        <div class="former_chief_img">
                            <img src="{{ url('public/storage/'.$data->image)}}" alt="{{ $data->title }}">
                        </div>
                        <div class="former_chief_name">
                            <h4> {{ $data->title }} </h4>
                        </div>
                        <div class="para">
                            <p>{{ ($data->excerpt)?$data->excerpt:null }}</p>
                        </div>
                    </div>
                </div>
                @if(($key+1) % 3 == 0)
            </div>
            <div class="row former_chief_wp">

                @endif

                @endforeach

            </div>




            {{ $mdata->links() }}


            @else

            <div class=" full-height text-center">
                <br>
                <br>
                <br>
                <br>
                <div class="message" style="padding: 10px;"> 404 |Not Found </div>
                @auth
                <p>Please Post in this category. Category slug must be : former-chief </p>
                @endauth

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