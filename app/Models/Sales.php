<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference',
        'productName',
        'quantity',
        'price',
        'amount',

    ];

    protected $casts = [
        'quantity' => 'integer',
        'price' => 'decimal:2',
        'amount' => 'decimal:2',
    ];
}
