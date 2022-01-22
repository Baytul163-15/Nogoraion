@extends('layouts.master')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb mb-3">
            <div class="pull-left d-flex">
                <h4><i class="fas fa-user"></i> Show Post</h4>
                <a class="btn btn-success ml-3" href="{{ route('posts.index') }}" style="line-height: 20px;opacity: .9;height: 33px"><i class="fas fa-plus"></i> Back</a>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                {{ $post->title }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Image</strong>
                @if($post->image)
                    <img src="{{ url('public/storage/'.$post->image) }}" height="200">
                @endif
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Details:</strong>
                {{ $post->body }}
            </div>
        </div>
    </div>
@endsection
 