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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('brand')->nullable();
            $table->string('model')->nullable();
            $table->string('plate_number')->nullable();
            $table->string('color')->nullable();
            $table->integer('year')->nullable();
            $table->dateTime('last_engine_oil_change_date')->nullable();
            $table->dateTime('last_maintenance_date')->nullable();
            $table->dateTime('next_maintenance_date')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
