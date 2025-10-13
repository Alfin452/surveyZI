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
        Schema::create('unit_kerjas', function (Blueprint $table) {
            $table->id();
            $table->string('unit_kerja_name');
            $table->string('alias')->unique()->nullable();
            $table->string('uk_short_name')->nullable();
            $table->foreignId('tipe_unit_id')->nullable()->constrained('tipe_units')->onDelete('set null');
            $table->foreignId('parent_id')->nullable()->constrained('unit_kerjas')->onDelete('set null'); // onDelete('set null') lebih aman
            $table->string('contact')->nullable();
            $table->string('address')->nullable();
            $table->string('start_time')->nullable();
            $table->string('end_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unit_kerjas');
    }
};
