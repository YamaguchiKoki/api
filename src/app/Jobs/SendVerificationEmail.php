<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Mail\AuthCodeMailable;
use App\Models\Otps;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

final class SendVerificationEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected User $user;

    protected Otps $otp;

    /**
     * Create a new job instance.
     */
    public function __construct(User $user)
    {
        $this->user = $user;

        $this->otp = $user->otps()->where('expired_at', '>', now())->where('is_used', 0)->first();
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $email = new AuthCodeMailable($this->otp->otp_code);
        Mail::to($this->user->email)->send($email);
    }
}
