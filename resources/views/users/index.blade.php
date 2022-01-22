@extends('layouts.master')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb mb-3">
        <div class="pull-left d-flex">
            <h4><i class="fas fa-user"></i> Users</h4>
            <a class="btn btn-success ml-3" href="{{ route('users.create') }}" style="line-height: 20px;opacity: .9;height: 33px"><i class="fas fa-plus"></i> Add New</a>
        </div>
    </div>
</div>


@if ($message = Session::get('success'))
<div class="alert alert-success">
  <p>{{ $message }}</p>
</div>
@endif


<table class="table table-bordered" id="datatable">
 <tr>
   <th>No</th>
   <th>Name</th>
   <th>Email</th>
   <th>Phone</th>
   <th>Roles</th>
   <th width="280px">Action</th>
 </tr>
 @foreach ($data as $key => $user)
  <tr>
    <td>{{ ++$i }}</td>
    <td>{{ $user->name }}</td>
    <td>{{ $user->email }}</td>
    <td>{{ $user->phone }}</td>
    <td>
      @if(!empty($user->getRoleNames()))
        @foreach($user->getRoleNames() as $v)
           <label class="badge badge-success">{{ $v }}</label>
        @endforeach
      @endif
    </td>
    <td>
       <a class="badge badge-info" href="{{ route('users.show',$user->id) }}">Show</a>
       <a class="badge badge-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>
        {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
        {!! Form::close() !!}
    </td>
  </tr>
 @endforeach
</table>


{!! $data->render() !!}
@endsection