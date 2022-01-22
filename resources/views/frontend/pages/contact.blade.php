@extends('frontend.layouts.app')

@section('content')



<!-- main content section start -->
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <!-- google-map section start -->
            <div class="google-map">
                @if(setting('site.google_map'))
                <div class="google-map-title  section-title">


                    <h2>Map</h2>

                </div>

                <div class="map">
                    <div class="textwidget">
                        <p>
                            {!! setting('site.google_map') !!}
                        </p>
                    </div>
                </div>
                @endif
                @if(setting('site.contact_address'))
                <div class="notice-title section-title_aiowerj">
                    <h2>Address</h2>
                </div>
                <div class="contact-info">
                    <div class="textwidget">

                        {!! setting('site.contact_address') !!}

                    </div>
                </div>
                @endif

            </div>
            <!-- google-map section end -->
        </div>
        <!-- sidebar-ara section start -->
        <div class="col-md-4">

            @if(function_exists('lv_contact'))

            @include('contact::frontend.contact')
            @endif

        </div>
        <!-- sidebar-area end-->

    </div>
</div>
</div>
</div>
</div>
</div>





@endsection

@section('cusjs')
@endsection