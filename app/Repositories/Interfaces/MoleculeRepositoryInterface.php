<?php

namespace App\Repositories\Interfaces;

interface MoleculeRepositoryInterface
{
    public function create(array $data, $userId);
    public function update(int $id, array $data, $userId);
    public function delete(int $id, $userId);
    public function getAll();
}
