@extends('voyager::master')

@section('page_title','')

@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">

<style>
    .clphotodelte {
        position: relative;
    }
    .clphotodelte a {
        position: absolute;
        background: #000;
        color: #fff;
        width: 25px;
        height: 25px;
        line-height: 28px;
        text-align: center;
        font-size: 18px;
        border-radius: 30px;
        top: -10px;
        left: -8px;
    }
</style>
@stop



@section('content')
<div class="container-fluid">
    <h1 class="page-title">
        <i class="voyager-news"></i> Add Contact List
    </h1>
    <a href="{{route('contactlist.index')}}" class="btn btn-danger btn-add-new">
        <i class="voyager-angle-left" aria-hidden="true"></i> <span> Back</span>
    </a>



</div>
<div class="page-content container-fluid">


    <div class="row">
        <div class="col-md-12">
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

                    {{ Form::open(['route' => 'contactlist.store', 'method' => 'post', 'enctype' => 'multipart/form-data']) }}
                    {{ Form::hidden('id', (!empty($fdata->id) ? $fdata->id : NULL), []) }}
                    <div class="box-body">
                        <div class="panel panel-default">
                            <div class="panel-heading" style="padding:15px">Contact List menu</div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group {{ ($errors->has('name'))? 'has-error' : '' }}">
                                            {{ Form::label('name', 'Name', array('class' => 'name')) }}
                                            {{ Form::text('name', (!empty($fdata->name) ? $fdata->name : NULL), ['class' => 'form-control', 'placeholder' => ' Name...']) }}
                                            @if($errors->has('name'))
                                            <span class="help-block">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>

                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group {{ ($errors->has('menu_id'))? 'has-error' : '' }}">
                                            {{ Form::label('menu_id', ' Group Name ', array('class' => 'menu_id')) }}
                                            {{ Form::select('menu_id',  get_contactlist_array(),
                                         (!empty($fdata->menu_id) ? $fdata->menu_id : NULL),
                                        ['class' => 'form-control', 'placeholder' => '--Select--']) }}
                                            @if($errors->has('menu_id'))
                                            <span class="help-block">{{ $errors->first('menu_id') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group {{ ($errors->has('designation'))? 'has-error' : '' }}">
                                            {{ Form::label('designation', '  Designation', array('class' => 'designation')) }}
                                            {{ Form::text('designation', (!empty($fdata->designation) ? $fdata->designation : NULL), ['class' => 'form-control', 'placeholder' => ' Designation...']) }}
                                            @if($errors->has('designation'))
                                            <span class="help-block">{{ $errors->first('designation') }}</span>
                                            @endif
                                        </div>

                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group {{ ($errors->has('phone'))? 'has-error' : '' }}">
                                            {{ Form::label('phone', ' Phone', array('class' => 'phone')) }}
                                            {{ Form::text('phone', (!empty($fdata->phone) ? $fdata->phone : NULL), ['class' => 'form-control', 'placeholder' => ' phone...']) }}
                                            @if($errors->has('phone'))
                                            <span class="help-block">{{ $errors->first('phone') }}</span>
                                            @endif
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group {{ ($errors->has('mobile'))? 'has-error' : '' }}">
                                            {{ Form::label('mobile', 'Mobile', array('class' => 'mobile')) }}
                                            {{ Form::text('mobile', (!empty($fdata->mobile) ? $fdata->mobile : NULL), ['class' => 'form-control', 'placeholder' => ' mobile...']) }}
                                            @if($errors->has('mobile'))
                                            <span class="help-block">{{ $errors->first('mobile') }}</span>
                                            @endif
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group {{ ($errors->has('fax'))? 'has-error' : '' }}">
                                            {{ Form::label('fax', ' Fax', array('class' => 'fax')) }}
                                            {{ Form::text('fax', (!empty($fdata->fax) ? $fdata->fax : NULL), ['class' => 'form-control', 'placeholder' => ' fax...']) }}
                                            @if($errors->has('fax'))
                                            <span class="help-block">{{ $errors->first('fax') }}</span>
                                            @endif
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group {{ ($errors->has('email'))? 'has-error' : '' }}">
                                            {{ Form::label('email', ' Email', array('class' => 'email')) }}
                                            {{ Form::text('email', (!empty($fdata->email) ? $fdata->email : NULL), ['class' => 'form-control', 'placeholder' => ' email...']) }}
                                            @if($errors->has('email'))
                                            <span class="help-block">{{ $errors->first('email') }}</span>
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
                                    <div class="col-md-4">
                                        @if(!empty($fdata->photo))
                                        <div class="clphotodelte">
                                            <a href="{{ route('contactlist.photo.detele', $fdata->id) }}" onclick="return confirm('It will be deleted permanently, Are you sure?')">
                                                <span class="voyager-x remove-multi-file"> </span>
                                            </a>
                                            <img src="{{ asset('storage/'.$fdata->photo) }}" style="height: 55px">
                                        </div>
                                            
                                           
                                        @else 

                                        <div class="form-group {{ ($errors->has('is_active'))? 'has-error' : '' }}">
                                          
                                            
                                            {{ Form::file('photo') }}
                                            @if($errors->has('is_active'))
                                            <span class="help-block">{{ $errors->first('is_active') }}</span>
                                            @endif
                                        </div>
                                        @endif
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