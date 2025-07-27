<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{

    protected $fillable = [
        'name',
        'active',
        'updated_at'
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'type_id');
    }
}
