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
        Schema::create('line0s', function (Blueprint $table) {
            $table->id();
            $table->date('Tanggal');
            $table->string('PartNumber');
            $table->integer('FlangeNon');
            $table->integer('Quantity');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('line0s');
    }
};
