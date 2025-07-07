<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lab extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'active', 'user_created', 'user_updated'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
