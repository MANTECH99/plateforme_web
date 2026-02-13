<?php

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
        Schema::create('connections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('house_id')->constrained('houses')->cascadeOnDelete();
            $table->foreignId('personnel_id')->constrained('personnels')->cascadeOnDelete();
            $table->string('status')->default('pending'); // pending|approved|rejected
            $table->timestamps();

            $table->unique(['house_id', 'personnel_id']);
            $table->index(['status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('connections');
    }
};
