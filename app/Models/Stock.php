<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference',
        'productName',
        'stockIn',
        'stockOut',
        'expired',
        'stockAvailable',
        'safetyStock',
    ];
}
