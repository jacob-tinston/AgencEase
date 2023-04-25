<?php

namespace App\Jobs;

use App\Mail\InviteCreated;
use App\Models\Central\Tenant\Invite;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendInvite implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** @var Invite */
    protected $invite;

    protected $email;

    public function __construct(Invite $invite, $email)
    {
        $this->invite = $invite;
        $this->email = $email;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->email)->send(new InviteCreated($this->invite));
    }
}
