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
        <i class="voyager-news"></i> Add Widget
    </h1>
    <a href="{{route('lvwidget.index')}}" class="btn btn-danger btn-add-new">
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

                    {{ Form::open(['route' => 'lvwidget.store', 'method' => 'post', 'enctype' => 'multipart/form-data']) }}
                    {{ Form::hidden('id', (!empty($fdata->id) ? $fdata->id : NULL), []) }}
                    <div class="box-body">
                        <div class="panel panel-default">
                            <div class="panel-heading" style="padding:15px">Create Widget</div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group {{ ($errors->has('type'))? 'has-error' : '' }}">
                                            {{ Form::label('type', ' Widget type ', array('class' => 'type')) }}
                                            {{ Form::select('type',  getWidgetType(),
                                         (!empty($fdata->type) ? $fdata->type : NULL),
                                        ['class' => 'form-control', 'placeholder' => '--Select--']) }}
                                            @if($errors->has('type'))
                                            <span class="help-block">{{ $errors->first('type') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group {{ ($errors->has('titel'))? 'has-error' : '' }}">
                                            {{ Form::label('titel', 'Titel', array('class' => 'titel')) }}
                                            {{ Form::text('titel', (!empty($fdata->titel) ? $fdata->titel : NULL), ['class' => 'form-control', 'placeholder' => ' Titel...']) }}
                                            @if($errors->has('titel'))
                                            <span class="help-block">{{ $errors->first('titel') }}</span>
                                            @endif
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group {{ ($errors->has('sort_by'))? 'has-error' : '' }}">
                                            {{ Form::label('sort_by', 'Sort', array('class' => 'sort_by')) }}
                                            {{ Form::number('sort_by', (!empty($fdata->sort_by) ? $fdata->sort_by : NULL), ['class' => 'form-control', 'placeholder' => 'Sort...']) }}
                                            @if($errors->has('sort_by'))
                                            <span class="help-block">{{ $errors->first('sort_by') }}</span>
                                            @endif
                                        </div>

                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group {{ ($errors->has('group_id'))? 'has-error' : '' }}">
                                            {{ Form::label('group_id', ' Group Name ', array('class' => 'group_id')) }}
                                            {{ Form::select('group_id',  getWidgetGroup_array(),
                                         (!empty($fdata->group_id) ? $fdata->group_id : NULL),
                                        ['class' => 'form-control', 'placeholder' => '--Select--']) }}
                                            @if($errors->has('group_id'))
                                            <span class="help-block">{{ $errors->first('group_id') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group {{ ($errors->has('title_visible'))? 'has-error' : '' }}">
                                            {{ Form::label('title_visible', ' Is title visible ', array('class' => 'title_visible')) }}
                                            {{ Form::select('title_visible',  ['Yes' => 'Visible', 'No' => 'Invisible'],
                                         (!empty($fdata->title_visible) ? $fdata->title_visible : NULL),
                                        ['class' => 'form-control']) }}
                                            @if($errors->has('title_visible'))
                                            <span class="help-block">{{ $errors->first('title_visible') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                </div>



                            </div>
                        </div>

                        @if(!empty($fdata->id))
                        @if(View::exists('widget::part.'.$fdata->type))
                        @include('widget::part.'.$fdata->type, ['fdata' => $fdata])
                        @endif
                        @endif

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