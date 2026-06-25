<?php

use App\MailingTraceStatus;
use App\Models\Lead;
use App\Models\Mailing;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mailing_traces', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Mailing::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Lead::class)->constrained()->cascadeOnDelete();

            $table->string('status')->default(MailingTraceStatus::PENDING->value);
            $table->dateTime('sent_at')->nullable();
            $table->dateTime('error_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mailing_traces');
    }
};
