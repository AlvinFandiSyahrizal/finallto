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
        Schema::create('jadwallines', function (Blueprint $table) {
            $table->id();
            $table->string('Jam');
            $table->date('Tanggal');
            $table->string('PartNumber');
            $table->integer('FlangeNon');
            $table->integer('Quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwallines');
    }
};
