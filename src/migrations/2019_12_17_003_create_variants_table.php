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
            $table->integer('owid')->unsigned()->unique('unique_owid');
            $table->foreignId("product_id")->constrained();
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
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('variants');
    }
}
