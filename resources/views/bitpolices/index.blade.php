@extends('layouts.master')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb mb-3">
            <div class="pull-left d-flex">
                <h4><i class="fas fa-user"></i> Bitpolices</h4>
                <a class="btn btn-success ml-3" href="{{ route('bitpolices.create') }}" style="line-height: 20px;opacity: .9;height: 33px"><i class="fas fa-plus"></i> Add New Bitpolice</a>
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
            <th>Designation</th>
            <th>Bit Name</th>
            <th>Address</th>
            <th>Location</th>
            <th>Mobile</th>
            <th>Name</th>
            <th>Active</th>
            <th width="280px">Action</th>
        </tr>
        @inject('extra', 'App\Http\Controllers\bitpoliceController')
	    @foreach ($bitpolices as $bitpolice)
	    <tr>
	        <td>{{ ++$i }}</td>
	        <td>{{ $bitpolice->designation }}</td>
            <td>{{ $bitpolice->bit_name }}</td>
            <td>{{ $bitpolice->address }}</td>
            <td>{{ $bitpolice->location }}</td>
            <td>{{ $bitpolice->mobile }}</td>
            <td>{{ $bitpolice->name }}</td>         
            <td>{{ $bitpolice->is_active }}</td>         
	        <td>   
                <form method="post" class="delete_form" action="{{ url('/bitpolices',$bitpolice['id']) }}" id="studentForm_{{$bitpolice['id']}}">
                    <a class="badge badge-info" href="{{ route('bitpolices.show',$bitpolice->id) }}">Show</a>
                    <a class="badge badge-primary" href="{{ route('bitpolices.edit',$bitpolice->id) }}">Edit</a>
                
                  {{ method_field('DELETE') }}
                  {{  csrf_field() }}
                  <button type="submit" class="badge badge-danger">{{ trans('Delete') }}</button>
                  </form>
	        </td>
	    </tr>
	    @endforeach
    </table>


    {!! $bitpolices->links() !!}


 
@endsection