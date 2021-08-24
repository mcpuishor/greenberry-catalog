<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function(Blueprint $table)
        {
            $table->id();
            $table->unsignedInteger('owid')->unique('unique_owid');
            $table->string('code', 50);
             $table->string('name', 255);
            $table->longText('description')->nullable();
            $table->boolean('website')->nullable();
            $table->foreignId('category_id')->constrained()->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {   
        Schema::drop('products');
    }
}
