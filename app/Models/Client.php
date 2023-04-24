<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $guarded = [];

    protected $fillable = [
        'name',
        'description',
        'type',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];
}
