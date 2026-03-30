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
        Schema::create('maintenance_logs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('machine_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('operator_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->text('description');
            $table->string('status')->nullable();

            $table->date('maintenance_date')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenance_logs');
    }
};
