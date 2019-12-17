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
            $table->engine = "InnoDB";
            $table->charset = "utf8";
            $table->collation = "utf8_unicode_ci";
            $table->increments('id');
            $table->integer('owid')->unsigned()->unique('unique_owid');
            $table->string('code', 50);
            $table->integer('category_id')->unsigned()->index('category_id');
            $table->string('description', 255)->nullable();
            $table->boolean('website')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('products', function(Blueprint $table)
        {
            $table->foreign('category_id', 'product_belognsto_category')->references('id')
                    ->on('categories')
                    ->onUpdate('CASCADE')
                    ->onDelete('RESTRICT');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('products', function(Blueprint $table)
        {
            $table->dropForeign('product_belognsto_category');
        });
        
        Schema::drop('products');
    }
}
