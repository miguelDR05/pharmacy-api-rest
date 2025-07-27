<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{

    protected $fillable = ['dni', 'name', 'email', 'phone', 'address', 'active', 'updated_at'];

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
}
