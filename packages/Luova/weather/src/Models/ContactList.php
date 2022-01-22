<?php

namespace Luova\Contactlist\Models;

use Illuminate\Database\Eloquent\Model;

class ContactList extends Model
{
    protected $table = 'contact_lists';
    protected $fillable = [
        'menu_id', 'designation', 'phone', 'mobile', 'fax', 'email', 'name', 'photo',
        'remarks', 'is_active', 'create_date', 'sort_by', 'create_by', 'last_modified'
    ];

    public function menu()
    {
        return $this->belongsTo(ContactMenu::class, 'menu_id');
    }
}
