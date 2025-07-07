<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes;

    protected $fillable = ['dni', 'name', 'email', 'phone', 'address', 'active', 'user_created', 'user_updated'];

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
}
