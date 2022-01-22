<?php

namespace Luova\Bitpolice\Models;

use Illuminate\Database\Eloquent\Model;

class Bitpolice extends Model
{
    protected $table = 'bitpolices';
    protected $fillable = [
        'menu_id', 'designation', 'bit_name', 'address', 'location', 'phone', 'mobile', 'fax', 'email',
        'name', 'photo', 'map', 'map_photo',
        'remarks', 'is_active', 'create_date', 'sort_by', 'create_by', 'last_modified'
    ];

    public function menu()
    {
        return $this->belongsTo(BitpoliceGroup::class, 'menu_id');
    }
}
