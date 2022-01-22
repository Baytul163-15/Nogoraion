@extends('layouts.master')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb mb-3">
            <div class="pull-left d-flex">
                <h4><i class="fas fa-user"></i> Edit Post</h4>
                <a class="btn btn-success ml-3" href="{{ route('posts.index') }}" style="line-height: 20px;opacity: .9;height: 33px"><i class="fa fa-angle-left"></i> Post List</a>
            </div>
        </div>
    </div>


    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

<div class="card card-default">
    <form action="{{ route('posts.update',$post->id) }}" method="POST" enctype="multipart/form-data">
    	@csrf
        @method('PUT')
        <div class="card-body">
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>Title</strong>
                        <input type="text" name="title" class="form-control" value="{{ $post->title }}">
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <input type="hidden" name="author_id" value="{{Auth::id()}}">
                        <strong>Category</strong>
                        <select class="form-control select2" name="category_id">
                          @foreach($category as $item)
                          <option value="{{ $item->id }}" {{ ( $item->id == $post->category_id) ? 'selected' : '' }}> 
                            {{ $item->name }}
                          </option>
                          @endforeach
                        </select>    
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>Slug</strong>
                        <input name="slug" type="text" class="form-control" value="{{ $post->slug }}">
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <label for="customFile">Featured Image</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="image">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                            <img src="{{ url('public/storage/'.$post->image) }}" class="p-2 mb-4" width="100px"> 
                            <input type="hidden" name="hidden_image" value="{{ $post->image }}" />
                      </div>
                  </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>Body</strong>
                        <textarea class="form-control" style="height:150px" name="body" id="summernote">{{ $post->body }}</textarea>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>Type</strong>
                        <select name="featured" class="form-control">
                            <option value="0" {{ ($post->featured == '0') ? 'selected' : '' }}>সাবেক</option>
                            <option value="1" {{ ($post->featured == '1') ? 'selected' : '' }}>বর্তমান</option>
                        </select>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>Duration</strong>
                        <input type="text" name="excerpt" class="form-control" value="{{ $post->excerpt }}">
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>SEO Title</strong>
                        <input type="text" name="seo_title" class="form-control" value="{{ $post->seo_title }}">
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>Meta Keywords</strong>
                        <input type="text" name="meta_keywords" class="form-control" value="{{ $post->meta_keywords }}">
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>Meta Description</strong>
                        <textarea class="form-control" style="height:150px" name="meta_description">{{ $post->meta_description }}</textarea>
                    </div>
                </div>
                
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>Status</strong>
                        <select name="status" class="form-control">
                            <option value="PUBLISHED" {{ ($post->status == 'PUBLISHED') ? 'selected' : '' }}>PUBLISHED</option>
                            <option value="DRAFT" {{ ($post->status == 'DRAFT') ? 'selected' : '' }}>DRAFT</option>
                            <option value="PENDING" {{ ($post->status == 'PENDING') ? 'selected' : '' }}>PENDING</option>
                        </select>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>Video Embed</strong>
                        <input type="text" name="video_embed" class="form-control" value="{{ $post->video_embed }}">
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
          <a href="{{ route('posts.index') }}" class="btn btn-default float-right">Cancel</a>
        </div>
    </form>
</div>

 
@endsection