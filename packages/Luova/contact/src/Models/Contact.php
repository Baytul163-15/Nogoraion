<?php

namespace Luova\Contact\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contacts';
    protected $fillable = [
        'to_mail', 'name', 'email', 'subject', 'message', 'mobile'
    ];
}
