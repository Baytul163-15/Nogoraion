@extends('frontend.layouts.app')

@section('content')
<!--slider-area-start-->
@include('frontend.common.slider')
<!--slider-area-end-->
<!-- marquee-area-start-->
@include('frontend.common.marquee')
<!-- marquee-area-end-->

<div class="about-area">
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-sm-9">
                <div class="google-map-title section-title">
                    <h2>
                        ফিডব্যাক ফর্ম
                    </h2>
                </div>
                <div class="about-text">
                    {{ Form::open(array('url' => url('feedback_form'), 'method' => 'post', 'value' => 'PATCH', 'id' => 'feedback')) }}

                    <div class="box-body">
                        @include('frontend.common.message_handler')
                        {{ Form::hidden('feedback', 1) }}
                        <div class="form-group">
                            {{ Form::label('name', '  নাম   ', array('class' => 'name_en cmmone-class')) }}
                            {{ Form::text('name', NULL, ['required', 'class' => 'form-control', 'placeholder' => ' নাম  ']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('email', '   ইমেইল    ', array('class' => 'name_en cmmone-class')) }}
                            {{ Form::text('email', NULL, ['class' => 'form-control', 'placeholder' => ' ইমেইল  ']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('phone', '   ফোন   ', array('class' => 'name_en cmmone-class')) }}
                            {{ Form::text('phone', NULL, ['required', 'class' => 'form-control', 'placeholder' => ' ফোন  ']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('message', ' আপনার  বার্তা ', array('class' => 'name_en cmmone-class')) }}
                            {{ Form::textarea('message', NULL, ['required', 'class' => 'form-control', 'placeholder' => ' আপনার  বার্তা  ']) }}
                        </div>
                    </div>

                    <div class="box-footer">
                        {{ Form::submit('  ফিডব্যাক  পাঠান ', ['class' => 'btn btn-success']) }}
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
            @include('frontend.theme.'.lv_theme().'.sidebar_right')
        </div>
    </div>
</div>
@endsection