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
        Schema::create('medicines', function (Blueprint $table) {
            $table->id();
            $table->string('category');
            $table->string('productName');
            $table->string('productInformation');
            $table->decimal('price', 8, 2);
            $table->string('prescription');
            $table->timestamps();
        });

        DB::table('medicines')->insert([
            [
                'category' => 'Generic',
                'productName' => 'Paracetamol',
                'productInformation' => 'Pain reliever and fever reducer',
                'price' => 5,
                'prescription' => 'on',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'Branded',
                'productName' => 'Ibuprofen',
                'productInformation' => 'Nonsteroidal anti-inflammatory drug',
                'price' => 7,
                'prescription' => 'on',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'Ritemed',
                'productName' => 'Aspirin',
                'productInformation' => 'Pain reliever, fever reducer, and blood thinner',
                'price' => 6,
                'prescription' => 'on',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'Generic',
                'productName' => 'Amoxicillin',
                'productInformation' => 'Antibiotic for bacterial infections',
                'price' => 10,
                'prescription' => 'off',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'Cosmetics',
                'productName' => 'Azithromycin',
                'productInformation' => 'Antibiotic for bacterial infections',
                'price' => 15,
                'prescription' => 'on',
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
        Schema::dropIfExists('medicines');
    }
};
