@extends('frontend.layouts.app')

@section('content')



<!-- main content section start -->
<div class="container">
    <div class="row">
        <div class="col-md-9 col-sm-12">

            @if($mdata)
            <div class="single-contantg">
                <div class="navigation"></div>
                <h2 class="singleTitle">{{ $mdata->title }}</h2>
                @if($mdata->files)
                <div class="files">

                    @if($files = json_decode($mdata->files, true))
                    @foreach($files as $file)

                    <a class="btn btn-danger" href="{{ asset($file['download_link'])}}">
                        <i class="fa fa-file-pdf-o"></i> Download file

                    </a>

                    @endforeach
                    @endif



                </div>
                @endif
                <div class="asrease">

                    @if($mdata->image)
                    <img src="{{ url('public/storage/'.$mdata->image) }}">

                    @endif




                </div>
                <div class="single-pt">
                    {!! $mdata->body !!}
                </div>
                <div class="navigation"></div>
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