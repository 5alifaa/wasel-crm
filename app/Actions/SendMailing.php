<?php

declare(strict_types=1);

namespace App\Actions;

use App\Jobs\SendEmail;
use App\MailingStatus;
use App\Models\Mailing;
use Illuminate\Support\Facades\Bus;

class SendMailing
{
    protected bool $hasError = false;

    public function handle(int $mailingId): void
    {
        $mailing = Mailing::findOrFail($mailingId);
        $traces = $mailing->traces()->where('status', '!=', 'sent')->get();
        $jobs = [];

        foreach ($traces as $trace) {
            $jobs[] = new SendEmail($mailing, $trace);
        }

        // Dispatch the jobs in batches
        Bus::batch($jobs)
            ->catch(fn() => $this->hasError = true)
            ->finally(fn() => $mailing->update(['status' => $this->hasError ? MailingStatus::DONE_WITH_ERROR : MailingStatus::DONE]))
            ->dispatch()
            ->allowsFailures();

    }
}
