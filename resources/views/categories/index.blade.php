@extends('layouts.master')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb mb-3">
            <div class="pull-left d-flex">
                <h4><i class="fas fa-user"></i> Categories</h4>
                <a class="btn btn-success ml-3" href="{{ route('categories.create') }}" style="line-height: 20px;opacity: .9;height: 33px"><i class="fas fa-plus"></i> Add New Category</a>
            </div>
        </div>
    </div>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Title</th>
            <th>Slug</th>
            <th>Image</th>
            <th width="280px">Action</th>
        </tr>
	    @foreach ($categories as $data)
	    <tr>
	        <td>{{ ++$i }}</td>
	        <td>{{ $data->name }}</td>
            <td>{{ $data->slug }}</td>
	        <td>
                @if($data->cat_image)
                <img src="{{ url('public/storage/'.$data->cat_image) }}" height="100">
                @endif
            </td>
	        <td>
                <form action="{{ route('categories.destroy',$data->id) }}" method="POST">
                    <a class="badge badge-info" href="{{ route('categories.show',$data->id) }}">Show</a>
                    @can('category-edit')
                    <a class="badge badge-primary" href="{{ route('categories.edit',$data->id) }}">Edit</a>
                    @endcan

                    @csrf
                    @method('DELETE')
                    @can('category-delete')
                    <button type="submit" class="badge badge-danger">Delete</button>
                    @endcan
                </form>
	        </td>
	    </tr>
	    @endforeach
    </table>


    {!! $categories->links() !!}


 
@endsection