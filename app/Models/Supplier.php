<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'ruc',
        'address',
        'phone',
        'email',
        'active',
        'user_created',
        'user_updated',
    ];

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
}
