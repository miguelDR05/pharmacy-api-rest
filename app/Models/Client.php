<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'document_type_id',
        'document_number',
        'name',
        'email',
        'phone',
        'address',
        'active',
        'user_created',
        'user_updated',
    ];

    public function documentType()
    {
        return $this->belongsTo(DocumentType::class);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
}
