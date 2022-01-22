@if($widget)
<div class="notice-title section-title">
    <h2> {{$widget->name}} </h2>
</div>
<div class="notice_haf">
    <div class="notice-one" style="background:url(http://www.riverpolice.gov.bd/wp-content/uploads/2019/09/notice.png) no-repeat">
        <!--<div class="notice-caption">-->
        <!--  <h3>নোটিশ বোর্ড</h3>-->
        <!--</div>-->
        <div class="notice-list" id="example2">
            <ul class="list-unstyled">

                @php
                $notices = get_cat_post(['slug' => $widget->slug,'limit' => 5]);

                @endphp
                @foreach($notices['data'] as $key => $data)


                <li><a href="{{ url('post/'.$data->slug ) }}" rel="bookmark" title="{{ $data->title }}">
                        {{ $data->title }}</a>
                </li>

                @endforeach

            </ul>
        </div>


        <div class="notice-btn">
            <a class="" href="{{ url('notice/notice-board' ) }}">{!! lv_lang('All') !!} </a>
        </div>
    </div>
</div>

@endif