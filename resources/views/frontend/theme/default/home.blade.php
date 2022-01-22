<div class="col-md-12">
    @include('frontend.common.slider')
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="pct_barefwr">
                <div class="col-md-6">
                    @php
                    $id_ond = (setting('home-page.home_section_one'))? setting('home-page.home_section_one') : 2;


                    $ig_page = App\Page::Where(['id' => $id_ond])->first();


                    @endphp

                    @if($ig_page)
                    <div class="sidebar-title section-title">
                        <h2>{{ $ig_page->title }}</h2>
                    </div>
                    <div class="pcd-area">
                        <div class="pct-img"><img src="{{ url('public/storage/'.$ig_page->image) }}" alt=""> </div>
                        <div class="pcd-content">
                            <div class="pc-name">
                                <h3> {{ $ig_page->name }} </h3>
                                <h5><span> {{ $ig_page->designation }}</span></h5>
                            </div>
                            <p>
                                {!! substr($ig_page->body, 0, 190) !!} ...

                                <a href="{{ url('page/'.$ig_page->slug) }}">
                                    {!! lv_lang('Read More') !!}
                                </a>
                            </p>
                        </div>
                    </div>
                    @endif

                </div>
                <div class="col-md-6">

                    @php
                    $id_two = (setting('home-page.home_section_two'))? setting('home-page.home_section_two') : 3;
                    $dig_page = App\Page::Where(['id' => $id_two])->first();


                    @endphp

                    @if($dig_page)
                    <div class="sidebar-title section-title">
                        <h2>{{ $dig_page->title }}</h2>
                    </div>
                    <div class="pcd-area">
                        <div class="pct-img"><img src="{{ url('public/storage/'.$dig_page->image) }}" alt=""> </div>
                        <div class="pcd-content">
                            <div class="pc-name">
                                <h3> {{ $dig_page->name }} </h3>
                                <h5><span> {{ $dig_page->designation }}</span></h5>
                            </div>
                            <p>
                                {!! substr($dig_page->body, 0, 190) !!} ...

                                <a href="{{ url('page/'.$dig_page->slug) }}">
                                    {!! lv_lang('Read More') !!}
                                </a>
                            </p>
                        </div>
                    </div>
                    @endif


                </div>
            </div>


        </div>
        <div class="col-md-12" style="margin-top:15px">

            @include('frontend.common.widget_one', [
            'widget' => App\Categorie::Where(['slug' =>setting('home-page.home_section_three')])->first()
            ])

            @include('frontend.common.widget_one', [
            'widget' => App\Categorie::Where(['slug' =>setting('home-page.home_section_four')])->first()
            ])

            @include('frontend.common.widget_one', [
            'widget' => App\Categorie::Where(['slug' =>setting('home-page.home_section_five')])->first()
            ])

            @include('frontend.common.widget_one', [
            'widget' => App\Categorie::Where(['slug' =>setting('home-page.home_section_six')])->first()
            ])





        </div>

        <div class="col-md-12" style="margin-top:15px">

            @include('frontend.common.widget_notice', [
            'widget' => App\Categorie::Where(['slug' =>setting('home-page.home_section_seven')])->first()
            ])


        </div>

    </div>




    <section class="acpt-part">
        <div class="row">

            <div class="col-md-12">



                <!-- Photo Gallery -->
                <section style="margin-bottom: 15px;">


                    @include('frontend.pages.parts.photo_group', ['mdata' => get_cat_post(['slug' =>
                    'photo-gallery','limit' => 6])['data']])

                </section>
                <!-- Video Gallery -->
                <section>
                    <div class="">
                        <div class="sidebar-title section-title">
                            <h2>{!! lv_lang('Video Gallery') !!} </h2>
                        </div>
                    </div>


                    @include('frontend.pages.parts.video', ['mdata' => get_cat_post(['slug' =>
                    'video-gallery','limit' => 10])['data']])



                </section>

                <!-- Latest News -->

                @if(false)
                <section style="margin-bottom: 15px;">

                    <div class="">
                        <div class="sidebar-title section-title">
                            <h2>
                                {!! lv_lang('Latest News') !!}
                            </h2>
                        </div>
                    </div>



                    <div class="asrfsec">
                        <div class="slider-wp owl-carousel owl-theme">
                            @php
                            $notices = get_cat_post(['slug' => 'latest-news','limit' => 10]);


                            @endphp


                            @foreach($notices['data'] as $key => $data)

                            <div class="single-aerqa">

                                <div class="news-wpaser">
                                    <div class="single-newsas">
                                        <div class="safrv">
                                            <p class="news_aser_title"> <a href="http://www.riverpolice.gov.bd/report-on-fisheries-operations-and-other-rescue/">
                                                    {{ $data->title }}</a> </p>
                                        </div>

                                        <div class="single-newsas_sr">
                                            <a href="http://www.riverpolice.gov.bd/report-on-fisheries-operations-and-other-rescue/">

                                                @if($data->image)
                                                <img width="400" height="250" src="{{ url('public/storage/'.$data->image) }}" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="" /> </a>

                                            @else

                                            <img width="400" height="250" src="{{ asset('/frontend/img/no_img.png')}}" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="" /> </a>
                                            @endif
                                        </div>
                                        <div class="post-dater">
                                            <p><span><i class="fa fa-calendar"></i></span>
                                                {{ date('F d,Y', strtotime($data->created_at)) }}</p>
                                        </div>
                                        <div class="single-newsas_ct">



                                            <p class="news_aser_pa">
                                                {!! substr($dig_page->body, 0, 70) !!} ...

                                                <a href="{{ url('post/'.$data->slug ) }}">

                                                    {!! lv_lang('Read More') !!}
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            @endforeach





                        </div>
                        <div class="col-md-12">
                            <div class="a34froes" style="text-align:center">
                                <a href="{{ url('post_cat/latest-news' ) }}"> {!! lv_lang('More News') !!} <i class="fa fa-long-arrow-right"></i> </a>

                            </div>
                        </div>
                    </div>
                </section>
                @endif





            </div>
        </div>
    </section>

</div>
