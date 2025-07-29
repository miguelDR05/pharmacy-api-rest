<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lab extends Model
{

    protected $fillable = [
        'name',
        'active',
        'user_created',
        'user_updated',
        'updated_at'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
