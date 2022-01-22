@extends('frontend.layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-9 col-sm-12">

            <div class="notice-title section-title">
                <h2>Video Gallery</h2>
            </div>

            @include('frontend.pages.parts.video', ['mdata' => $mdata])

        </div>
        @include('frontend.theme.'.lv_theme().'.sidebar_right')
    </div>
</div>




@endsection

@section('cusjs')
@endsection