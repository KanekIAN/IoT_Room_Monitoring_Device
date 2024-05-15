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
        Schema::create('sensordata', function (Blueprint $table) {
            $table->id();
            $table->float('suhu');
            $table->integer('kelembapan');
            $table->string('api');
            $table->integer('asap');
            $table->string('motion');
            $table->string('pintu');
            $table->string('buzzer');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sensordata');
    }
};
