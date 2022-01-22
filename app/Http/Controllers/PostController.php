<?php
    
namespace App\Http\Controllers;
    
use App\Post;
use App\CategoryPost;
use App\Categorie;
use Illuminate\Http\Request;
use DB;
    
class postController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:post-list|post-create|post-edit|post-delete', ['only' => ['index','show']]);
         $this->middleware('permission:post-create', ['only' => ['create','store']]);
         $this->middleware('permission:post-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:post-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function getCategoryTitle($id)
    // {
    //         $c = DB::table('categories')->where('id', $id)->first();
    //         return $c->categories->name;
    // }
    public function index()
    {
        
        // $posts = DB::table('categories')
        // ->join('category_post', 'categories.id', '=', 'category_post.category_id')
        // ->join('posts', 'posts.id', '=', 'category_post.post_id')
        // ->orderBy('posts.id', 'desc')
        // ->paginate(5);
        //

        // $posts = DB::table('posts')
        // ->join('category_post', 'posts.id', '=', 'category_post.post_id')
        // ->join('categories', 'categories.id', '=', 'category_post.category_id')
        // ->orderBy('posts.id', 'asc')
        // ->paginate(5);
        
        $posts = post::latest()
        ->orderBy('id', 'DESC')
        ->paginate(5);
        // $posts = DB::select('SELECT * FROM posts left join category_post ON category_post.post_id=posts.id left join categories ON categories.id=category_post.category_id ORDER BY posts.id DESC');
        return view('posts.index', compact('posts'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Categorie::all('name', 'id');
        $selectedCategory = Categorie::first()->id;
        return view('posts.create', compact('category', 'selectedCategory'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $image = $request->file('image');
        if($image != '')
        {
            $request->validate([
                'title'    =>  'required',
                'category_id'     =>  'required',
                'image'         =>  'image|max:2048'
            ]);

            $image_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage'), $image_name);

            $form_data = array(
                'title'            =>   $request->title,
                'author_id'        =>   $request->author_id,
                'category_id'      =>   $request->category_id,
                'slug'             =>   $request->slug,
                'body'             =>   $request->body,
                'featured'         =>   $request->featured,
                'excerpt'          =>   $request->excerpt,
                'seo_title'        =>   $request->seo_title,
                'meta_keywords'    =>   $request->meta_keywords,
                'meta_description' =>   $request->meta_description,
                'status'           =>   $request->status,
                'video_embed'      =>   $request->video_embed,
                'image'            =>   $image_name
            );
        }
        else
        {   
            $request->validate([
                'title'    =>  'required',
                'category_id'     =>  'required'
            ]);

            $form_data = array(
                'title'            =>   $request->title,
                'author_id'        =>   $request->author_id,
                'category_id'      =>   $request->category_id,
                'slug'             =>   $request->slug,
                'body'             =>   $request->body,
                'featured'         =>   $request->featured,
                'excerpt'          =>   $request->excerpt,
                'seo_title'        =>   $request->seo_title,
                'meta_keywords'    =>   $request->meta_keywords,
                'meta_description' =>   $request->meta_description,
                'status'           =>   $request->status,
                'video_embed'      =>   $request->video_embed
            );
        }

        Post::create($form_data);
        
        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(post $post)
    {
        return view('posts.show', compact('post'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(post $post)
    {
        $category = Categorie::all('name', 'id');
        return view('posts.edit', compact('post', 'category'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $image = $request->file('image');
        if($image != '')
        {
            $request->validate([
                'title'    =>  'required',
                'category_id'     =>  'required',
                'image'         =>  'image|max:2048'
            ]);

            $image_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage'), $image_name);
        }
        else
        {   
            $image_name = null;
            $request->validate([
                'title'    =>  'required',
                'category_id'     =>  'required'
            ]);
        }

        $form_data = array(
            'title'       =>   $request->title,
            'author_id'        =>   $request->author_id,
            'category_id'        =>   $request->category_id,
            'slug'        =>   $request->slug,
            'body'        =>   $request->body,
            'featured'        =>   $request->featured,
            'excerpt'        =>   $request->excerpt,
            'seo_title'        =>   $request->seo_title,
            'meta_keywords'        =>   $request->meta_keywords,
            'meta_description'        =>   $request->meta_description,
            'status'        =>   $request->status,
            'video_embed'        =>   $request->video_embed,
            'image'            =>   $image_name
        );
        Post::whereId($id)->update($form_data);
    
        return redirect()->route('posts.index')->with('success', 'Post updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
    
        return redirect()->route('posts.index')
                        ->with('success', 'Post deleted successfully');
    }
}
