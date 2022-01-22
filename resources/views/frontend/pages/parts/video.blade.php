<div class="single-pt postBody">
    <div class="gallary-title section-title">
        <div class="videoGallery gap">
            @php
            $first_video = $mdata->first();
            @endphp
            @if($first_video)
            <div class="header_video">
                <!-- THE YOUTUBE PLAYER -->

                <div class="vid-container gap">
                    <iframe width="98%" height="400px" frameborder="0" src="{{$first_video->video_embed}}" id="vid_frame"></iframe>
                </div>

                <!-- THE PLAYLIST -->
                <div class="vid-list-container">
                    <div class="vid-list">
                        @foreach($mdata as $key => $video)

                        <div onclick="document.getElementById('vid_frame').src='{{$video->video_embed}}'" class="vid-item">
                            <div class="thumb"><img src="{{url('public/storage/'.$video->image)}}"></div>
                            <div class="desc">{{$video->title}}</div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="clear"></div>
            @endif
        </div>

    </div>
</div>