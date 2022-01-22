@extends('frontend.layouts.app')

@section('content')



<!-- main content section start -->
<div class="container">
    <div class="row">
        <div class="col-md-9 col-sm-12">
            @if($mdata)

            <div class="arfrsr">
                <div class="navigation"></div>
                <div class="notice-title section-title">
                    <h2>{{ $mdata->title }} </h2>
                </div>
                @if($mdata->image)
                <div class="notice-img">
                    <img src="{{ url('public/storage/'.$mdata->image) }}" alt="">
                </div>
                @endif

                <div class=" notice-content">
                    @if($mdata->name)
                    <p class="aserfwaer"> {{ $mdata->name }}</p>
                    @endif
                    @if($mdata->designation )
                    <p class="asfrrxa"> {{ $mdata->designation }} </p>

                    @endif

                    <p>
                        {!! $mdata->body !!}
                    </p>


                </div>
                <div class="navigation"></div>
            </div>
            @else
            <div class="flex-center position-ref full-height">
                <div class="code"> 404 </div>

                <div class="message" style="padding: 10px;"> Not Found </div>
            </div>

            @endif


        </div>



        @include('frontend.theme.'.lv_theme().'.sidebar_right')




    </div>
</div>
</div>
</div>
</div>
</div>





@endsection

@section('cusjs')
@endsection