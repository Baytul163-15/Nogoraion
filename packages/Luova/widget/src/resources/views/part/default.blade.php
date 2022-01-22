<div class="panel panel-default">
    <div class="panel-heading" style="padding:15px">Type info</div>
    <div class="panel-body">

        <div class="row">
            <div class="col-md-4">
                <div class="form-group {{ ($errors->has('link'))? 'has-error' : '' }}">
                    {{ Form::label('link', 'Link', array('class' => 'link')) }}
                    {{ Form::text('link', (!empty($fdata->link) ? $fdata->link : NULL), ['class' => 'form-control', 'placeholder' => ' Link...']) }}
                    @if($errors->has('link'))
                    <span class="help-block">{{ $errors->first('link') }}</span>
                    @endif
                </div>


                <div class="form-group {{ ($errors->has('class'))? 'has-error' : '' }}">
                    {{ Form::label('class', 'class', array('class' => 'class')) }}
                    {{ Form::text('class', (!empty($fdata->class) ? $fdata->class : NULL), ['class' => 'form-control', 'placeholder' => ' class...']) }}
                    @if($errors->has('class'))
                    <span class="help-block">{{ $errors->first('class') }}</span>
                    @endif
                </div>

                @if(!empty($fdata->photo))
                <div class="clphotodelte">
                    <a href="{{ route('lvwidget.photo.detele', $fdata->id) }}"
                        onclick="return confirm('It will be deleted permanently, Are you sure?')">
                        <span class="voyager-x remove-multi-file"> </span>
                    </a>
                    <img src="{{ asset('storage/'.$fdata->photo) }}" style="height: 55px">
                </div>


                @else

                <div class="form-group {{ ($errors->has('photo'))? 'has-error' : '' }}">

                    {{ Form::label('photo', 'Photo', array('class' => 'photo')) }}
                    {{ Form::file('photo') }}
                    @if($errors->has('photo'))
                    <span class="help-block">{{ $errors->first('photo') }}</span>
                    @endif
                </div>
                @endif

            </div>
            <div class="col-md-8">
                <div class="form-group {{ ($errors->has('description'))? 'has-error' : '' }}">
                    {{ Form::label('description', ' Description ', array('class' => 'description')) }}
                    {{ Form::textarea('description', (!empty($fdata->description) ? $fdata->description : NULL), ['class' => 'form-control', 'rows' => 10]) }}
                    @if($errors->has('description'))
                    <span class="help-block">{{ $errors->first('description') }}</span>
                    @endif
                </div>

            </div>






        </div>

    </div>
</div>