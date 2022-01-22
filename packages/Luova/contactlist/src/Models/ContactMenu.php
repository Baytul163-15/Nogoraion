<?php

namespace Luova\Contactlist\Models;

use Illuminate\Database\Eloquent\Model;

class ContactMenu extends Model
{
    protected $table = 'contact_menus';
    protected $fillable = [
        'name', 'parent',
        'remarks', 'is_active', 'create_date', 'sort_by', 'create_by', 'last_modified'
    ];

    public function children()
    {
        return $this->hasMany(ContactMenu::class, 'parent');
    }
}
