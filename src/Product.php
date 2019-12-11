<?php

namespace Mcpuishor\Greenberrycatalog;

use Illuminate\Database\Eloquent\Model,
	Mcpuishor\Greenberrycatalog\Variant,
	Mcpuishor\Greenberrycatalog\Category;

class Product extends Model
{
    protected $guarded =["id"];
    protected $touches = ["category"];

    public function variants()
    {
    	return $this->hasMany(Variant::class);
    }

    public function category()
    {
    	return $this->belongsTo(Category::class);
    }

    /* mutators to deal with the import of string values from Orderwise */

    public function setWebsiteAttribute($value) 
    {
        $this->attributes['website'] = ($value == "true" || $value === true) ? 1 : 0; 
    }

    public function setOwidAttribute($value)
    {
        $this->attributes["owid"] = $value ?? 0;
    }

}
