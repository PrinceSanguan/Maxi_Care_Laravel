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
        Schema::create('receives', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique();
            $table->string('product');
            $table->string('quantity');
            $table->string('safetyStock')->nullable();
            $table->string('stockAvailable')->nullable();
            $table->string('dateReceived');
            $table->datetime('expired');
            $table->string('amount');
            $table->string('supplier');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receives');
    }
};
