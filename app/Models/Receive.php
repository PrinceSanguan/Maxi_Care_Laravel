<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receive extends Model
{
    use HasFactory;

    protected $fillable = [
        'supplier',
        'product',
        'reference',
        'quantity',
        'amount',
        'expired',
        'dateReceived',
    ];

    // Optionally, if you want to cast 'expired' as a date
    protected $casts = [
        'expired' => 'date',
        'dateReceived' => 'date',
    ];
}

