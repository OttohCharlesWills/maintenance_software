<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
                    $table->id();
                    $table->string('name');
                    $table->string('email')->unique();
                    $table->string('password');

                    $table->enum('role', [
                        'superadmin',
                        'admin',
                        'operator',
                        'viewer'
                    ]);

                    $table->foreignId('location_id')->nullable()->constrained()->cascadeOnDelete();

                    $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();

                    $table->timestamps();
                });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
