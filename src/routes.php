<?php

/* add specific routes for the greenberry package loader */

Route::group(['prefix' => "catalog", 'middleware' => 'api'], function(){
	Route::resource("/product", "\Mcpuishor\Greenberrycatalog\Controllers\ProductController");
});