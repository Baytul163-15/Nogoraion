<div class="row">

    <div class="col-md-12" style="margin-top: 15px;">
        <div class="notice-title section-title">

            <div class="gallary-title section-title">
                <h2> {!! lv_lang('Photo Gallery') !!}</h2>
            </div>


        </div>
    </div>


    <div class="col-md-12">

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
            {!! '<div class="row">' !!}

                @endif

                @endforeach


            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="a34froes" style="text-align:center">
            <a href="{{url('gallery/photo')}}"> {!! lv_lang('More Photo') !!} <i class="fa fa-long-arrow-right"></i>
            </a>
        </div>
    </div>
</div>