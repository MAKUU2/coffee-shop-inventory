<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StockIn extends Model
{
    protected $fillable = [
        'ingredient_id',
        'quantity',
        'cost_per_unit',
        'stock_in_date',
        'notes',
    ];

    protected $casts = [
        'stock_in_date' => 'date',
        'quantity' => 'decimal:2',
        'cost_per_unit' => 'decimal:2',
    ];

    public function ingredient(): BelongsTo
    {
        return $this->belongsTo(Ingredient::class);
    }
}
