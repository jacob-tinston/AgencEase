<?php

namespace App\Jobs;

use App\Models\Central\Tenant;
use App\Models\Tenant\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateTenantAdmin implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** @var Tenant */
    protected $tenant;

    public function __construct(Tenant $tenant)
    {
        $this->tenant = $tenant;
    }

    public function handle()
    {
        $this->tenant->run(function ($tenant) {
            User::create(
                $tenant->only(['global_id', 'name', 'email', 'password'])
            )->assignRole('Super Admin');

            $tenant->update([
                'name' => '',
                'email' => '',
                'password' => '',
                'ready' => true,
            ]);
        });
    }
}
