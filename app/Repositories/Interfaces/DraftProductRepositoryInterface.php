<?php

namespace App\Repositories\Interfaces;

use App\Models\DraftProduct;

interface DraftProductRepositoryInterface {
    public function createDraft(array $data): DraftProduct;
    public function updateDraft(int $id, array $data): DraftProduct;
    public function findById(int $id): ?DraftProduct;
}
