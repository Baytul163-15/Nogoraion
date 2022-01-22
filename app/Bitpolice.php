<?php

namespace App;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bitpolice extends Model
{
    // use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'bitpolices';
    protected $fillable = [
        'designation', 'bit_name', 'address', 'location', 'phone', 'mobile', 'fax', 'email', 'remarks', 'name', 'map', 'is_active', 'photo'
    ];
}