@extends('layouts.master')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb mb-3">
        <div class="pull-left d-flex">
            <h4><i class="fas fa-user"></i> Create Category</h4>
            <a class="btn btn-success ml-3" href="{{ route('categories.index') }}" style="line-height: 20px;opacity: .9;height: 33px"><i class="fa fa-angle-left"></i> Category List</a>
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
    <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>Title</strong>
                        <input name="name" class="form-control">
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
                          <input type="file" class="custom-file-input" name="cat_image">
                          <label class="custom-file-label" for="customFile">Choose file</label>
                      </div>
                  </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
          <a href="{{ route('categories.index') }}" class="btn btn-default float-right">Cancel</a>
        </div>
    </form>
</div>




@endsection