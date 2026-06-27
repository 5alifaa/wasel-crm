<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Mail\ColdEmail;
use App\MailingTraceStatus;
use App\Models\Lead;
use App\Models\Mailing;
use App\Models\MailingTrace;
use Exception;
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
        protected Mailing $mailing,
        protected int $recipientId)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Fetch recipient email from database using recipientId
        $recipient = Lead::find($this->recipientId);
        if (! $recipient) {
            Log::error("Recipient with ID {$this->recipientId} not found.");
            throw new Exception("Recipient with ID {$this->recipientId} not found.");
        }

        // Idempotent trace lookup — retry-safe
        $trace = MailingTrace::firstOrCreate([
            'mailing_id' => $this->mailing->id,
            'lead_id' => $this->recipientId,
        ]);

        //        if ($recipient->name == 'Jon Parker') {
        //            $this->fail(new \Exception("Recipient with ID {$this->recipientId} is Jon Parker, skipping email."));
        //            return;
        //        }

        if ($trace->status === MailingTraceStatus::SENT) {
            return;
        }

        Mail::to($recipient->email)->send(new ColdEmail($this->mailing));

        $trace->update([
            'status' => MailingTraceStatus::SENT,
            'sent_at' => now(),
        ]);

    }

    public function fail($exception = null): void
    {
        // Log the exception or handle it as needed
        Log::error('SendEmail job failed: '.$exception->getMessage());

        Log::error('id: '.$this->recipientId);

        // Update Mailing Trace status to ERROR
        $trace = MailingTrace::where('mailing_id', $this->mailing->id)
            ->where('lead_id', $this->recipientId)
            ->first();

        $trace?->update([
            'status' => MailingTraceStatus::ERROR,
            'error_at' => now(),
        ]);

    }
}
