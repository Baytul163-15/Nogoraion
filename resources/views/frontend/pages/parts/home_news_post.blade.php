@if($category)

<div class="col-md-12" style="margin-top: 15px;">
    <div class="notice-title section-title">
        <div class="gallary-title section-title">
            <h2>{{$category->name}}</h2>
        </div>
    </div>
</div>

@php
$category_data = get_cat_post(['slug' =>
$category->slug,'limit' => 6,'desc' => 'DESC']);
@endphp
@if($category_data['data_count'] > 0)
<div class="col-md-12">

    <div class="photo-gallary-area">
        <div class="row">

            @foreach($category_data['data'] as $key => $data)

            <div class="col-md-6">
                <div class="news-widget">
                    <a href="{{url('post/'.$data->slug)}}">
                        @if(!empty($data->image))
                        <img src="{{ url('public/storage/'.$data->image) }}" class="news-widget-img">
                        @else
                        <img src="{{ url('public/frontend/img/no_img.png') }}" class="news-widget-img">
                        @endif
                        <p class="news-widget-text">
                            {{$data->title}}


                        </p>

                    </a>

                </div>
            </div>
            @endforeach

        </div><!-- .dpe-flexible-posts -->
    </div>
</div>

<div class="col-md-12">
    <div class="a34froes" style="text-align:center">
        <a href="{{url('post_cat/'.$category->slug)}}"> আরও {{$category->name}} <i class="fa fa-long-arrow-right"></i>
        </a>
    </div>
</div>
@else
<div class="col-md-12">
    <p class="nodata">
        No Post Yet!
    </p>
</div>

@endif
@endif
