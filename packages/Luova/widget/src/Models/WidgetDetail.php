<?php

namespace Luova\Widget\Models;

use Illuminate\Database\Eloquent\Model;

class WidgetDetail extends Model
{
    protected $table = 'widget_details';
    protected $fillable = [
        'titel', 'group_id', 'type', 'type_id', 'type_slug', 'description', 'listing', 'images', 'photo', 'link', 'class', 'title_visible',
        'remarks', 'is_active', 'create_date', 'sort_by', 'create_by', 'modified_by'
    ];

    public function wgroup()
    {
        return $this->belongsTo(WidgetGroup::class, 'group_id');
    }
}
