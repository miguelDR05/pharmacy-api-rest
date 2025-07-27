<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductPresentation extends Model
{

    protected $fillable = [
        'name',
        'active',
        'updated_at'
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'presentation_id');
    }
}
