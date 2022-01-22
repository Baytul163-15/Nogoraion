<?php

namespace App;

use App\CategoryPost;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use Sluggable;
    protected $table = 'posts';

    public function categories()
    {
        return $this->hasMany('App\CategoryPost');
    }
    protected $fillable = [
        'author_id','category_id','title', 'seo_title','excerpt','body','image','slug','meta_description','meta_keywords','status','featured','video_embed','photos','files'
    ];
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
