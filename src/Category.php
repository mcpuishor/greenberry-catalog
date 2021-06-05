<?php

namespace Mcpuishor\Greenberrycatalog;

use Mcpuishor\Greenberrycatalog\Category;

use Illuminate\Database\Eloquent\Model,
	Mcpuishor\Greenberrycatalog\Product,
    Mcpuishor\Greenberrycatalog\Variant;

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

    public function parent() {
        return $this->belongsTo(Category::class, "parent_id", "id");
    }

    public function children() {
        return $this->hasMany(Category::class, "parent_id", "id");
    }

    /* mutators to deal with the import of string values from Orderwise */

    public function setOwidAttribute($value)
    {
    	$this->attributes["owid"] = $value ?? 0;
    }

    public function setNameAttribute($value)
    {
        $this->attributes["name"] = htmlspecialchars_decode($value) ?? '';

    } 

}
