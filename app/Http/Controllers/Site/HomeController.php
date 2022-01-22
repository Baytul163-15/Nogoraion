<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Page;
use App\Post;
use App\Menulist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use TCG\Voyager\Models\Category;
use App\Mail\SendMail;
use Harimayco\Menu\Models\Menus;
use Harimayco\Menu\Models\MenuItems;
use Menu;

class HomeController extends Controller
{
    public function index()
    {
        $menus = Menulist::where('parent_id', '=', 0)->get();
        $public_menu = Menu::getByName('Main'); //return array

        return view('frontend.home', compact('public_menu'));
    }




    public function post(Request $request, $slug)
    {

        $post = Post::where('slug', $slug)->first();
        return view('frontend.pages.post')->with('mdata', $post);
    }

    public function page(Request $request, $slug)
    {

        $post = Page::where('slug', $slug)->first();
        return view('frontend.pages.page')->with('mdata', $post);
    }

    public function post_cat(Request $request, $slug)
    {
        $cat = Category::where('slug', $slug)->first();



        if ($cat) {
            $posts = Post::select('posts.*')
                ->join('category_post', 'category_post.post_id', '=', 'posts.id')
                ->where('category_post.category_id', $cat->id)
                ->orderBy('id', 'desc')->get();
        } else {
            $posts = collect([]);
        }


        $post_count = $posts->count();

        $post = Post::where('slug', $slug)->first();
        return view('frontend.pages.post_cat')->with(['mdata' => $posts, 'count' => $post_count]);
    }

