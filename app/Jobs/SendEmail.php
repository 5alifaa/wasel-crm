<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Mail\ColdEmail;
use App\MailingTraceStatus;
use App\Models\Mailing;
use App\Models\MailingTrace;
use Illuminate\Bus\Batchable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;
use Log;

class SendEmail implements ShouldQueue
{
    use Batchable, Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        protected Mailing      $mailing,
        protected MailingTrace $trace)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // put the name and email of the lead in the body of the email
        $this->mailing->body = str_replace(['{{name}}', '{{email}}'], [$this->trace->lead->name, $this->trace->lead->email], $this->mailing->body);

        Mail::to($this->trace->lead->email)->send(new ColdEmail($this->mailing));

        $this->trace->update([
            'status' => MailingTraceStatus::SENT,
            'sent_at' => now(),
        ]);

    }

    public function fail($exception = null): void
    {
        Log::error('Failed to send email for trace ID: ' . $this->trace->id . '. Error: ' . $exception?->getMessage());

        $this->trace->update([
            'status' => MailingTraceStatus::ERROR,
            'error_at' => now(),
        ]);
    }
}
