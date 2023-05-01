<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $guarded = [];

    protected $fillable = [
        'name',
        'email',
        'phone',
    ];

    protected $casts = [
        'last_contacted' => 'datetime',
    ];

    public function clients()
    {
        return $this->belongsToMany(Client::class, 'clients_contacts', 'contact_id', 'client_id');
    }
}
