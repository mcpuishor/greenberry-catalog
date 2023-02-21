<?php

namespace Mcpuishor\Greenberrycatalog;

use Mcpuishor\Greenberrycatalog\Category;

use Illuminate\Database\Eloquent\Model,
	Illuminate\Database\Eloquent\Relations\HasMany,
	Illuminate\Database\Eloquent\Relations\HasManyThrough,
	Illuminate\Database\Eloquent\Relations\BelongsTo,
	Mcpuishor\Greenberrycatalog\Product,
    Mcpuishor\Greenberrycatalog\Variant;

class Category extends Model
{
	protected $fillable = ["owid", "name"];

    public function products() : HasMany
    {
    	return $this->hasMany(Product::class);
    }

    public function variants() : HasManyThrough
    {
        return $this->hasManyThrough(Variant::class, Product::class);
    }

    public function parent() : BelongsTo
    {
        return $this->belongsTo(__CLASS__, "parent_id", "id");
    }

    public function children() : HasMany
    {
        return $this->hasMany(__CLASS__, "parent_id", "id");
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
