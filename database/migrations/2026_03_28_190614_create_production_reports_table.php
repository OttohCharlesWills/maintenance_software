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
        Schema::create('production_reports', function (Blueprint $table) {

            $table->id();

            $table->foreignId('machine_id')->constrained();

            $table->foreignId('operator_id')->constrained('users');

            $table->decimal('bsw',8,2)->nullable();

            $table->decimal('gross',10,2);

            $table->decimal('net',10,2);

            $table->decimal('net_previous_day',10,2)->nullable();

            $table->decimal('month_to_date',12,2)->nullable();

            $table->date('report_date');

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('production_reports');
    }
};