    public function post_author(Request $request, $author_id)
    {
        // $cat = Category::where('slug', $slug)->first();
        $post = Post::where('author_id', $author_id)->first();

        if ($post) {
            $posts = Post::where('author_id', $author_id)
                ->orderBy('id', 'desc')->get();
        } else {
            $posts = collect([]);
        }

        $post_count = $posts->count();

        return view('frontend.pages.post_author')->with(['mdata' => $posts, 'count' => $post_count]);
    }
    public function notice(Request $request, $slug)
    {
        $cat = Category::where('slug', $slug)->first();



        if ($cat) {
            $posts = Post::select('posts.*')
                ->join('category_post', 'category_post.post_id', '=', 'posts.id')
                ->where('category_post.category_id', $cat->id)
                ->orderBy('id', 'desc')->paginate(20);
        } else {
            $posts = collect([]);
        }


        $post_count = $posts->count();

        $post = Post::where('slug', $slug)->first();
        return view('frontend.pages.notice')->with(['mdata' => $posts, 'count' => $post_count]);
    }
    public function former_chief(Request $request)
    {


        $slug = 'former-chief';
        $cat = Category::where('slug', $slug)->first();
        echo $cat;


        if ($cat) {
            $posts = Post::select('posts.*')
                ->join('category_post', 'category_post.post_id', '=', 'posts.id')
                ->where('category_post.category_id', $cat->id)
                ->orderBy('id', 'desc')->paginate(12);

        } else {
            $posts = collect([]);
        }


        $post_count = $posts->count();

        $post = Post::where('slug', $slug)->first();
        return view('frontend.pages.former_chief')->with(['mdata' => $posts, 'count' => $post_count, 'cat' => $cat, 'slug' => $slug]);
    }
    public function naogaon_sadar_circle(Request $request)
    {
        $slug = 'naogaon-sadar-circle';
        $cat = Category::where('slug', $slug)->first();

        if ($cat) {
            // $posts = Post::select('posts')
            //     ->join('category_post', 'category_post.post_id', '=', 'posts.id')
            //     ->where('category_post.category_id', $cat->id)
            //     ->orderBy('posts.id', 'desc')->paginate(12);

            $posts = Post::select('posts.*')
                ->where('category_id', $cat->id)
                ->where('featured', 0)
                ->orderBy('id', 'desc')->paginate(12);
            $featured_posts = Post::select('posts.*')
                ->where('category_id', $cat->id)
                ->where('featured', 1)
                ->orderBy('id', 'desc')->paginate(1);

        } else {
            $posts = collect([]);
            $featured_posts = collect([]);
        }
        $post_count = $posts->count();
        $featured_post_count = $featured_posts->count();

        $post = Post::where('slug', $slug)->first();
        // echo "<pre>";
        // print_r($post);
        return view('frontend.pages.naogaon_sadar_circle')->with(['fmdata' => $featured_posts,'mdata' => $posts, 'count' => $post_count,'featured_count' => $featured_post_count, 'cat' => $cat, 'slug' => $slug]);
    }
    public function mohadebpur_circle(Request $request)
    {
        $slug = 'mohadebpur-circle';
        $cat = Category::where('slug', $slug)->first();

        if ($cat) {
            // $posts = Post::select('posts')
            //     ->join('category_post', 'category_post.post_id', '=', 'posts.id')
            //     ->where('category_post.category_id', $cat->id)
            //     ->orderBy('posts.id', 'desc')->paginate(12);

            $posts = Post::select('posts.*')
                ->where('category_id', $cat->id)
                ->where('featured', 0)
                ->orderBy('id', 'desc')->paginate(12);
            $featured_posts = Post::select('posts.*')
                ->where('category_id', $cat->id)
                ->where('featured', 1)
                ->orderBy('id', 'desc')->paginate(12);

        } else {
            $posts = collect([]);
            $featured_posts = collect([]);
        }
        $post_count = $posts->count();
        $featured_post_count = $featured_posts->count();

        $post = Post::where('slug', $slug)->first();
        // echo "<pre>";
        // print_r($post);
        return view('frontend.pages.naogaon_sadar_circle')->with(['fmdata' => $featured_posts,'mdata' => $posts, 'count' => $post_count,'featured_count' => $featured_post_count, 'cat' => $cat, 'slug' => $slug]);
    }
    public function potnitola_circle(Request $request)
    {
        $slug = 'potnitola-circle';
        $cat = Category::where('slug', $slug)->first();

        if ($cat) {
            // $posts = Post::select('posts')
            //     ->join('category_post', 'category_post.post_id', '=', 'posts.id')
            //     ->where('category_post.category_id', $cat->id)
            //     ->orderBy('posts.id', 'desc')->paginate(12);

            $posts = Post::select('posts.*')
                ->where('category_id', $cat->id)
                ->where('featured', 0)
                ->orderBy('id', 'desc')->paginate(12);
            $featured_posts = Post::select('posts.*')
                ->where('category_id', $cat->id)
                ->where('featured', 1)
                ->orderBy('id', 'desc')->paginate(12);

        } else {
            $posts = collect([]);
            $featured_posts = collect([]);
        }
        $post_count = $posts->count();
        $featured_post_count = $featured_posts->count();

        $post = Post::where('slug', $slug)->first();
        // echo "<pre>";
        // print_r($post);
        return view('frontend.pages.potnitola_circle')->with(['fmdata' => $featured_posts,'mdata' => $posts, 'count' => $post_count,'featured_count' => $featured_post_count, 'cat' => $cat, 'slug' => $slug]);
    }
    public function sapahar_circle(Request $request)
    {
        $slug = 'sapahar-circle';
        $cat = Category::where('slug', $slug)->first();

        if ($cat) {
            // $posts = Post::select('posts')
            //     ->join('category_post', 'category_post.post_id', '=', 'posts.id')
            //     ->where('category_post.category_id', $cat->id)
            //     ->orderBy('posts.id', 'desc')->paginate(12);

            $posts = Post::select('posts.*')
                ->where('category_id', $cat->id)
                ->where('featured', 0)
                ->orderBy('id', 'desc')->paginate(12);
            $featured_posts = Post::select('posts.*')
                ->where('category_id', $cat->id)
                ->where('featured', 1)
                ->orderBy('id', 'desc')->paginate(12);

        } else {
            $posts = collect([]);
            $featured_posts = collect([]);
        }
        $post_count = $posts->count();
        $featured_post_count = $featured_posts->count();

        $post = Post::where('slug', $slug)->first();
        // echo "<pre>";
        // print_r($post);
        return view('frontend.pages.potnitola_circle')->with(['fmdata' => $featured_posts,'mdata' => $posts, 'count' => $post_count,'featured_count' => $featured_post_count, 'cat' => $cat, 'slug' => $slug]);
    }
    public function manda_circle(Request $request)
    {
        $slug = 'manda-circle';
        $cat = Category::where('slug', $slug)->first();

        if ($cat) {
            // $posts = Post::select('posts')
            //     ->join('category_post', 'category_post.post_id', '=', 'posts.id')
            //     ->where('category_post.category_id', $cat->id)
            //     ->orderBy('posts.id', 'desc')->paginate(12);

            $posts = Post::select('posts.*')
                ->where('category_id', $cat->id)
                ->where('featured', 0)
                ->orderBy('id', 'desc')->paginate(12);
            $featured_posts = Post::select('posts.*')
                ->where('category_id', $cat->id)
                ->where('featured', 1)
                ->orderBy('id', 'desc')->paginate(12);

        } else {
            $posts = collect([]);
            $featured_posts = collect([]);
        }
        $post_count = $posts->count();
        $featured_post_count = $featured_posts->count();

        $post = Post::where('slug', $slug)->first();
        // echo "<pre>";
        // print_r($post);
        return view('frontend.pages.potnitola_circle')->with(['fmdata' => $featured_posts,'mdata' => $posts, 'count' => $post_count,'featured_count' => $featured_post_count, 'cat' => $cat, 'slug' => $slug]);
    }
    public function naogaon_sadar_thana(Request $request)
    {
        $slug = 'naogaon-sadar-thana';
        $cat = Category::where('slug', $slug)->first();

        if ($cat) {
            // $posts = Post::select('posts')
            //     ->join('category_post', 'category_post.post_id', '=', 'posts.id')
            //     ->where('category_post.category_id', $cat->id)
            //     ->orderBy('posts.id', 'desc')->paginate(12);

            $posts = Post::select('posts.*')
                ->where('category_id', $cat->id)
                ->where('featured', 0)
                ->orderBy('id', 'desc')->paginate(12);
            $featured_posts = Post::select('posts.*')
                ->where('category_id', $cat->id)
                ->where('featured', 1)
                ->orderBy('id', 'desc')->paginate(12);

        } else {
            $posts = collect([]);
            $featured_posts = collect([]);
        }
        $post_count = $posts->count();
        $featured_post_count = $featured_posts->count();

        $post = Post::where('slug', $slug)->first();
        // echo "<pre>";
        // print_r($post);
        return view('frontend.pages.potnitola_circle')->with(['fmdata' => $featured_posts,'mdata' => $posts, 'count' => $post_count,'featured_count' => $featured_post_count, 'cat' => $cat, 'slug' => $slug]);
    }
    public function atrai_thana(Request $request)
    {
        $slug = 'atrai-thana';
        $cat = Category::where('slug', $slug)->first();

        if ($cat) {
            // $posts = Post::select('posts')
            //     ->join('category_post', 'category_post.post_id', '=', 'posts.id')
            //     ->where('category_post.category_id', $cat->id)
            //     ->orderBy('posts.id', 'desc')->paginate(12);

            $posts = Post::select('posts.*')
                ->where('category_id', $cat->id)
                ->where('featured', 0)
                ->orderBy('id', 'desc')->paginate(12);
            $featured_posts = Post::select('posts.*')
                ->where('category_id', $cat->id)
                ->where('featured', 1)
                ->orderBy('id', 'desc')->paginate(12);

        } else {
            $posts = collect([]);
            $featured_posts = collect([]);
        }
        $post_count = $posts->count();
        $featured_post_count = $featured_posts->count();

        $post = Post::where('slug', $slug)->first();
        // echo "<pre>";
        // print_r($post);
        return view('frontend.pages.potnitola_circle')->with(['fmdata' => $featured_posts,'mdata' => $posts, 'count' => $post_count,'featured_count' => $featured_post_count, 'cat' => $cat, 'slug' => $slug]);
    }
    public function dhamirhat_thana(Request $request)
    {
        $slug = 'dhamirhat-thana';
        $cat = Category::where('slug', $slug)->first();

        if ($cat) {
            // $posts = Post::select('posts')
            //     ->join('category_post', 'category_post.post_id', '=', 'posts.id')
            //     ->where('category_post.category_id', $cat->id)
            //     ->orderBy('posts.id', 'desc')->paginate(12);

            $posts = Post::select('posts.*')
                ->where('category_id', $cat->id)
                ->where('featured', 0)
                ->orderBy('id', 'desc')->paginate(12);
            $featured_posts = Post::select('posts.*')
                ->where('category_id', $cat->id)
                ->where('featured', 1)
                ->orderBy('id', 'desc')->paginate(12);

        } else {
            $posts = collect([]);
            $featured_posts = collect([]);
        }
        $post_count = $posts->count();
        $featured_post_count = $featured_posts->count();

        $post = Post::where('slug', $slug)->first();
        // echo "<pre>";
        // print_r($post);
        return view('frontend.pages.potnitola_circle')->with(['fmdata' => $featured_posts,'mdata' => $posts, 'count' => $post_count,'featured_count' => $featured_post_count, 'cat' => $cat, 'slug' => $slug]);
    }
    public function manda_thana(Request $request)
    {
        $slug = 'manda-thana';
        $cat = Category::where('slug', $slug)->first();

        if ($cat) {
            // $posts = Post::select('posts')
            //     ->join('category_post', 'category_post.post_id', '=', 'posts.id')
            //     ->where('category_post.category_id', $cat->id)
            //     ->orderBy('posts.id', 'desc')->paginate(12);

            $posts = Post::select('posts.*')
                ->where('category_id', $cat->id)
                ->where('featured', 0)
                ->orderBy('id', 'desc')->paginate(12);
            $featured_posts = Post::select('posts.*')
                ->where('category_id', $cat->id)
                ->where('featured', 1)
                ->orderBy('id', 'desc')->paginate(12);

        } else {
            $posts = collect([]);
            $featured_posts = collect([]);
        }
        $post_count = $posts->count();
        $featured_post_count = $featured_posts->count();

        $post = Post::where('slug', $slug)->first();
        // echo "<pre>";
        // print_r($post);
        return view('frontend.pages.potnitola_circle')->with(['fmdata' => $featured_posts,'mdata' => $posts, 'count' => $post_count,'featured_count' => $featured_post_count, 'cat' => $cat, 'slug' => $slug]);
    }
    public function mohadebpur_thana(Request $request)
    {
        $slug = 'mohadebpur-thana';
        $cat = Category::where('slug', $slug)->first();

        if ($cat) {
            // $posts = Post::select('posts')
            //     ->join('category_post', 'category_post.post_id', '=', 'posts.id')
            //     ->where('category_post.category_id', $cat->id)
            //     ->orderBy('posts.id', 'desc')->paginate(12);

            $posts = Post::select('posts.*')
                ->where('category_id', $cat->id)
                ->where('featured', 0)
                ->orderBy('id', 'desc')->paginate(12);
            $featured_posts = Post::select('posts.*')
                ->where('category_id', $cat->id)
                ->where('featured', 1)
                ->orderBy('id', 'desc')->paginate(12);

        } else {
            $posts = collect([]);
            $featured_posts = collect([]);
        }
        $post_count = $posts->count();
        $featured_post_count = $featured_posts->count();

        $post = Post::where('slug', $slug)->first();
        // echo "<pre>";
        // print_r($post);
        return view('frontend.pages.potnitola_circle')->with(['fmdata' => $featured_posts,'mdata' => $posts, 'count' => $post_count,'featured_count' => $featured_post_count, 'cat' => $cat, 'slug' => $slug]);
    }
    public function niamotpur_thana(Request $request)
    {
        $slug = 'niamotpur-thana';
        $cat = Category::where('slug', $slug)->first();

        if ($cat) {
            // $posts = Post::select('posts')
            //     ->join('category_post', 'category_post.post_id', '=', 'posts.id')
            //     ->where('category_post.category_id', $cat->id)
            //     ->orderBy('posts.id', 'desc')->paginate(12);

            $posts = Post::select('posts.*')
                ->where('category_id', $cat->id)
                ->where('featured', 0)
                ->orderBy('id', 'desc')->paginate(12);
            $featured_posts = Post::select('posts.*')
                ->where('category_id', $cat->id)
                ->where('featured', 1)
                ->orderBy('id', 'desc')->paginate(12);

        } else {
            $posts = collect([]);
            $featured_posts = collect([]);
        }
        $post_count = $posts->count();
        $featured_post_count = $featured_posts->count();

        $post = Post::where('slug', $slug)->first();
        // echo "<pre>";
        // print_r($post);
        return view('frontend.pages.potnitola_circle')->with(['fmdata' => $featured_posts,'mdata' => $posts, 'count' => $post_count,'featured_count' => $featured_post_count, 'cat' => $cat, 'slug' => $slug]);
    }
    public function potnitola_thana(Request $request)
    {
        $slug = 'potnitola-thana';
        $cat = Category::where('slug', $slug)->first();

        if ($cat) {
            // $posts = Post::select('posts')
            //     ->join('category_post', 'category_post.post_id', '=', 'posts.id')
            //     ->where('category_post.category_id', $cat->id)
            //     ->orderBy('posts.id', 'desc')->paginate(12);

            $posts = Post::select('posts.*')
                ->where('category_id', $cat->id)
                ->where('featured', 0)
                ->orderBy('id', 'desc')->paginate(12);
            $featured_posts = Post::select('posts.*')
                ->where('category_id', $cat->id)
                ->where('featured', 1)
                ->orderBy('id', 'desc')->paginate(12);

        } else {
            $posts = collect([]);
            $featured_posts = collect([]);
        }
        $post_count = $posts->count();
        $featured_post_count = $featured_posts->count();

        $post = Post::where('slug', $slug)->first();
        // echo "<pre>";
        // print_r($post);
        return view('frontend.pages.potnitola_circle')->with(['fmdata' => $featured_posts,'mdata' => $posts, 'count' => $post_count,'featured_count' => $featured_post_count, 'cat' => $cat, 'slug' => $slug]);
    }
    public function porsha_thana(Request $request)
    {
        $slug = 'porsha-thana';
        $cat = Category::where('slug', $slug)->first();

        if ($cat) {
            // $posts = Post::select('posts')
            //     ->join('category_post', 'category_post.post_id', '=', 'posts.id')
            //     ->where('category_post.category_id', $cat->id)
            //     ->orderBy('posts.id', 'desc')->paginate(12);

            $posts = Post::select('posts.*')
                ->where('category_id', $cat->id)
                ->where('featured', 0)
                ->orderBy('id', 'desc')->paginate(12);
            $featured_posts = Post::select('posts.*')
                ->where('category_id', $cat->id)
                ->where('featured', 1)
                ->orderBy('id', 'desc')->paginate(12);

        } else {
            $posts = collect([]);
            $featured_posts = collect([]);
        }
        $post_count = $posts->count();
        $featured_post_count = $featured_posts->count();

        $post = Post::where('slug', $slug)->first();
        // echo "<pre>";
        // print_r($post);
        return view('frontend.pages.potnitola_circle')->with(['fmdata' => $featured_posts,'mdata' => $posts, 'count' => $post_count,'featured_count' => $featured_post_count, 'cat' => $cat, 'slug' => $slug]);
    }
    public function raninagar_thana(Request $request)
    {
        $slug = 'raninagar-thana';
        $cat = Category::where('slug', $slug)->first();

        if ($cat) {
            // $posts = Post::select('posts')
            //     ->join('category_post', 'category_post.post_id', '=', 'posts.id')
            //     ->where('category_post.category_id', $cat->id)
            //     ->orderBy('posts.id', 'desc')->paginate(12);

            $posts = Post::select('posts.*')
                ->where('category_id', $cat->id)
                ->where('featured', 0)
                ->orderBy('id', 'desc')->paginate(12);
            $featured_posts = Post::select('posts.*')
                ->where('category_id', $cat->id)
                ->where('featured', 1)
                ->orderBy('id', 'desc')->paginate(12);

        } else {
            $posts = collect([]);
            $featured_posts = collect([]);
        }
        $post_count = $posts->count();
        $featured_post_count = $featured_posts->count();

        $post = Post::where('slug', $slug)->first();
        // echo "<pre>";
        // print_r($post);
        return view('frontend.pages.potnitola_circle')->with(['fmdata' => $featured_posts,'mdata' => $posts, 'count' => $post_count,'featured_count' => $featured_post_count, 'cat' => $cat, 'slug' => $slug]);
    }
    public function sapahar_thana(Request $request)
    {
        $slug = 'sapahar-thana';
        $cat = Category::where('slug', $slug)->first();

        if ($cat) {
            // $posts = Post::select('posts')
            //     ->join('category_post', 'category_post.post_id', '=', 'posts.id')
            //     ->where('category_post.category_id', $cat->id)
            //     ->orderBy('posts.id', 'desc')->paginate(12);

            $posts = Post::select('posts.*')
                ->where('category_id', $cat->id)
                ->where('featured', 0)
                ->orderBy('id', 'desc')->paginate(12);
            $featured_posts = Post::select('posts.*')
                ->where('category_id', $cat->id)
                ->where('featured', 1)
                ->orderBy('id', 'desc')->paginate(12);

        } else {
            $posts = collect([]);
            $featured_posts = collect([]);
        }
        $post_count = $posts->count();
        $featured_post_count = $featured_posts->count();

        $post = Post::where('slug', $slug)->first();
        // echo "<pre>";
        // print_r($post);
        return view('frontend.pages.potnitola_circle')->with(['fmdata' => $featured_posts,'mdata' => $posts, 'count' => $post_count,'featured_count' => $featured_post_count, 'cat' => $cat, 'slug' => $slug]);
    }
    public function bodolgachi_thana(Request $request)
    {
        $slug = 'bodolgachi-thana';
        $cat = Category::where('slug', $slug)->first();

        if ($cat) {
            // $posts = Post::select('posts')
            //     ->join('category_post', 'category_post.post_id', '=', 'posts.id')
            //     ->where('category_post.category_id', $cat->id)
            //     ->orderBy('posts.id', 'desc')->paginate(12);

            $posts = Post::select('posts.*')
                ->where('category_id', $cat->id)
                ->where('featured', 0)
                ->orderBy('id', 'desc')->paginate(12);
            $featured_posts = Post::select('posts.*')
                ->where('category_id', $cat->id)
                ->where('featured', 1)
                ->orderBy('id', 'desc')->paginate(12);

        } else {
            $posts = collect([]);
            $featured_posts = collect([]);
        }
        $post_count = $posts->count();
        $featured_post_count = $featured_posts->count();

        $post = Post::where('slug', $slug)->first();
        // echo "<pre>";
        // print_r($post);
        return view('frontend.pages.potnitola_circle')->with(['fmdata' => $featured_posts,'mdata' => $posts, 'count' => $post_count,'featured_count' => $featured_post_count, 'cat' => $cat, 'slug' => $slug]);
    }
    public function dsb(Request $request)
    {
        $slug = 'dsb';
        $cat = Category::where('slug', $slug)->first();

        if ($cat) {
            // $posts = Post::select('posts')
            //     ->join('category_post', 'category_post.post_id', '=', 'posts.id')
            //     ->where('category_post.category_id', $cat->id)
            //     ->orderBy('posts.id', 'desc')->paginate(12);

            $posts = Post::select('posts.*')
                ->where('category_id', $cat->id)
                ->where('featured', 0)
                ->orderBy('id', 'desc')->paginate(12);
            $featured_posts = Post::select('posts.*')
                ->where('category_id', $cat->id)
                ->where('featured', 1)
                ->orderBy('id', 'desc')->paginate(12);

        } else {
            $posts = collect([]);
            $featured_posts = collect([]);
        }
        $post_count = $posts->count();
        $featured_post_count = $featured_posts->count();

        $post = Post::where('slug', $slug)->first();
        // echo "<pre>";
        // print_r($post);
        return view('frontend.pages.potnitola_circle')->with(['fmdata' => $featured_posts,'mdata' => $posts, 'count' => $post_count,'featured_count' => $featured_post_count, 'cat' => $cat, 'slug' => $slug]);
    }
    public function db_thana(Request $request)
    {
        $slug = 'db-thana';
        $cat = Category::where('slug', $slug)->first();

        if ($cat) {
            // $posts = Post::select('posts')
            //     ->join('category_post', 'category_post.post_id', '=', 'posts.id')
            //     ->where('category_post.category_id', $cat->id)
            //     ->orderBy('posts.id', 'desc')->paginate(12);

            $posts = Post::select('posts.*')
                ->where('category_id', $cat->id)
                ->where('featured', 0)
                ->orderBy('id', 'desc')->paginate(12);
            $featured_posts = Post::select('posts.*')
                ->where('category_id', $cat->id)
                ->where('featured', 1)
                ->orderBy('id', 'desc')->paginate(12);

        } else {
            $posts = collect([]);
            $featured_posts = collect([]);
        }
        $post_count = $posts->count();
        $featured_post_count = $featured_posts->count();

        $post = Post::where('slug', $slug)->first();
        // echo "<pre>";
        // print_r($post);
        return view('frontend.pages.potnitola_circle')->with(['fmdata' => $featured_posts,'mdata' => $posts, 'count' => $post_count,'featured_count' => $featured_post_count, 'cat' => $cat, 'slug' => $slug]);
    }
    public function sadar_court(Request $request)
    {
        $slug = 'sadar-court';
        $cat = Category::where('slug', $slug)->first();

        if ($cat) {
            // $posts = Post::select('posts')
            //     ->join('category_post', 'category_post.post_id', '=', 'posts.id')
            //     ->where('category_post.category_id', $cat->id)
            //     ->orderBy('posts.id', 'desc')->paginate(12);

            $posts = Post::select('posts.*')
                ->where('category_id', $cat->id)
                ->where('featured', 0)
                ->orderBy('id', 'desc')->paginate(12);
            $featured_posts = Post::select('posts.*')
                ->where('category_id', $cat->id)
                ->where('featured', 1)
                ->orderBy('id', 'desc')->paginate(12);

        } else {
            $posts = collect([]);
            $featured_posts = collect([]);
        }
        $post_count = $posts->count();
        $featured_post_count = $featured_posts->count();

        $post = Post::where('slug', $slug)->first();
        // echo "<pre>";
        // print_r($post);
        return view('frontend.pages.potnitola_circle')->with(['fmdata' => $featured_posts,'mdata' => $posts, 'count' => $post_count,'featured_count' => $featured_post_count, 'cat' => $cat, 'slug' => $slug]);
    }
    public function police_lines(Request $request)
    {
        $slug = 'police-lines';
        $cat = Category::where('slug', $slug)->first();

        if ($cat) {
            // $posts = Post::select('posts')
            //     ->join('category_post', 'category_post.post_id', '=', 'posts.id')
            //     ->where('category_post.category_id', $cat->id)
            //     ->orderBy('posts.id', 'desc')->paginate(12);

            $posts = Post::select('posts.*')
                ->where('category_id', $cat->id)
                ->where('featured', 0)
                ->orderBy('id', 'desc')->paginate(12);
            $featured_posts = Post::select('posts.*')
                ->where('category_id', $cat->id)
                ->where('featured', 1)
                ->orderBy('id', 'desc')->paginate(12);

        } else {
            $posts = collect([]);
            $featured_posts = collect([]);
        }
        $post_count = $posts->count();
        $featured_post_count = $featured_posts->count();

        $post = Post::where('slug', $slug)->first();
        // echo "<pre>";
        // print_r($post);
        return view('frontend.pages.potnitola_circle')->with(['fmdata' => $featured_posts,'mdata' => $posts, 'count' => $post_count,'featured_count' => $featured_post_count, 'cat' => $cat, 'slug' => $slug]);
    }
    public function traffic_division(Request $request)
    {
        $slug = 'traffic-division';
        $cat = Category::where('slug', $slug)->first();

        if ($cat) {
            // $posts = Post::select('posts')
            //     ->join('category_post', 'category_post.post_id', '=', 'posts.id')
            //     ->where('category_post.category_id', $cat->id)
            //     ->orderBy('posts.id', 'desc')->paginate(12);

            $posts = Post::select('posts.*')
                ->where('category_id', $cat->id)
                ->where('featured', 0)
                ->orderBy('id', 'desc')->paginate(12);
            $featured_posts = Post::select('posts.*')
                ->where('category_id', $cat->id)
                ->where('featured', 1)
                ->orderBy('id', 'desc')->paginate(12);

        } else {
            $posts = collect([]);
            $featured_posts = collect([]);
        }
        $post_count = $posts->count();
        $featured_post_count = $featured_posts->count();

        $post = Post::where('slug', $slug)->first();
        // echo "<pre>";
        // print_r($post);
        return view('frontend.pages.potnitola_circle')->with(['fmdata' => $featured_posts,'mdata' => $posts, 'count' => $post_count,'featured_count' => $featured_post_count, 'cat' => $cat, 'slug' => $slug]);
    }
    public function investigation_center(Request $request)
    {
        $slug = 'investigation-center';
        $cat = Category::where('slug', $slug)->first();

        if ($cat) {
            // $posts = Post::select('posts')
            //     ->join('category_post', 'category_post.post_id', '=', 'posts.id')
            //     ->where('category_post.category_id', $cat->id)
            //     ->orderBy('posts.id', 'desc')->paginate(12);

            $posts = Post::select('posts.*')
                ->where('category_id', $cat->id)
                ->where('featured', 0)
                ->orderBy('id', 'desc')->paginate(12);
            $featured_posts = Post::select('posts.*')
                ->where('category_id', $cat->id)
                ->where('featured', 1)
                ->orderBy('id', 'desc')->paginate(12);

        } else {
            $posts = collect([]);
            $featured_posts = collect([]);
        }
        $post_count = $posts->count();
        $featured_post_count = $featured_posts->count();

        $post = Post::where('slug', $slug)->first();
        // echo "<pre>";
        // print_r($post);
        return view('frontend.pages.potnitola_circle')->with(['fmdata' => $featured_posts,'mdata' => $posts, 'count' => $post_count,'featured_count' => $featured_post_count, 'cat' => $cat, 'slug' => $slug]);
    }
    public function outpost(Request $request)
    {
        $slug = 'outpost';
        $cat = Category::where('slug', $slug)->first();

        if ($cat) {
            // $posts = Post::select('posts')
            //     ->join('category_post', 'category_post.post_id', '=', 'posts.id')
            //     ->where('category_post.category_id', $cat->id)
            //     ->orderBy('posts.id', 'desc')->paginate(12);

            $posts = Post::select('posts.*')
                ->where('category_id', $cat->id)
                ->where('featured', 0)
                ->orderBy('id', 'desc')->paginate(12);
            $featured_posts = Post::select('posts.*')
                ->where('category_id', $cat->id)
                ->where('featured', 1)
                ->orderBy('id', 'desc')->paginate(12);

        } else {
            $posts = collect([]);
            $featured_posts = collect([]);
        }
        $post_count = $posts->count();
        $featured_post_count = $featured_posts->count();

        $post = Post::where('slug', $slug)->first();
        // echo "<pre>";
        // print_r($post);
        return view('frontend.pages.potnitola_circle')->with(['fmdata' => $featured_posts,'mdata' => $posts, 'count' => $post_count,'featured_count' => $featured_post_count, 'cat' => $cat, 'slug' => $slug]);
    }
    public function camp(Request $request)
    {
        $slug = 'camp';
        $cat = Category::where('slug', $slug)->first();

        if ($cat) {
            // $posts = Post::select('posts')
            //     ->join('category_post', 'category_post.post_id', '=', 'posts.id')
            //     ->where('category_post.category_id', $cat->id)
            //     ->orderBy('posts.id', 'desc')->paginate(12);

            $posts = Post::select('posts.*')
                ->where('category_id', $cat->id)
                ->where('featured', 0)
                ->orderBy('id', 'desc')->paginate(12);
            $featured_posts = Post::select('posts.*')
                ->where('category_id', $cat->id)
                ->where('featured', 1)
                ->orderBy('id', 'desc')->paginate(12);

        } else {
            $posts = collect([]);
            $featured_posts = collect([]);
        }
        $post_count = $posts->count();
        $featured_post_count = $featured_posts->count();

        $post = Post::where('slug', $slug)->first();
        // echo "<pre>";
        // print_r($post);
        return view('frontend.pages.potnitola_circle')->with(['fmdata' => $featured_posts,'mdata' => $posts, 'count' => $post_count,'featured_count' => $featured_post_count, 'cat' => $cat, 'slug' => $slug]);
    }
    public function crime_brance(Request $request)
    {
        $slug = 'crime-brance';
        $cat = Category::where('slug', $slug)->first();

        if ($cat) {
            // $posts = Post::select('posts')
            //     ->join('category_post', 'category_post.post_id', '=', 'posts.id')
            //     ->where('category_post.category_id', $cat->id)
            //     ->orderBy('posts.id', 'desc')->paginate(12);

            $posts = Post::select('posts.*')
                ->where('category_id', $cat->id)
                ->where('featured', 0)
                ->orderBy('id', 'desc')->paginate(12);
            $featured_posts = Post::select('posts.*')
                ->where('category_id', $cat->id)
                ->where('featured', 1)
                ->orderBy('id', 'desc')->paginate(12);

        } else {
            $posts = collect([]);
            $featured_posts = collect([]);
        }
        $post_count = $posts->count();
        $featured_post_count = $featured_posts->count();

        $post = Post::where('slug', $slug)->first();
        // echo "<pre>";
        // print_r($post);
        return view('frontend.pages.potnitola_circle')->with(['fmdata' => $featured_posts,'mdata' => $posts, 'count' => $post_count,'featured_count' => $featured_post_count, 'cat' => $cat, 'slug' => $slug]);
    }
    public function prosecution(Request $request)
    {
        $slug = 'prosecution';
        $cat = Category::where('slug', $slug)->first();

        if ($cat) {
            // $posts = Post::select('posts')
            //     ->join('category_post', 'category_post.post_id', '=', 'posts.id')
            //     ->where('category_post.category_id', $cat->id)
            //     ->orderBy('posts.id', 'desc')->paginate(12);

            $posts = Post::select('posts.*')
                ->where('category_id', $cat->id)
                ->where('featured', 0)
                ->orderBy('id', 'desc')->paginate(12);
            $featured_posts = Post::select('posts.*')
                ->where('category_id', $cat->id)
                ->where('featured', 1)
                ->orderBy('id', 'desc')->paginate(12);

        } else {
            $posts = collect([]);
            $featured_posts = collect([]);
        }
        $post_count = $posts->count();
        $featured_post_count = $featured_posts->count();

        $post = Post::where('slug', $slug)->first();
        // echo "<pre>";
        // print_r($post);
        return view('frontend.pages.potnitola_circle')->with(['fmdata' => $featured_posts,'mdata' => $posts, 'count' => $post_count,'featured_count' => $featured_post_count, 'cat' => $cat, 'slug' => $slug]);
    }
    public function intelligence(Request $request)
    {
        $slug = 'intelligence';
        $cat = Category::where('slug', $slug)->first();

        if ($cat) {
            // $posts = Post::select('posts')
            //     ->join('category_post', 'category_post.post_id', '=', 'posts.id')
            //     ->where('category_post.category_id', $cat->id)
            //     ->orderBy('posts.id', 'desc')->paginate(12);

            $posts = Post::select('posts.*')
                ->where('category_id', $cat->id)
                ->where('featured', 0)
                ->orderBy('id', 'desc')->paginate(12);
            $featured_posts = Post::select('posts.*')
                ->where('category_id', $cat->id)
                ->where('featured', 1)
                ->orderBy('id', 'desc')->paginate(12);

        } else {
            $posts = collect([]);
            $featured_posts = collect([]);
        }
        $post_count = $posts->count();
        $featured_post_count = $featured_posts->count();

        $post = Post::where('slug', $slug)->first();
        // echo "<pre>";
        // print_r($post);
        return view('frontend.pages.potnitola_circle')->with(['fmdata' => $featured_posts,'mdata' => $posts, 'count' => $post_count,'featured_count' => $featured_post_count, 'cat' => $cat, 'slug' => $slug]);
    }
    public function state_development(Request $request)
    {
        $slug = 'state-development';
        $cat = Category::where('slug', $slug)->first();

        if ($cat) {
            // $posts = Post::select('posts')
            //     ->join('category_post', 'category_post.post_id', '=', 'posts.id')
            //     ->where('category_post.category_id', $cat->id)
            //     ->orderBy('posts.id', 'desc')->paginate(12);

            $posts = Post::select('posts.*')
                ->where('category_id', $cat->id)
                ->where('featured', 0)
                ->orderBy('id', 'desc')->paginate(12);
            $featured_posts = Post::select('posts.*')
                ->where('category_id', $cat->id)
                ->where('featured', 1)
                ->orderBy('id', 'desc')->paginate(12);

        } else {
            $posts = collect([]);
            $featured_posts = collect([]);
        }
        $post_count = $posts->count();
        $featured_post_count = $featured_posts->count();

        $post = Post::where('slug', $slug)->first();
        // echo "<pre>";
        // print_r($post);
        return view('frontend.pages.potnitola_circle')->with(['fmdata' => $featured_posts,'mdata' => $posts, 'count' => $post_count,'featured_count' => $featured_post_count, 'cat' => $cat, 'slug' => $slug]);
    }

