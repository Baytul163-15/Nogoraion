@extends('layouts.master')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb mb-3">
            <div class="pull-left d-flex">
                <h4><i class="fas fa-user"></i> Edit Bitpolice</h4>
                <a class="btn btn-success ml-3" href="{{ route('bitpolices.index') }}" style="line-height: 20px;opacity: .9;height: 33px"><i class="fa fa-angle-left"></i> Btpolice List</a>
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
    <form action="{{ route('bitpolices.update',$bitpolice->id) }}" method="post" enctype="multipart/form-data">
    	@csrf
        @method('PUT')
        <div class="card-body">
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>Designation</strong>
                        <input type="text" name="designation" class="form-control" value="{{ $bitpolice->designation }}">
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>Bit Name</strong>
                        <input type="text" name="bit_name" class="form-control" value="{{ $bitpolice->bit_name }}">
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>Address</strong>
                        <textarea class="form-control" style="height:80px" name="address">{{ $bitpolice->address }}</textarea>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>Location</strong>
                        <input type="text" name="location" class="form-control" value="{{ $bitpolice->location }}">
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>Phone</strong>
                        <input type="text" name="phone" class="form-control" value="{{ $bitpolice->phone }}">
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>Mobile</strong>
                        <input type="text" name="mobile" class="form-control" value="{{ $bitpolice->mobile }}">
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>Fax</strong>
                        <input type="text" name="fax" class="form-control" value="{{ $bitpolice->fax }}">
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>Email</strong>
                        <input type="text" name="email" class="form-control" value="{{ $bitpolice->email }}">
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>Remarks</strong>
                        <textarea class="form-control" style="height:80px" name="remarks">{{ $bitpolice->remarks }}</textarea>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>Name</strong>
                        <input type="text" name="name" class="form-control" value="{{ $bitpolice->name }}">
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <label for="customFile">Featured Image</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="photo">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                            <img src="{{ url('public/storage/'.$bitpolice->photo) }}" class="p-2 mb-4" width="100px"> 
                            <input type="hidden" name="hidden_image" value="{{ $bitpolice->photo }}" />
                      </div>
                  </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>Map</strong>
                        <input type="text" name="map" class="form-control" value="{{ $bitpolice->map }}">
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>Active Status</strong>
                        <select name="is_active" class="form-control">
                            <option value="Yes" {{ ($bitpolice->is_active == 'Yes') ? 'selected' : '' }}>Yes</option>
                            <option value="No" {{ ($bitpolice->is_active == 'No') ? 'selected' : '' }}>No</option>
                            <option value="Del" {{ ($bitpolice->is_active == 'Del') ? 'selected' : '' }}>Delete</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
          <a href="{{ route('bitpolices.index') }}" class="btn btn-default float-right">Cancel</a>
        </div>
    </form>
</div>

 
@endsection