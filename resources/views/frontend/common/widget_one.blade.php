@if($widget)
<div class="single-category well">
    <div class="category-title">
        <h3>{{$widget->name}}</h3>
    </div>

    <ul class="dpe-flexible-posts">
        @php
        $widget_data = get_cat_post(['slug' =>
        $widget->slug,'limit' => 3,'desc' => 'ASC']);


        @endphp
        @foreach($widget_data['data'] as $key => $data)

        <li id="post-1460" class="post-1460 post type-post status-publish format-standard has-post-thumbnail hentry category-performance-management">
            <a href="{{ url('post/'.$data->slug ) }}">
                @if($key == 0 && $widget_data['cat_image'])

                <img width="135" height="95" src="{{ url('public/storage/'.$widget_data['cat_image']) }}" class="attachment-medium size-medium wp-post-image" alt="" />
                @endif
                <div class="title">{{ $data->title }}</div>
            </a>
        </li>
        @endforeach

    </ul><!-- .dpe-flexible-posts -->
</div>
@endif