<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductType extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'active'];

    public function products()
    {
        return $this->hasMany(Product::class, 'type_id');
    }
}
