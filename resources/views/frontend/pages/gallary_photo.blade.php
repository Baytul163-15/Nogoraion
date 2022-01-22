@extends('frontend.layouts.app')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-9 col-sm-12">

            <div class="row">
                <div class="col-md-12">
                    <div class="notice-title section-title">

                        <div class="gallary-title section-title">
                            <h2>Photo Gallery</h2>
                        </div>


                    </div>
                </div>

                <div class="col-md-12">
                    <div class="single-contantg postWapper">

                        <div class="singleTitle postTitle">
                            <h2>Photo Gallery</h2>
                        </div>

                        <div class="single-pt postBody">





                            <div class="photo-gallary-area">
                                <div class="row">
                                    @php

                                    $i = 1;
                                    @endphp

                                    @foreach($mdata as $key => $photo)

                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <div class="img-gallery-item">
                                            <a class="example-image-link" data-lightbox="example-set" href="{{ url('public/storage/'.$photo->image)}}">
                                                <img src="{{ url('public/storage/'.$photo->image) }}">

                                            </a>
                                            <h3 class="photogallery-title"><a href="{{route('site.gallery.single',$photo->id)}}">{{$photo->title}}</a> </h3>
                                        </div>
                                    </div>


                                    @if (($i++) % 3 == 0)
                                    {!! '</div>' !!}
                                {!! '<div class="row" style="margin-top:30px ;">' !!}

                                    @endif

                                    @endforeach


                                </div>
                            </div>







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