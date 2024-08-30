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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('supplier');
            $table->string('email');
            $table->string('product');
            $table->timestamps();
        });

        DB::table('suppliers')->insert([
            [
                'supplier' => 'Mercury Drug',
                'email' => 'mercurydrug@gmail.com',
                'product' => 'Paracetamol',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'supplier' => 'Watson',
                'email' => 'watson@gmail.com',
                'product' => 'Feminine Wash',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'supplier' => 'South Star Drug',
                'email' => 'ssd@gmail.com',
                'product' => 'Condom',
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
        Schema::dropIfExists('suppliers');
    }
};
