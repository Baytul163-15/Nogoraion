<ul>
    @foreach($childs as $child)
        <li>
            {{ $child->title }} <div class="btn-group" style="display: -webkit-inline-box;"><a href="{{ url('/edit-menu',$child->id) }}" class="badge badge-info text-white">Edit</a> <form action="{{ url('/delete-menu',$child->id) }}" class="ml-1" method="POST">{{ csrf_field() }}<button type="submit" class="badge badge-danger">Delete</button></form></div>
            @if(count($child->childs))
                @include('menu.manageChild',['childs' => $child->childs])
            @endif
        </li>
    @endforeach
</ul>