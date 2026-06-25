<?php

namespace App\Jobs;

use App\Models\Lead;
use App\Models\Mailing;
use App\Models\MailingTrace;
use Illuminate\Bus\Batchable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendEmail implements ShouldQueue
{
    use Batchable, Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        protected Mailing $mailing,
        protected int     $recipientId)
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
        if (!$recipient) {
            \Log::error("Recipient with ID {$this->recipientId} not found.");
            throw new \Exception("Recipient with ID {$this->recipientId} not found.");
            return;
        }
        // Create Mailing Trace
        $trace = MailingTrace::create([
            'mailing_id' => $this->mailing->id,
            'lead_id' => $this->recipientId,
        ]);
        // Send email using Laravel's Mail facade
        Mail::to($recipient->email)->send(new \App\Mail\ColdEmail());

        // Update Mailing Trace status to SENT
        $trace->update([
            'status' => \App\MailingTraceStatus::SENT,
            'sent_at' => now(),
        ]);

    }

    public function fail($exception = null): void
    {
        // Log the exception or handle it as needed
        \Log::error('SendEmail job failed: ' . $exception->getMessage());

        // Update Mailing Trace status to ERROR
        $trace = MailingTrace::where('mailing_id', $this->mailing->id)
            ->where('lead_id', $this->recipientId)
            ->first();

        $trace?->update([
            'status' => \App\MailingTraceStatus::ERROR,
            'error_at' => now(),
        ]);

    }
}
