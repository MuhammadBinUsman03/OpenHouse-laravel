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
        Schema::create('evaluations', function (Blueprint $table) {
            $table->id('evaluation_id');
            $table->foreignId('evaluator_id')->constrained('evaluators', 'evaluator_id');
            $table->foreignId('project_id')->constrained('projects', 'project_id');
            $table->enum('evaluation_rating', ['1 (lowest)', '2', '3', '4', '5', '6', '7', '8', '9', '10 (highest)']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluations');
    }
};
