<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('publish_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ws_code')->unique();
            $table->string('name');
            $table->float('sales_price');
            $table->float('mrp');
            $table->string('manufacturer_name');
            $table->boolean('is_banned')->default(false);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_discontinued')->default(false);
            $table->boolean('is_assured')->default(false);
            $table->boolean('is_refridged')->default(false);
            $table->unsignedBigInteger('category_id');
            $table->json('combination'); // Stores array of molecule names
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    public function down() {
        Schema::dropIfExists('publish_products');
    }
};
