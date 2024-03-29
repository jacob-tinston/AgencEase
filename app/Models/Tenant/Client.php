<?php

namespace App\Models\Tenant;

use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Database\Eloquent\Model;

class Client extends Model implements Jsonable
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

    public function contacts()
    {
        return $this->belongsToMany(Contact::class, 'clients_contacts', 'client_id', 'contact_id')->withPivot('role');
    }
}
