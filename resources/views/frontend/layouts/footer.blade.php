<!-- footer-top area start -->
<div class="important-linkseer footer-top-one">
    <div class="container">
        <div class="row">
            <div class="footer-wap">
                <div class="col-md-12">
                    <div class="important-linkseer">
                        <div class="textwidget">

                            @php
                            $footer_menus = json_decode(menu('footer_menu','_json'), true);

                            @endphp
                            <ul class="list-unstyled">
                                @foreach($footer_menus as $data)

                                <li><a href="{{ $data['url'] }}" target="{{ $data['target'] }}"
                                        rel="noopener">{{ $data['title'] }}</a></li>
                                @endforeach

                            </ul>


                        </div>

                    </div>

                    <div class="address_home">
                        <div class="asrfcccc">
                            <div class="">
                                <div class="textwidget">


                                    <p>
                                        {!! setting('site.footer_address') !!}

                                    </p>



                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- @dump(visitor()->visit()) --}}
<!-- footer-top area end -->
<div class="footer-btn">
    <div class="container">

        <div class="footer-btn-warp">
            <div class="row">
                <div class="col-md-4 col-sm-4">

                    <div class="footer-down-right footer-down-right_laEWrv ">
                        {!! setting('site.social_media') !!}
                    </div>
                </div>

                <div class="col-md-4 col-sm-4">

                    <div class="sidebar-wap">

                        <div id="mvcwid" style="text-align: Left; color: #000;">



                            <div id="xtvctable">
                                <div id="xtvcvisit" style="text-align: Left; color: #000;"><img
                                        src="{{asset('frontend/css/images/mvcvisit.png')}}">
                                    Users Today : {{ getvisitor()['unique24h'] }}</div>
                                <div id="xtvctotal" style="text-align: Left; color: #000;"><img
                                        src="{{asset('frontend/css/images/mvctotal.png')}}">
                                    Total Users : {{ getvisitor()['uniqueTotal'] }}</div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="footer-down-right">

                        <div class="copy-right">
                            <div class="sidebar-wap">
                                <div class="textwidget">
                                    <p>Design &amp; Develop by FLIT : 01872788592 / 01729724232</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>