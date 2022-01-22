@extends('frontend.layouts.app')

@section('content')


<div class="container">
    <div class="row">
        <!--slider-area-start-->

        <!--slider-area-end-->

        <!-- main content section start -->

        @include('frontend.theme.'.lv_theme().'.home')






        @include('frontend.theme.'.lv_theme().'.sidebar_right')




    </div>
</div>






@endsection

@section('cusjs')
@endsection