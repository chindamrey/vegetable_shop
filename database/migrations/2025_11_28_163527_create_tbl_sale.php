<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tbl_sale', function (Blueprint $table) {
           $table->id();
            $table->unsignedBigInteger('invoice_id');
            $table->unsignedBigInteger('product_id');
            $table->decimal('weight',8,2);
            
            $table->timestamps();
            
            
            $table->foreign('product_id')->references('id')->on('tbl_product')->onDelete('cascade');
            $table->foreign('invoice_id')->references('id')->on('tbl_invoice')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_sale');
    }
};
