<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class shoppingBasket extends Model
{
    use HasFactory;

    protected $fillable = [
        'billStructure'
    ];
}
