<?php

use App\Models\Group;
use App\Models\Lead;
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
        Schema::create('lead_groups', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Lead::class, 'lead_id')->constrained()->onDelete('cascade');
            $table->foreignIdFor(Group::class, 'group_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lead_groups');
    }
};
