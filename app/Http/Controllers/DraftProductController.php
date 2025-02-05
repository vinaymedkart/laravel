<?php
namespace App\Http\Controllers;
use App\Jobs\PublishProductJob;
use App\Http\Requests\DraftProductRequest;
use App\Repositories\Interfaces\DraftProductRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Molecule;
use App\Models\ProductMolecule;
use App\Models\DraftProduct;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class DraftProductController extends Controller {
    private $draftProductRepository;
    
    public function __construct(DraftProductRepositoryInterface $draftProductRepository) {
        $this->draftProductRepository = $draftProductRepository;
    }   
    
    public function store(Request $request): JsonResponse {
      
        $validatedData = $request->validate([
            'name' => 'required|string',
            'sales_price' => 'required|numeric',
            'mrp' => 'required|numeric',
            'manufacturer_name' => 'required|string',
            'is_banned' => 'required|boolean',
            'is_active' => 'required|boolean',
            'is_discontinued' => 'required|boolean',
            'is_assured' => 'required|boolean',
            'is_refridged' => 'required|boolean',
            'category_id' => 'required|exists:categories,id',
            'combination' => 'required|array',
            'combination.*' => 'exists:molecules,id'
        ]);
    
        $validatedData['created_by'] = auth()->id();
    
        $molecules = Molecule::whereIn('id', $validatedData['combination'])
            ->where('is_active', true)
            ->get(['id', 'name']);
    
        if ($molecules->isEmpty()) {
            return response()->json(['status' => false, 'message' => 'No active molecules found'], 400);
        }
    
       
        $validatedData['combination'] = $molecules->pluck('id')->toArray(); 
        $moleculesIds= $validatedData['combination'];
        
        $draftProduct = $this->draftProductRepository->createDraft($validatedData);
        foreach ($moleculesIds as $moleculeId) {
           
            ProductMolecule::create([
                'product_id' => $draftProduct->id,
                'molecule_id' => $moleculeId
            ]);
            
        }
        return response()->json([
            'status' => true,
            'message' => 'DraftProduct created successfully',
            'data' => array_merge($draftProduct->toArray())
        ], 201);
    }
    
    

    public function update(Request $request, $id)
    {
        try {
            $draftProduct = $this->draftProductRepository->findById($id);

            if (!$draftProduct) {
                return response()->json(['status' => 'error', 'message' => 'Draft product not found'], 404);
            }

            $molecules = Molecule::whereIn('id', $request->combination)
            ->where('is_active', true)
            ->get(['id', 'name']);

        // Extract only the 'name' values from the molecules
        $combination = $molecules->pluck('name')->toArray();

        // Update combination in the draft product
        $draftProduct->combination = $combination;
            

            if ($draftProduct->product_status === 'Draft' && $request->product_status === 'Published') {
          
                $wsCode = rand(100000, 999999);
                $draftProduct->ws_code = $wsCode;

                $createdBy = Auth::id();
                $draftProduct->save();

                // dd($draftProduct,$createdBy,$combination);

                PublishProductJob::dispatch($draftProduct, $createdBy, $combination);
                // Log::info('Processing Sent');
                $draftProduct->product_status = $request->product_status;
                 $draftProduct->ws_code =$wsCode;
                 $draftProduct->save();  
                return response()->json(['status' => 'success', 'message' => 'Product publishing is in progress'], 200);
            }

            // If status is not changing to 'Published', just update the product

            return response()->json(['status' => 'success', 'data' => $draftProduct], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
}
