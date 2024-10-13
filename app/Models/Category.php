<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucwords($value);
    }
    public function products()
    {
        return $this->hasMany(Product::class,'category_id');
    }
    public function casts()
    {
        return [
            'name' => 'string'
        ];
    }
}
