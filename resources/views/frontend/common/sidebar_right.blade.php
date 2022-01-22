<!-- sidebar-ara section start -->
<div class="col-md-3 col-sm-12">
    <div class="row">
        <!-- sidebar-area start -->

        <div class="sidebar-area pct_barefwr">
            <div class="col-md-12">
                <div class="asrtaoic">
                    <div class="main-carrd-tab">
                        <div class="over-sidebar-part">
                            <div class="sidebar-title section-title">
                                <h2> {!! lv_lang('Facebook Page') !!} </h2>
                            </div>
                            <div class="textwidget">
                                <p>

                                    {!! setting('site.facebook_page') !!}
                                </p>
                            </div>
                        </div>
                        {{-- children --}}
                        @foreach(menu('sideber', '_json') as $list)





                        <div class="sidebar-wap">
                            <div class="sidebar-title section-title">
                                <h2>{{ $list->title}} </h2>
                            </div>
                            <div class="textwidget">
                                <div class="sidebar-list_br">
                                    <ul class="list-unstyled">


                                        @if(!$list->children->isEmpty())


                                        @foreach($list->children as $data)



                                        <li><a href="{{ $data->url }}" target="{{ $data->target }}" rel="noopener">
                                                <span class="list-icone"><img
                                                        src="{{ asset('/frontend/img/list_icon.png')}}" /></span>
                                                {{ $data->title }} </a></li>

                                        @endforeach

                                        @endif

                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endforeach


                        @if(setting('site.hotline_image'))

                        <div class="sidebar-wap">
                            <div class="sidebar-title section-title">
                                <h2> {!! lv_lang('Emergency hotline') !!} </h2>
                            </div>
                            <div class="textwidget">
                                <div class="sidebar-list_br" style="background: #fff; width:100%">



                                    <img src="{{url('public/storage/'.setting('site.hotline_image'))}}"
                                        style="width: 80%; margin:auto; display:block" />
                                </div>


                            </div>
                        </div>
                        @endif


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>