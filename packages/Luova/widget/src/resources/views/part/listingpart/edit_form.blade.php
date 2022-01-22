@foreach($rows as $key => $row)
@php
$i = $key +1;
@endphp

<tr id="{{'row-'.$i}}">
    <th scope="row">#</th>
    <td>
        {{ Form::text('listing['.$i.'][title]', $row['title'], ['class' => 'form-control','placeholder' => 'Title' ]) }}
    </td>
    <td>
        {{ Form::text('listing['.$i.'][link]', $row['link'], ['class' => 'form-control','placeholder' => 'Link' ]) }}
    </td>

    <td>
        {{ Form::select('listing['.$i.'][target]', [
            '_blank' => 'Blank',
            '_self' => 'Self',
        ], $row['target'],
            ['class' => 'form-control select2', 'placeholder' => ' Select ']) }}
    </td>


    <td>
        <button class="btn btn-danger btn-sm removeRow" style="margin-top: 7px;" type="button" data-id="{{$i}}">
            <i class="voyager-trash"></i>
        </button>
    </td>

</tr>
@endforeach