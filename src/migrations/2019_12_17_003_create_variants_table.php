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
            $table->engine = "InnoDB";
            $table->charset = "utf8";
            $table->collation = "utf8_unicode_ci";
            $table->increments('id');
            $table->integer('owid')->unsigned()->unique('unique_owid');
            $table->integer('product_id')->unsigned()->index('product_id');
            $table->string('code', 50);
            $table->string('description', 255)->nullable();
            $table->decimal('rsp', 10, 2)->unsigned();
            $table->string('abbreviation')->nullable();
            $table->integer('freestock')->unsigned()->nullable();
            $table->decimal('special_offer', 10, 2)->unsigned()->nullable();
            $table->decimal('weight', 10, 2)->unsigned()->nullable();
            $table->decimal('vat_rate', 10, 0)->nullable();
            $table->string('vat_code', 10)->nullable();
            $table->boolean('website')->nullable()->default(1);
            $table->boolean('trade')->nullable()->default(1);
            $table->boolean('discontinued')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('variants', function(Blueprint $table)
        {
            $table->foreign('product_id', 'variants_belongto_products')->references('id')
                    ->on('products')
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
        Schema::table('variants', function(Blueprint $table)
        {
            $table->dropForeign('variants_belongto_products');
        });
        
        Schema::dropIfExists('variants');
    }
}