    public function contact_us()
    {

        return view('frontend.pages.contact');
    }
    public function contact_send(Request $request)
    {

        //dd($request);
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ];

        Mail::to('noreply@example.com')->send(new SendMail($data));

        return back()->with('success', 'Thanks for contacting us!');
    }

    public function site_photo_gallery(Request $request)
    {

        $cat = Category::where('slug', 'photo-gallery')->first();
        if ($cat) {
            $posts = Post::select('posts.*')
                ->join('category_post', 'category_post.post_id', '=', 'posts.id')
                ->where('category_post.category_id', $cat->id)
                ->orderBy('id', 'desc')->get();
        } else {
            $posts = collect([]);
        }
        $post_count = $posts->count();


        return view('frontend.pages.gallary_photo')->with(['mdata' => $posts, 'count' => $post_count]);
    }
    public function site_video_gallery(Request $request)
    {

        $cat = Category::where('slug', 'video-gallery')->first();
        if ($cat) {
            $posts = Post::select('posts.*')
                ->join('category_post', 'category_post.post_id', '=', 'posts.id')
                ->where('category_post.category_id', $cat->id)
                ->orderBy('id', 'desc')->get();
        } else {
            $posts = collect([]);
        }
        $post_count = $posts->count();

        // dd($posts);
        return view('frontend.pages.gallary_video')->with(['mdata' => $posts, 'count' => $post_count]);
    }
    public function site_photo_gallery_single(Request $request, $id)
    {

        $post = Post::findOrFail($id);


        return view('frontend.pages.gallary_photo_single')->with(['mdata' => $post]);
    }
}
