<?php
    
namespace App\Http\Controllers;
    
use App\Categorie;
use Illuminate\Http\Request;
use DB;
    
class CategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:category-list|category-create|category-edit|category-delete', ['only' => ['index','show']]);
         $this->middleware('permission:category-create', ['only' => ['create','store']]);
         $this->middleware('permission:category-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:category-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $categories = Categorie::latest()
        ->orderBy('id', 'DESC')
        ->paginate(5);
        return view('categories.index', compact('categories'))
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
        return view('categories.create', compact('category'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'    =>  'required'
        ]);

        if ($request->file('cat_image')) {
            $cat_image = $request->file('cat_image');
            $new_name = rand() . '.' . $cat_image->getClientOriginalExtension();
            $cat_image->move(public_path('storage'), $new_name);
            $form_data = array(
                'name'            =>   $request->name,
                'slug'             =>   $request->slug,
                'cat_image'            =>   $new_name
            );
        }else{
            $form_data = array(
                'name'            =>   $request->name,
                'slug'             =>   $request->slug,
            );
        }
        

        Categorie::create($form_data);
        
        return redirect()->route('categories.index')->with('success', 'category created successfully.');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Categorie $category)
    {
        return view('categories.show', compact('category'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Categorie $category)
    {
        return view('categories.edit', compact('category'));
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
        $image_name = $request->hidden_cat_image;
        $image = $request->file('cat_image');
        if($image != '')
        {
            $request->validate([
                'name'    =>  'required',
                'cat_image'    =>  'required'
            ]);

            $image_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage'), $image_name);
        }
        else
        {
            $request->validate([
                'name'    =>  'required'
            ]);
        }

        $form_data = array(
            'name'       =>   $request->name,
            'slug'        =>   $request->slug,
            'cat_image'        =>   $image_name
        );
        Categorie::whereId($id)->update($form_data);
    
        return redirect()->route('categories.index')->with('success', 'Category updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categorie $category)
    {
        $category->delete();
    
        return redirect()->route('categories.index')->with('success', 'Post deleted successfully');
    }
}