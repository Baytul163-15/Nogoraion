<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Post;
use App\Bitpolice;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MenuController;

// Route::get('/', function () {
//     return view('welcome');
// });


// Route::group(['prefix' => 'admin'], function () {
//     Voyager::routes();
// });



Route::get('/posts/delete_value/{id}/{field}', array(
    'uses' => 'Voyager\PostController@delete_value',
    'as' => 'admin.posts.delete_value'
));

/** --------------------------------------------------------------------------------- */
/** --------------------------------------------------------------------------------- */
/** -------------- All the web frontend routes are in below part -------------------- */
/** --------------------------------------------------------------------------------- */
/** --------------------------------------------------------------------------------- */
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('password/confirm', 'Auth\ConfirmPasswordController@showConfirmForm')->name('password.confirm');
Route::post('password/confirm', 'Auth\ConfirmPasswordController@confirm');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::get('admin/hr/user/register', 'Auth\RegisterController@showRegistrationForm')->name('admin.hr.user.register')->middleware('auth');
Route::post('admin/hr/user/register', 'Auth\RegisterController@register')->middleware('auth');

Route::get('/', 'Site\HomeController@index');
Route::get('/home', 'Site\HomeController@index');
Route::get('/welcome', 'Site\HomeController@welcome');
Route::get('/post/{slug}', 'Site\HomeController@post');
Route::get('/post_cat/{slug}', 'Site\HomeController@post_cat');
Route::get('/post_author/{author_id}', 'Site\HomeController@post_author');
Route::get('/notice/{slug}', 'Site\HomeController@notice');
Route::get('/former-chief', 'Site\HomeController@former_chief');
Route::get('/naogaon-sadar-circle', 'Site\HomeController@naogaon_sadar_circle');
Route::get('/mohadebpur-circle', 'Site\HomeController@mohadebpur_circle');
Route::get('/potnitola-circle', 'Site\HomeController@potnitola_circle');
Route::get('/sapahar-circle', 'Site\HomeController@sapahar_circle');
Route::get('/manda-circle', 'Site\HomeController@manda_circle');
Route::get('/naogaon-sadar-thana', 'Site\HomeController@naogaon_sadar_thana');
Route::get('/atrai-thana', 'Site\HomeController@atrai_thana');
Route::get('/dhamirhat-thana', 'Site\HomeController@dhamirhat_thana');
Route::get('/manda-thana', 'Site\HomeController@manda_thana');
Route::get('/mohadebpur-thana', 'Site\HomeController@mohadebpur_thana');
Route::get('/niamotpur-thana', 'Site\HomeController@niamotpur_thana');
Route::get('/potnitola-thana', 'Site\HomeController@potnitola_thana');
Route::get('/porsha-thana', 'Site\HomeController@porsha_thana');
Route::get('/raninagar-thana', 'Site\HomeController@raninagar_thana');
Route::get('/sapahar-thana', 'Site\HomeController@sapahar_thana');
Route::get('/bodolgachi-thana', 'Site\HomeController@bodolgachi_thana');
Route::get('/dsb', 'Site\HomeController@dsb');
Route::get('/db', 'Site\HomeController@db');
Route::get('/sadar-court', 'Site\HomeController@sadar_court');
Route::get('/police-lines', 'Site\HomeController@police_lines');
Route::get('/traffic-division', 'Site\HomeController@traffic_division');
Route::get('/investigation_center', 'Site\HomeController@investigation_center');
Route::get('/outpost', 'Site\HomeController@outpost');
Route::get('/camp', 'Site\HomeController@camp');
Route::get('/crime-brance', 'Site\HomeController@crime_brance');
Route::get('/prosecution', 'Site\HomeController@prosecution');
Route::get('/intelligence', 'Site\HomeController@intelligence');
Route::get('/state-development', 'Site\HomeController@state_development');
Route::get('/page/{slug}', 'Site\HomeController@page');
Route::get('/contact_us', 'Site\HomeController@contact_us');
Route::post('/contact_send', 'Site\HomeController@contact_send');



Route::get('/gallery/photo', 'Site\HomeController@site_photo_gallery')->name('site.gallery');
Route::get('/gallery/video', 'Site\HomeController@site_video_gallery')->name('site.video');
Route::get('/gallery/{id?}/photo', 'Site\HomeController@site_photo_gallery_single')->name('site.gallery.single');
// Route::get('/home', 'HomeController@index')->name('home');


Route::get('/sluggable', function (Request $request) {


    if ($request->get('type') && $request->get('title')) {
        if ($request->get('type') == 'post') {
            $slug = SlugService::createSlug(Post::class, 'slug', $request->get('title'), ['unique' => true]);
        }
        return $slug;
    }
});



// Cache Remover
Route::get('/php-artisan/{id?}', function ($id = null) {
    $array = [];
    $array[1] = [
        'call' => 'optimize:clear',
        'massage' => 'Reoptimized class loader'
    ];
    $array[2] = [
        'call' => 'route:clear',
        'massage' => 'Clear Route clear'
    ];
    $array[3] = [
        'call' => 'view:clear',
        'massage' => 'Clear View'
    ];
    $array[4] = [
        'call' => 'config:clear',
        'massage' => 'Clear Config'
    ];
    $array[5] = [
        'call' => 'config:cache',
        'massage' => 'Clear Config caches'
    ];
    $array[6] = [
        'call' => 'cache:clear',
        'massage' => 'Menu Cache'
    ];
    $array[7] = [
        'call' => 'storage:link',
        'massage' => 'Storage linked'
    ];

    $html = '';
    if ($id) {
        $exitCode = Artisan::call($array[$id]['call']);

        $html .= '<h1>' . $array[$id]['massage'] . '</h1><br>';
    } else {
        $html .= '<h1>See below,What you want?</h1><br>';
    }

    //$exitCode = Artisan::call('cache:clear');
    $html .= '<a href="' . url('php-artisan/1') . '"> ==> Optimized </a><br>';
    $html .= '<a href="' . url('php-artisan/2') . '"> ==> Route Clear</a><br>';
    $html .= '<a href="' . url('php-artisan/3') . '"> ==> View Clear</a><br>';
    $html .= '<a href="' . url('php-artisan/4') . '"> ==> Config Clear</a><br>';
    $html .= '<a href="' . url('php-artisan/5') . '"> ==> Config cache</a><br>';
    $html .= '<a href="' . url('php-artisan/6') . '"> ==> Menu cache</a><br>';
    $html .= '<a href="' . url('php-artisan/7') . '"> ==> storage link</a><br>';
    $html .= '<br><a href="' . url('/') . '"> ==> Back to Home</a><br>';
    return $html;
});



/** --------------------------------------------------------------------------------- */
/** --------------------------------------------------------------------------------- */
/** -------------- All the web Backend Dashboard routes are in below part ----------- */
/** --------------------------------------------------------------------------------- */
/** --------------------------------------------------------------------------------- */

Route::get('/admin', [AdminController::class, 'index'])->name('dashboard');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
    Route::resource('posts', PostController::class);
    Route::resource('bitpolices', BitpoliceController::class);
    Route::delete('bitpolices/{id}', 'App\Http\Controllers\BitpoliceController@destroy');
    Route::resource('categories', CategoryController::class);
    Route::get('menus','MenuController@index')->name('menus.index');
    Route::get('menulist/','MenuController@show');
    Route::get('/edit-menu/{id}','MenuController@edit');
    Route::post('menus','MenuController@store')->name('menus.store');
    Route::post('/edit-menu/{id}','MenuController@update');
    Route::post('/delete-menu/{id}','MenuController@destroy');
});
