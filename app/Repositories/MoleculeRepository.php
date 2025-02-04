<?php

namespace App\Repositories;

use App\Models\Molecule;
use App\Repositories\Interfaces\MoleculeRepositoryInterface;

class MoleculeRepository implements MoleculeRepositoryInterface
{
    public function create(array $data, $userId)
    {
        return Molecule::create([
            'name' => $data['name'],
            'is_active' => $data['is_active'] ?? true,
            'created_by' => $userId,
            'updated_by' => $userId,
        ]);
    }

    public function update(int $id, array $data, $userId)
    {
        // dd($data);
        $molecule = Molecule::findOrFail($id);
        $molecule->update([
            'name' => $data['name'],
            'is_active' => $data['is_active'] ?? $molecule->is_active,
            'updated_by' => $userId,
        ]);
        return $molecule;
    }

    public function delete(int $id, $userId)
    {
        $molecule = Molecule::findOrFail($id);
        $molecule->update(['deleted_by' => $userId]);
        return $molecule->delete();
        
    }

    public function getAll()
    {
        return Molecule::with(['creator:id,name', 'updater:id,name', 'deleter:id,name'])->get();
    }
}
