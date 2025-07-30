<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'description',
        'image',
        'stock',
        'price',
        'expiration_date',
        'batch',
        'concentration',
        'pharmaceutical_form',
        'administration_route',
        'category_id',
        'lab_id',
        'type_id',
        'presentation_id',
        'active',
        'user_created',
        'user_updated',
        'min_stock',
        'manufacturing_date',
        'storage_condition_id', // Ahora es clave foránea
        'requires_prescription',
        'is_controlled',
    ];

    protected $casts = [
        'expiration_date' => 'date', // Castea a un objeto Carbon (DateTime)
        'manufacturing_date' => 'date', // Castea a un objeto Carbon (DateTime)
        'active' => 'boolean',
        'requires_prescription' => 'boolean',
        'is_controlled' => 'boolean',
        'created_at' => 'datetime', // Opcional, pero buena práctica si los usas en resources
        'updated_at' => 'datetime', // Opcional, pero buena práctica si los usas en resources
    ];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function lab()
    {
        return $this->belongsTo(Lab::class);
    }

    public function type()
    {
        return $this->belongsTo(ProductType::class, 'type_id');
    }

    public function presentation()
    {
        return $this->belongsTo(ProductPresentation::class, 'presentation_id');
    }

    // --- NUEVA RELACIÓN ---
    public function storageCondition()
    {
        return $this->belongsTo(StorageCondition::class);
    }

    public function saleDetails()
    {
        return $this->hasMany(SaleDetail::class);
    }

    public function purchaseDetails()
    {
        return $this->hasMany(PurchaseDetail::class);
    }
}
