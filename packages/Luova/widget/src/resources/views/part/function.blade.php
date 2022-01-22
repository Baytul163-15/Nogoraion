<div class="panel panel-default">
    <div class="panel-heading" style="padding:15px">Type info</div>
    <div class="panel-body">

        <div class="row">

            <div class="col-md-8">
                <div class="form-group {{ ($errors->has('description'))? 'has-error' : '' }}">
                    {{ Form::label('description', ' Function Name ', array('class' => 'description')) }}
                    {{ Form::text('description', (!empty($fdata->description) ? $fdata->description : NULL), ['class' => 'form-control', 'rows' => 10]) }}
                    @if($errors->has('description'))
                    <span class="help-block">{{ $errors->first('description') }}</span>
                    @endif
                </div>

            </div>






        </div>

    </div>
</div>