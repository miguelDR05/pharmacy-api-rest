<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StorageCondition extends Model
{
    use HasFactory;

    protected $fillable = [
        'label',
        'value',
        'active',
        'user_created',
        'user_updated',
    ];
}
