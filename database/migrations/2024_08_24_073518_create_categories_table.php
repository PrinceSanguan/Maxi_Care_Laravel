<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('category');
            $table->timestamps();
        });

        DB::table('categories')->insert([
            [
                'category' => 'Generic',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'Generic Bottles',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'Cosmetics',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'Supplies',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'Branded',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'Milk',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'Ritemed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
