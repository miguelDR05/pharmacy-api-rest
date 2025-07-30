<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'active',
        'user_created',
        'user_updated'
    ];

    public function clients()
    {
        return $this->hasMany(Client::class);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    public function purchaseDocumentTypes()
    {
        return $this->hasMany(PurchaseDocumentType::class);
    }
}
