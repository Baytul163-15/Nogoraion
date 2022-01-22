<tr id="{{'row-'.$i}}">
    <th scope="row">#</th>
    <td>
        {{ Form::text('listing['.$i.'][title]', null, ['class' => 'form-control','placeholder' => 'Title' ]) }}
    </td>
    <td>
        {{ Form::text('listing['.$i.'][link]', null, ['class' => 'form-control','placeholder' => 'Link' ]) }}
    </td>

    <td>
        {{ Form::select('listing['.$i.'][target]', [
            '_blank' => 'Blank',
            '_self' => 'Self',
        ], null,
            ['class' => 'form-control select2', 'placeholder' => ' Select ']) }}
    </td>


    <td>
        <button class="btn btn-danger btn-sm removeRow" style="margin-top: 7px;" type="button" data-id="{{$i}}">
            <i class="voyager-trash"></i>
        </button>
    </td>

</tr>