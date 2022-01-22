<header class="top-area">
    <div class="container">
        <div class="row">
            <div class="headertop">
                <div class="col-md-6">
                    <div class="topLogoName">
                        <div class="">
                            <div class="textwidget">
                                <p>{!! setting('site.title') !!}</p>
                            </div>


                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="headerDate">
                        <div class="row">
                            <div class="multilangual">
                                <ul class="list-unstyled">
                                    <!-- <li> Sunday, December 29, 2019 </li> -->
                                    <li>{{ lv_lang(date('l, F d, Y')) }} </li>
                                </ul>
                                {{-- <div class="leng_cls">
                                    <ul>
                                        <li class="lang-item lang-item-189 lang-item-bn lang-item-first"><a lang="bn-BD" hreflang="bn-BD" href="http://www.riverpolice.gov.bd/bn/">বাংলা</a></li>
                                    </ul>
                                </div> --}}
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</header>




<!-- headaer section end-->
<div class="container">
    <div class="row">
        <div class="">
            <div class="mit-bannder">

                <a href="{{ url('/') }}">
                    <div class="single-footer">
                        <div class="textwidget">

                            {{-- <p><img
                                    src="{{ Storage::disk(config('voyager.storage.disk'))->url(setting('site.header_logo'))}}" />
                            </p> --}}
                            <p><img
                                    src="{{ asset('storage/settings/March2021/hEgCe2uxUl30qBHFX7RZ.jpg') }}" />
                            </p>
                        </div>
                    </div>
                </a>

            </div>
        </div>
    </div>
</div>



<!-- main-menu section start-->
<div class="serrvrv">
    <div class="container">

        <div class="">
            <div class="row">
                <div class="nav-area">
                    <!-- nav start -->
                    <div id="main-nav" class="stellarnav navone">
                        <div class="stellarnav navone">
                            <!-- {{ menu('top_menu', 'frontend.common.top_menu') }} -->
                            @php
                            $menus = App\Menulist::where('parent_id', '=', 0)->get();
                            @endphp
                            <ul class="navbar-nav">
                                @foreach($menus as $menu)
                                    <li class="nav-item dropdown">
                                        <a class="nav-link {{ count($menu->childs) ? 'dropdown-toggle' :'' }}" href="{{ url('/') }}/{!! $menu->url !!}" id="navbarDropdownMenuLink" data-toggle="{{ count($menu->childs) ? 'dropdown' :'' }}" aria-haspopup="true" aria-expanded="false">
                                            {{ $menu->title }}
                                        </a>
                                        @if(count($menu->childs))
                                        <ul class="dropdown-menu " aria-labelledby="navbarDropdownMenuLink">
                                            @include('menu.menusub',['childs' => $menu->childs]) 
                                        </ul>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>                              
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>



<!-- main-menu section end-->


@php
$top_lates_news = get_cat_post(['slug' => 'latest-news','limit' => 5,'pagination' => 'No']);
@endphp



<!--marqueeContent section start  -->
@if($top_lates_news['data_count'] > 0)
<div class="container">
    <div class="row">
        <div class="">
            <div class="marqueeContent">
                <div class="news-gbtn">
                    <a href="{{ url('notice/latest-news' ) }}">{{ lv_lang('Latest News')}} </a>
                </div>
                <div class="ptms_marquee">
                    <marquee onmouseout="this.start()" onmouseover="this.stop()" direction="left" scrolldelay="10"
                        scrollamount="5" style="color:#FF0000;font:Arial;">
                        <ul>
                            @foreach($top_lates_news['data'] as $key => $data)

                            <li>
                                <a href="{{ url('post/'.$data->slug ) }}" rel="bookmark" title="{{ $data->title }}">
                                    {{ $data->title }}
                                </a>
                            </li>

                            @endforeach


                        </ul>
                    </marquee>

                </div>

            </div>
        </div>
    </div>
</div>
@endif
<!--marqueeContent section end 