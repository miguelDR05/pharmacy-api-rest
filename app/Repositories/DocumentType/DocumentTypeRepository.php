<?php

namespace App\Repositories\DocumentType;

use App\Models\DocumentType;
use Carbon\Carbon;

class DocumentTypeRepository
{
    public function all()
    {
        return DocumentType::all();
    }

    public function find($id)
    {
        return DocumentType::findOrFail($id);
    }

    public function create(array $data): DocumentType
    {
        return DocumentType::create($data);
    }

    public function update(DocumentType $documentType, array $data): DocumentType
    {
        $documentType->update($data);
        return $documentType;
    }

    public function delete(DocumentType $documentType, $userId): bool
    {
        return $documentType->update([
            'active' => 0,
            'user_updated' => $userId,
            'updated_at' => Carbon::now(),
        ]);
    }

    public function getActiveForCombo()
    {
        return DocumentType::where('active', 1)->get();
    }
}
