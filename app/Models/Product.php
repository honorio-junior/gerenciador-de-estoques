<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucwords($value);
    }
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class,'category_id');
    }
    public function stock(): BelongsTo
    {
        return $this->belongsTo(Stock::class,'stock_id');
    }
    public function casts()
    {
        return [
            'stock_id' => 'integer',
            'category_id' => 'integer',
            'name' => 'string',
            'amount' => 'integer',
            'price' => 'decimal:2',
        ];
    }
}
