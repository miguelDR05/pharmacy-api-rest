<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    protected $fillable = [
        'name',
        'description',
        'active',
        'updated_at'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
