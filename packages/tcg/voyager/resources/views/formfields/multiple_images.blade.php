<br>
@if(isset($dataTypeContent->{$row->field}))
<?php $images = json_decode($dataTypeContent->{$row->field}); ?>
@if($images != null)
@foreach($images as $image)
<div class="img_settings_container" data-field-name="{{ $row->field }}" style="float:left;padding-right:15px;">

    <a href="{{ route('admin.posts.delete_value', [$dataTypeContent->id,$row->field]) }}" class="voyager-x "
        style="position: absolute;background: #000000b8;color: #fff;padding: 4px;"
        onclick="return confirm('Are you sure?')"></a>
    <img src="{{ Voyager::image( $image ) }}" data-file-name="{{ $image }}" data-id="{{ $dataTypeContent->getKey() }}"
        style="max-width:200px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:5px;">
</div>
@endforeach
@endif
@endif
<div class="clearfix"></div>
<input @if($row->required == 1 && !isset($dataTypeContent->{$row->field})) required @endif type="file"
name="{{ $row->field }}[]" multiple="multiple" accept="image/*">