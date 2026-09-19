<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StockOut extends Model
{
    protected $fillable = [
        'ingredient_id',
        'quantity',
        'stock_out_date',
        'notes',
    ];

    protected $casts = [
        'stock_out_date' => 'date',
        'quantity' => 'decimal:2',
    ];

    public function ingredient(): BelongsTo
    {
        return $this->belongsTo(Ingredient::class);
    }
}
