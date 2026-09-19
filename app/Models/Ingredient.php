<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    protected $fillable = [
        'name',
        'description',
        'unit',
        'stock',
        'minimum_stock',
        'cost_per_unit',
    ];
}
