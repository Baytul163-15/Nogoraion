@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb mb-3">
        <div class="pull-left d-flex">
            <h4><i class="fas fa-user"></i> Manage Menu</h4>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <h5 class="mb-4 text-center bg-success text-white py-2">Add New Item</h5>
                <form accept="{{ route('menus.store')}}" method="post">
                    @csrf
                    @if(count($errors) > 0)
                        <div class="alert alert-danger  alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            @foreach($errors->all() as $error)
                                {{ $error }}<br>
                            @endforeach
                        </div>
                    @endif
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success  alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" name="title" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Parent</label>
                                <select class="form-control" name="parent_id">
                                    <option value="0">Select Parent Menu</option>
                                    @foreach($allMenus as $key => $value)
                                        <option value="{{ $key }}">{{ $value}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Slug</label>
                                <input type="text" name="url" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-success">Save</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-8">
                <h5 class="text-center mb-4 bg-info text-white py-2">Menu Items</h5>
                <ul id="tree1">
                    @foreach($menus as $menu)
                        <li>
                            {{ $menu->title }} <div class="btn-group" style="display: -webkit-inline-box;"><a href="{{ url('/edit-menu',$menu->id) }}" class="badge badge-info text-white">Edit</a> <form action="{{ url('/delete-menu',$menu->id) }}" class="ml-1" method="POST">{{ csrf_field() }}<button type="submit" class="badge badge-danger">Delete</button></form></div>
                            @if(count($menu->childs))
                                @include('menu.manageChild',['childs' => $menu->childs])
                            @endif
                        </li>
                    @endforeach

                </ul>
            </div>
        </div>
    </div>
</div>
@endsection