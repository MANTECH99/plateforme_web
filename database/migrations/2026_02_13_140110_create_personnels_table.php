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
        Schema::create('personnels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete()->unique();

            $table->string('photo_path')->nullable();
            $table->string('job_title');
            $table->unsignedSmallInteger('experience_years')->default(0);
            $table->text('description')->nullable();
            $table->string('availability')->nullable();
            $table->string('city');
            $table->unsignedInteger('desired_salary')->nullable();
            $table->boolean('certified')->default(false);

            // CV sections (optionnelles, pour un rendu type "CV")
            $table->text('career_path')->nullable();
            $table->text('work_history')->nullable();
            $table->text('skills')->nullable();

            $table->timestamps();

            $table->index(['job_title', 'city']);
            $table->index(['certified']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personnels');
    }
};
