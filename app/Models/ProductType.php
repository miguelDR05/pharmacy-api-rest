<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'active',
        'user_created',
        'user_updated',
        'updated_at'
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'type_id');
    }
}
