<?php

namespace App\Actions;

use App\Jobs\SendEmail;
use App\Models\Mailing;
use Illuminate\Support\Facades\Bus;

class SendMailing
{
    public function handle(Mailing $mailing): void
    {
        $jobs = [];

        foreach ($mailing->recipients as $recipientId) {
            $jobs[] = new SendEmail($mailing, $recipientId);
        }

        // Dispatch the jobs in batches
        Bus::batch($jobs)->dispatch();
    }
}
