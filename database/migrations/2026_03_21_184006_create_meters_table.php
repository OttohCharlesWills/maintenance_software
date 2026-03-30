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
        Schema::create('meters', function (Blueprint $table) {
            $table->id();

            $table->foreignId('machine_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('started_by')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('ended_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamp('start_time');

            $table->timestamp('end_time')
                ->nullable();

            $table->integer('duration_seconds')
                ->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meters');
    }
};
