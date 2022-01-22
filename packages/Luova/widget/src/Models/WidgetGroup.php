<?php

namespace Luova\Widget\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WidgetGroup extends Model
{
    use SoftDeletes;
    protected $table = 'widget_groups';
    protected $fillable = [
        'titel',
        'remarks', 'sort_by', 'is_active', 'create_by', 'modified_by'
    ];

    public function children()
    {
        return $this->hasMany(WidgetDetail::class, 'group_id', 'id')->orderBy('sort_by', 'ASC');
    }
}
