<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_details', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable();
            // $table->integer('invoice_id')->nullable();
            $table->bigInteger('invoice_id')->unsigned()->nullable();
            $table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('cascade');
            // $table->integer('category_id')->nullable();
            $table->bigInteger('category_id')->unsigned()->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            // $table->integer('product_id')->nullable();
            $table->bigInteger('product_id')->unsigned()->nullable();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->double('selling_qty')->nullable();
            $table->double('unit_price')->nullable();
            $table->double('selling_price')->nullable();
            $table->tinyInteger('status')->default(1); 
            $table->timestamps();
        });
    } 

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_details');
    }
};
