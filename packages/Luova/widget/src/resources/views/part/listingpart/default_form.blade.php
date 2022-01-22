@foreach($rows as $row)
@include('widget::part.row', ['i' => $row])
@endforeach