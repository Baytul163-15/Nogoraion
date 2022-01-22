@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb mb-3">
        <div class="pull-left d-flex">
            <h4><i class="fas fa-user"></i> Edit Menu</h4>
            <a class="btn btn-primary ml-3" href="{{ url('menus') }}" style="line-height: 20px;opacity: .9;height: 33px"><i class="fa fa-angle-left"></i> Menu List</a>
        </div>
    </div>
</div>
@php
$cid = request()->route('id');
$emenu= App\Menulist::where('id', '=', $cid)->get();
@endphp
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <h5 class="mb-4 text-center bg-success text-white ">Add New Item</h5>
                <form accept="{{ url('edit-menu') }}/{{ $emenu[0]->id }}" method="post">
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
                                <input type="text" name="title" class="form-control" value="{{ $emenu[0]->title }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Parent</label>
                                <select class="form-control" name="parent_id">
                                    <option>Select Parent Menu</option>
                                    @foreach($allMenus as $key => $value)
                                        <option value="{{ $key }}" 
                                        @if ( $key == $emenu[0]->parent_id)
                                        selected
                                        @endif
                                         >{{ $value}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Slug</label>
                                <input type="text" name="url" class="form-control" value="{{ $emenu[0]->url }}">
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
                <h5 class="text-center mb-4 bg-info text-white">Menu Items</h5>
                <ul id="tree1">
                    @foreach($menus as $menu)
                        <li>
                            {{ $menu->title }}
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