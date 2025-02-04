<?php

namespace App\Http\Controllers;

use App\Http\Requests\MoleculeRequest;
use App\Models\Molecule;
use App\Repositories\Interfaces\MoleculeRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MoleculeController extends Controller
{
    private $moleculeRepository;

    public function __construct(MoleculeRepositoryInterface $moleculeRepository)
    {
        $this->moleculeRepository = $moleculeRepository;
    }

    public function createMolecule(MoleculeRequest $request)
    {
        try {
            $validated = $request->validated();
            $userId = $request->user()->id;

            $molecule = $this->moleculeRepository->create($validated, $userId);

            return response()->json([
                'status' => true,
                'message' => 'Molecule created successfully',
                'molecule' => $molecule,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Molecule creation failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function updateMolecule(MoleculeRequest $request, $id)
    {
        try {
            $molecule = Molecule::findOrFail($id);
            $molecule->update([
                'name' => $request->name,
                'is_active' => $request->is_active,
                'updated_by' => auth()->id(), // Ensure user authentication
            ]);
    
            return response()->json([
                'status' => true,
                'message' => 'Molecule updated successfully',
                'molecule' => $molecule
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Molecule update failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    

    public function deleteMolecule($id)
    {
        try {
            // $userId = $request->user()->id;

            $userId = Auth::id();
            $this->moleculeRepository->delete($id, $userId);

            return response()->json([
                'status' => true,
                'message' => 'Molecule deleted successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Molecule deletion failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getAllMolecules()
    {
        try {
            $molecules = $this->moleculeRepository->getAll();

            return response()->json([
                'status' => true,
                'molecules' => $molecules,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to fetch molecules',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
