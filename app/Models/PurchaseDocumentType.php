<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseDocumentType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'active',
        'user_created',
        'user_updated'
    ];

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
}
