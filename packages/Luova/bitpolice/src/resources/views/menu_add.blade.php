@extends('voyager::master')

@section('page_title','')

@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
@stop



@section('content')
<div class="container-fluid">
    <h1 class="page-title">
        <i class="voyager-news"></i> Bit Police Groups
    </h1>

    <a href="{{route('bitpolice.index')}}" class="btn btn-danger btn-add-new">
        <span> Back</span>
    </a>


</div>
<div class="page-content container-fluid">

    <div class="row">
        <div class="col-md-7">
            <div class="panel panel-bordered">
                {{-- <div class="panel"> --}}
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="box box-warning" style="padding:15px">

                    {{ Form::open(array('route' => 'bitpolice.group.store', 'method' => 'post')) }}
                    {{ Form::hidden('id', (!empty($fdata->id) ? $fdata->id : NULL), []) }}
                    <div class="box-body">
                        <div class="panel panel-default">
                            <div class="panel-heading" style="padding:15px">Contact List menu</div>
                            <div class="panel-body">
                                <div class="row">


                                    <div class="col-md-4">
                                        <div class="form-group {{ ($errors->has('name'))? 'has-error' : '' }}">
                                            {{ Form::label('name', ' Menu Name', array('class' => 'name')) }}
                                            {{ Form::text('name', (!empty($fdata->name) ? $fdata->name : NULL), ['class' => 'form-control', 'placeholder' => ' Menu name...']) }}
                                            @if($errors->has('name'))
                                            <span class="help-block">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group {{ ($errors->has('parent'))? 'has-error' : '' }}">
                                            {{ Form::label('parent', ' Parent ', array('class' => 'parent')) }}
                                            {{ Form::select('parent',  get_add_bitpolice_array(),
                                         (!empty($fdata->parent) ? $fdata->parent : NULL),
                                        ['class' => 'form-control', 'placeholder' => '--Select--']) }}
                                            @if($errors->has('parent'))
                                            <span class="help-block">{{ $errors->first('parent') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group {{ ($errors->has('is_active'))? 'has-error' : '' }}">
                                            {{ Form::label('is_active', ' Is Active ', array('class' => 'is_active')) }}
                                            {{ Form::select('is_active',  ['Yes' => 'Active', 'No' => 'Inactive'],
                                         (!empty($fdata->is_active) ? $fdata->is_active : NULL),
                                        ['class' => 'form-control']) }}
                                            @if($errors->has('is_active'))
                                            <span class="help-block">{{ $errors->first('is_active') }}</span>
                                            @endif
                                        </div>
                                    </div>




                                </div>
                            </div>
                        </div>

                        <!-- /.box-body -->
                        <div class="box-footer">
                            <input class="btn btn-success" type="submit" value="Save Changes">
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="panel panel panel-bordered panel-warning">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="icon wb-clipboard"></i> Post Details</h3>
                    <div class="panel-actions">
                        <a class="panel-action voyager-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
                    </div>
                </div>
                <div class="panel-body" style=" height: 650px; overflow-y: scroll;">
                    <table class="table table-striped table-responsive">
                        <tr>
                            <th style="width: 10px;"> # </th>
                            <th>Name</th>
                            <th>Status</th>


                            <th style="text-align: right; width:120px">
                                Action
                            </th>
                        </tr>

                        <!-- @dump($mdata) -->

                        @if($mdata)



                        @foreach($mdata as $key => $data)
                        <tr>
                            <td data-value="ID">{{ $key +1 }}</td>
                            <td>{{ $data->name }} </td>
                            <td>{{ $data->is_active }} </td>

                            <td>
                                {{ Form::open(['route' => ['bitpolice.group.delete', $data->id], 'method' => 'delete']) }}
                                <div class="btn-group btn-group-sm pull-right">
                                    <a href="{{ route('bitpolice.group.edit', $data->id)}}" class="btn btn-info" target="_blank">
                                        <i class="voyager-edit" aria-hidden="true"></i>
                                    </a>

                                    <button onclick="return confirm('Are you sure?')" class="btn btn-danger">
                                        <i class="voyager-trash" aria-hidden="true"></i>
                                    </button>
                                </div>
                                {{ Form::close() }}
                            </td>
                        </tr>
                        @if($data->children && $data->children->isNotEmpty())
                        @foreach($data->children as $children)

                        <tr>
                            <td data-value="ID"></td>
                            <td> -- {{ $children->name }} </td>
                            <td>{{ $children->is_active }} </td>

                            <td>
                                {{ Form::open(['route' => ['bitpolice.group.delete', $children->id], 'method' => 'delete']) }}
                                <div class="btn-group btn-group-sm pull-right">
                                    <a href="{{ route('bitpolice.group.edit', $children->id)}}" class="btn btn-info" target="_blank">
                                        <i class="voyager-edit" aria-hidden="true"></i>
                                    </a>


                                    <button onclick="return confirm('Are you sure?')" class="btn btn-danger">
                                        <i class="voyager-trash" aria-hidden="true"></i>
                                    </button>
                                </div>
                                {{ Form::close() }}
                            </td>
                        </tr>

                        @if($children->children && $children->children->isNotEmpty())
                        @foreach($children->children as $child)

                        <tr>
                            <td data-value="ID"> </td>
                            <td> -- -- {{ $child->name }} </td>
                            <td>{{ $child->is_active }} </td>

                            <td>
                                {{ Form::open(['route' => ['bitpolice.group.delete', $child->id], 'method' => 'delete']) }}
                                <div class="btn-group btn-group-sm pull-right">
                                    <a href="{{ route('bitpolice.group.edit', $child->id)}}" class="btn btn-info" target="_blank">
                                        <i class="voyager-edit" aria-hidden="true"></i>
                                    </a>


                                    <button onclick="return confirm('Are you sure?')" class="btn btn-danger">
                                        <i class="voyager-trash" aria-hidden="true"></i>
                                    </button>
                                </div>
                                {{ Form::close() }}
                            </td>
                        </tr>


                        @endforeach
                        @endif


                        @endforeach
                        @endif

                        @endforeach


                        @endif


                    </table>
                </div>
            </div>
        </div>
    </div>


</div>
@stop

@section('javascript')
<script>
    $('document').ready(function() {
        $('.toggleswitch').bootstrapToggle();
    });
</script>
@stop