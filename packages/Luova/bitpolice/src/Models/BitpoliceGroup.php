<?php

namespace Luova\Bitpolice\Models;

use Illuminate\Database\Eloquent\Model;

class BitpoliceGroup extends Model
{
    protected $table = 'bitpolice_groups';
    protected $fillable = [
        'name', 'parent',
        'remarks', 'is_active', 'create_date', 'sort_by', 'create_by', 'last_modified'
    ];

    public function children()
    {
        return $this->hasMany(BitpoliceGroup::class, 'parent');
    }
}
