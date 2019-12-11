<?php

namespace Mcpuishor\Greenberrycatalog;

use Illuminate\Database\Eloquent\Model,
	Mcpuishor\Greenberrycatalog\Product;

class Variant extends Model
{

	protected $guarded = [
		"id"
	];

	protected $touches = ["product"];

	public function product()
	{
		return $this->belongsTo(Product::class);
	}


	/* mutators to deal with the import of string values from Orderwise */

	public function setWebsiteAttribute($value) 
	{
		$this->attributes['website'] = ($value == "true" || $value === true) ? 1 : 0; 
	}

	public function setTradeAttribute($value) 
	{
		 $this->attributes["trade"] = ($value == "true" || $value === true) ? 1 : 0;
	}

    public function setOwidAttribute($value)
    {
    	$this->attributes["owid"] = $value ?? 0;
    }


	public function setDiscontinuedAttribute($value) 
	{
		$this->attributes["discontinued"] = ($value===true || $value == "true") ? 1 : 0;
		$this->attributes["website"] = ($value===true || $value == "true") ? 0 : 1 ;
	}

	public function setFreestockAttribute($value)
	{
		$this->attributes["freestock"] = intval($value) > 0 ?  intval($value) : 0;
	}

	public function setRspAttribute($value)
	{
		 $this->attributes["rsp"] = round($value, 2);
	}

	public function setWeightAttribute($value)
	{
		 $this->attributes["weight"] = round($value, 2);
	}

	public function setVatRateAttribute($value)
	{
		 $this->attributes["vat_rate"] = intval($value);
	}

	public function setSpecialOfferAttribute($value)
	{
		 $this->attributes["special_offer"] = intval($value);
	}

	/* accessors for display */

	public function getRspAttribute($value)
	{
		return number_format($value,2);
	}


    public function scopeStocked($query)
    {
    	return $query->where('freestock', ">", 0);
    }

    public function scopeFuzzySearch($query, $field, $needle, $tradeable=1, $stocked=1)
    {
    	$query = $query->where($field, "like", "%".request("q")."%");
    	$query = ($tradeable ? $query->tradeable() : $query);
    	$query = ($stocked ? $query->stocked() : $query);

		return $query;	 
    }

}
