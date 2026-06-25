<?php

use App\MailingStatus;
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
        Schema::create('mailings', function (Blueprint $table) {
            $table->id();

            $table->char('subject');
            $table->text('body');
            $table->string('status')->default(MailingStatus::DRAFT);
            $table->string('email_from');
            // recipient array : this should be a JSON array of recipient emails
            $table->json('recipients');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mailings');
    }
};
