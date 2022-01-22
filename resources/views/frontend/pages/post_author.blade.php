@extends('frontend.layouts.app')

@section('content')



<!-- main content section start -->
<div class="container">
    <div class="row">
        <div class="col-md-9 col-sm-12">

            @if($count > 0)

            @foreach($mdata as $data)

            <div class="col-md-4 col-sm-4">
                <div class="cont_cmn">
                    <div class="thumbnail thumbnail_one thumbnail_one-ct">
                        <a href="{{ url('post/'.$data->slug ) }}">


                            @if($data->image)
                            <img width="400" height="250" src="{{ url('public/storage/'.$data->image) }}" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="">

                            @else

                            <img width="400" height="250" src="{{ asset('/frontend/img/no_img.png')}}" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="" /> </a>
                        @endif
                        <div class="thumbnail_one-title">
                            <h5>{{ $data->title }} </h5>
                        </div>

                        </a>
                    </div>
                </div>
            </div>
            @endforeach

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