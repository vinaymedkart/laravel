<?php

namespace App\Jobs;

use App\Models\PublishProduct;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class PublishProductJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $draftProduct;
    protected $createdBy;
    protected $moleculeNames;

    public function __construct($draftProduct, $createdBy, $moleculeNames)
    {
        $this->draftProduct = $draftProduct;
        $this->createdBy = $createdBy;
        $this->moleculeNames = $moleculeNames;
    }

    public function handle()
    {
        try {
            Log::info('Processing PublishProductJob', ['draft_product_id' => $this->draftProduct]);

            PublishProduct::create([
                'ws_code' => $this->draftProduct->ws_code,
                'name' => $this->draftProduct->name,
                'sales_price' => $this->draftProduct->sales_price,
                'mrp' => $this->draftProduct->mrp,
                'manufacturer_name' => $this->draftProduct->manufacturer_name,
                'is_banned' => $this->draftProduct->is_banned,
                'is_active' => $this->draftProduct->is_active,
                'is_discontinued' => $this->draftProduct->is_discontinued,
                'is_assured' => $this->draftProduct->is_assured,
                'is_refridged' => $this->draftProduct->is_refridged,
                'category_id' => $this->draftProduct->category_id,
                'combination' => json_encode($this->moleculeNames), 
                'created_by' => $this->createdBy,
            ]);

            Log::info('PublishProduct created successfully');

        } catch (\Exception $e) {
            Log::error('Error in PublishProductJob', ['error' => $e->getMessage()]);
        }
    }
}
