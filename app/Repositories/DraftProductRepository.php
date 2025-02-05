<?php

namespace App\Repositories;

use App\Models\DraftProduct;
use App\Models\Molecule;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Repositories\Interfaces\DraftProductRepositoryInterface;

class DraftProductRepository implements DraftProductRepositoryInterface {
    public function createDraft(array $data): DraftProduct {
       
        $moleculeNames = Molecule::whereIn('id', $data['combination'])
            ->where('is_active', true)
            ->pluck('name')->toArray();

        if (empty($moleculeNames)) {
            throw new ModelNotFoundException("No active molecules found for provided IDs.");
        }

        $data['combination'] = $moleculeNames;
        $data['product_status'] = 'Draft';

        return DraftProduct::create($data);
    }

    public function updateDraft(int $id, array $data): DraftProduct {
        $product = DraftProduct::findOrFail($id);
        $product->update($data);
        return $product;
    }

    public function findById(int $id): ?DraftProduct {
        return DraftProduct::find($id);
    }
}
