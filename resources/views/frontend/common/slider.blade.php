@php



$cat_slide = TCG\Voyager\Models\Category::where('slug', 'slider')->first();

if ($cat_slide) {
$sliders = App\Post::select('posts.*')
->join('category_post', 'category_post.post_id', '=', 'posts.id')
->where('category_post.category_id', $cat_slide->id)
->orderBy('id', 'desc')->get();
} else {
$sliders = collect([]);
}

$sliders_count= $sliders->count();
@endphp
@if($sliders_count > 0)










<ul class="pgwSlideshow">
    @foreach($sliders as $photo)


    <li>
        <img src="{{ url('public/storage/'.$photo->image) }}" alt="" data-large-src="{{ url('public/storage/'.$photo->image) }}" data-description="{{ $photo->title}}">

    </li>
    @endforeach

</ul>

@endif