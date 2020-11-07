<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVariantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('variants', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('owid')->unique('unique_owid');
            $table->foreignId('product_id')->constrained("products");
            $table->string('code', 50);
            $table->string('description')->nullable();
            $table->unsignedInteger('rsp')->nullable();
            $table->string('abbreviation')->nullable();
            $table->unsignedInteger('freestock')->nullable();
            $table->unsignedInteger('special_offer')->nullable();
            $table->unsignedInteger('weight')->nullable();
            $table->float('vat_rate')->nullable();
            $table->string('vat_code', 10)->nullable();
            $table->boolean('website')->nullable()->default(true);
            $table->boolean('trade')->nullable()->default(true);
            $table->boolean('discontinued')->nullable();
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
        Schema::table('variants', function(Blueprint $table)
        {
            $table->dropForeign('variants_belongto_products');
        });
        
        Schema::dropIfExists('variants');
    }
}
