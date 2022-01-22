@extends('frontend.layouts.app')

@section('content')



<div class="container">
    <div class="row">
        <div class="col-md-9 col-sm-12">

            <div class="single-contantg postWapper">

                <div class="notice-title section-title">
                    <h2>Photo Gallery</h2>
                </div>

                <div class="single-pt postBody">





                    <div class="photo-gallary-area">
                        <h3>{{$mdata->title}}</h3>
                        <div class="row">
                            @php
                            $images = json_decode($mdata->photos, true);

                            $i = 1;
                            @endphp

                            @if($images)

                            @foreach($images as $photo)

                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="img-gallery-item">
                                    <a class="example-image-link" data-lightbox="example-set" href="{{ url('public/storage/'.$photo)}}">
                                        <img src="{{ url('public/storage/'.$photo) }}">

                                    </a>

                                </div>
                            </div>


                            @if (($i++) % 3 == 0)
                            {!! '</div>' !!}
                        {!! '<div class="row" style="margin-top:30px ;">' !!}

                            @endif

                            @endforeach
                            @else

                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="img-gallery-item">
                                    <a class="example-image-link" data-lightbox="example-set" href="{{ url('public/storage/'.$mdata->image)}}">
                                        <img src="{{ url('public/storage/'.$mdata->image) }}">

                                    </a>

                                </div>
                            </div>
                            @endif




                        </div>
                    </div>







                </div>

            </div>

        </div>
        @include('frontend.theme.'.lv_theme().'.sidebar_right')
    </div>
</div>







@endsection

@section('cusjs')
@endsection