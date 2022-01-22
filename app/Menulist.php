<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menulist extends Model
{
    protected $fillable = ['title','parent_id','url'];

    public function childs()
    {
        return $this->hasMany('App\Menulist','parent_id', 'id');

    }
}
