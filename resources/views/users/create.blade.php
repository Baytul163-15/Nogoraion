@extends('layouts.master')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb mb-3">
        <div class="pull-left d-flex">
            <h4><i class="fas fa-user"></i> Create New User</h4>
            <a class="btn btn-success ml-3" href="{{ route('users.index') }}" style="line-height: 20px;opacity: .9;height: 33px"><i class="fa fa-angle-left"></i> User List</a>
        </div>
    </div>
</div>


@if (count($errors) > 0)
  <div class="alert alert-danger">
    <ul>
       @foreach ($errors->all() as $error)
         <li>{{ $error }}</li>
       @endforeach
    </ul>
  </div>
@endif


<div class="card card-default">
    {!! Form::open(array('route' => 'users.store','method'=>'POST')) !!}
    @csrf
    <div class="card-body">
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Name:</strong>
                    {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Email:</strong>
                    {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Phone:</strong>
                    {!! Form::text('phone', null, array('placeholder' => 'Phone','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Password:</strong>
                    {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Confirm Password:</strong>
                    {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Role:</strong>
                    {!! Form::select('roles[]', $roles,[], array('class' => 'form-control','select2')) !!}
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
      <a href="{{ route('users.index') }}" class="btn btn-default float-right">Cancel</a>
    </div>
    {!! Form::close() !!}
</div>


 
@endsection