@extends('layouts.master')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb mb-3">
        <div class="pull-left d-flex">
            <h4><i class="fas fa-user"></i> Create Bitpolice</h4>
            <a class="btn btn-success ml-3" href="{{ route('bitpolices.index') }}" style="line-height: 20px;opacity: .9;height: 33px"><i class="fas fa-plus"></i> Back</a>
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
    <form action="{{ route('bitpolices.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>Designation</strong>
                        <input type="hidden" name="create_date" value="{{ date('Y-m-d') }}">
                        <input type="text" name="designation" class="form-control">
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>Bit Name</strong>
                        <input type="text" name="bit_name" class="form-control">
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>Address</strong>
                        <textarea class="form-control" style="height:80px" name="address"></textarea>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>Location</strong>
                        <input type="text" name="location" class="form-control">
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>Phone</strong>
                        <input type="tel" name="phone" class="form-control">
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>Mobile</strong>
                        <input type="tel" name="mobile" class="form-control">
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>Fax</strong>
                        <input type="text" name="fax" class="form-control">
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>Email</strong>
                        <input type="email" name="email" class="form-control">
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>Remarks</strong>
                        <textarea class="form-control" style="height:80px" name="remarks"></textarea>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>Name</strong>
                        <input type="text" name="name" class="form-control">
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <label for="customFile">Feature Image</label>
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" name="photo">
                          <label class="custom-file-label" for="customFile">Choose file</label>
                      </div>
                  </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>Map</strong>
                        <input type="text" name="map" class="form-control">
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>Active Status</strong>
                        <select name="is_active" class="form-control">
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                            <option value="Del">Delete</option>
                        </select>
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