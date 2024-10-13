<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    protected $table = 'stocks';

    public function products()
    {
        return $this->hasMany(Product::class,'stock_id');
    }
    public function casts()
    {
        return [
            'creation_date' => 'date'
        ];
    }
}
