@extends('layouts.master')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb mb-3">
        <div class="pull-left d-flex">
            <h4><i class="fas fa-user"></i> Create Post</h4>
            <a class="btn btn-success ml-3" href="{{ route('posts.index') }}" style="line-height: 20px;opacity: .9;height: 33px"><i class="fas fa-plus"></i> Back</a>
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
  <!-- /.card-header -->
    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>Title</strong>
                        <input name="title" class="form-control">
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <input type="hidden" name="author_id" value="{{Auth::id()}}">
                        <strong>Category</strong>
                        <select class="form-control select2" name="category_id">
                          @foreach($category as $item)
                          <option value="{{ $item->id }}">{{ $item->name }}</option>
                          @endforeach
                        </select>    
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>Slug</strong>
                        <input type="slug" class="form-control" name="slug">
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <label for="customFile">Feature Image</label>
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" name="image">
                          <label class="custom-file-label" for="customFile">Choose file</label>
                      </div>
                  </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>Body</strong>
                        <textarea class="form-control" style="height:150px" name="body" id="summernote"></textarea>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>Type</strong>
                        <select name="featured" class="form-control">
                            <option value="0">সাবেক</option>
                            <option value="1">বর্তমান</option>
                        </select>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>Duration</strong>
                        <input name="excerpt" class="form-control">
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>SEO Title</strong>
                        <input name="seo_title" class="form-control">
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>Meta Keywords</strong>
                        <input type="text" name="meta_keywords" class="form-control">
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>Meta Description</strong>
                        <textarea class="form-control" style="height:150px" name="meta_description"></textarea>
                    </div>
                </div>
                
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>Status</strong>
                        <select name="status" class="form-control">
                            <option value="PUBLISHED">PUBLISHED</option>
                            <option value="DRAFT">DRAFT</option>
                            <option value="PENDING">PENDING</option>
                        </select>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>Video Embed</strong>
                        <input type="text" name="video_embed" class="form-control">
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
          <button type="submit" class="btn btn-default float-right">Cancel</button>
        </div>
    </form>
</div>




@endsection