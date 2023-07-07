<?php

namespace App\Models\Tenant;

use App\Models\Central\CentralUser;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Stancl\Tenancy\Contracts\Syncable;
use Stancl\Tenancy\Database\Concerns\ResourceSyncing;

class User extends Authenticatable implements Syncable, Jsonable
{
    use HasRoles, ResourceSyncing, Notifiable;

    public $timestamps = true;

    protected $fillable = [
        'global_id',
        'name',
        'email',
        'avatar',
        'password',
        'per_page',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function getGlobalIdentifierKey()
    {
        return $this->getAttribute($this->getGlobalIdentifierKeyName());
    }

    public function getGlobalIdentifierKeyName(): string
    {
        return 'global_id';
    }

    public function getCentralModelName(): string
    {
        return CentralUser::class;
    }

    public function getSyncedAttributeNames(): array
    {
        return $this->fillable;
    }

    public function contact()
    {
        return $this->hasOne(Contact::class);
    }

    /**
     * The channels the user receives notification broadcasts on.
     */
    public function receivesBroadcastNotificationsOn(): string
    {
        return 'users.'.$this->id;
    }

    /**
     * Route notifications for the mail channel.
     *
     * @return  array<string, string>|string
     */
    public function routeNotificationForMail(): array|string
    {
        return [$this->email => $this->name];
    }

}
