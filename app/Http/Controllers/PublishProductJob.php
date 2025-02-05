<?php
namespace App\Jobs;

use App\Models\PublishProduct;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PublishProductJob implements ShouldQueue {
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $product;
    protected $userId;

    public function __construct($product, $userId) {
        $this->product = $product;
        $this->userId = $userId;
    }

    public function handle() {
        PublishProduct::create([
            'ws_code' => $this->product->ws_code,
            'name' => $this->product->name,
            'sales_price' => $this->product->sales_price,
            'mrp' => $this->product->mrp,
            'manufacturer_name' => $this->product->manufacturer_name,
            'combination' => $this->product->combination,
            'created_by' => $this->userId,
            'updated_by' => $this->userId,
            'category_id' => $this->product->category_id,
        ]);
    }
}
