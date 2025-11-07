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
        Schema::create('question_sections', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('survey_program_id')->constrained('survey_programs')->onDelete('cascade');
            $table->string('title'); 
            $table->text('description')->nullable(); 
            $table->integer('order_column')->default(0); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('question_sections');
    }
};
