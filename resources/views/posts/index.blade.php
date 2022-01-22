@extends('layouts.master')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb mb-3">
            <div class="pull-left d-flex">
                <h4><i class="fas fa-user"></i> Posts</h4>
                <a class="btn btn-success ml-3" href="{{ route('posts.create') }}" style="line-height: 20px;opacity: .9;height: 33px"><i class="fas fa-plus"></i> Add New Post</a>
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
            <th>Type</th>
            <th width="280px">Action</th>
        </tr>
        @inject('extra', 'App\Http\Controllers\PostController')
	    @foreach ($posts as $post)
	    <tr>
	        <td>{{ ++$i }}</td>
	        <td>{{ $post->title }}</td>
            <td>{{ $post->slug }}</td>
	        <td>
                @if($post->image)
                <img src="{{ url('public/storage/'.$post->image) }}" height="100">
                @endif
            </td>
            <td>{{ $post->featured==1 ? 'বর্তমান' :'সাবেক' }}</td>            
	        <td>
                <form action="{{ route('posts.destroy',$post->id) }}" method="POST">
                    <a class="badge badge-info" href="{{ route('posts.show',$post->id) }}">Show</a>
                    @can('post-edit')
                    <a class="badge badge-primary" href="{{ route('posts.edit',$post->id) }}">Edit</a>
                    @endcan


                    @csrf
                    @method('DELETE')
                    @can('post-delete')
                    <button type="submit" class="badge badge-danger">Delete</button>
                    @endcan
                </form>
	        </td>
	    </tr>
	    @endforeach
    </table>


    {!! $posts->links() !!}


 
@endsection