<?php

namespace Mcpuishor\GreenberryCatalog;

use Illuminate\Database\Eloquent\Model,
	Mcpuishor\GreenberryCatalog\Product,
    Mcpuishor\GreenberryCatalog\Variant;

class Category extends Model
{
	protected $fillable = ["owid", "name"];

    public function products()
    {
    	return $this->hasMany(Product::class);
    }

    public function variants()
    {
        return $this->hasManyThrough(Variants::class, Product::class);
    }

    /* mutators to deal with the import of string values from Orderwise */

    public function setOwidAttribute($value)
    {
    	$this->attributes["owid"] = $value ?? 0;
    }

    public function setNameAttribute($value)
    {
    	$this->attributes["name"] = $value ?? "";
    }

    public function setNameAttribute($value)
    {
        $this->attributes["name"] = htmlspecialchars_decode($value);

    } 

}
