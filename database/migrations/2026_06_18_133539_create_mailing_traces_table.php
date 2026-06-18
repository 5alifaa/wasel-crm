<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mailing_traces', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(\App\Models\Mailing::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Lead::class)->constrained()->cascadeOnDelete();

            $table->string('status')->default(\App\MailingTraceStatus::PENDING->value);
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
