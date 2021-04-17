<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model {

	protected $table = 'tenants';

	//protected $fillable = ['is_master'];
   protected $guarded = ['id', 'created_at', 'updated_at'];

     public function floor()
	{
	return $this->belongsTo('App\Models\Floor', 'floor_id', 'id');
	}

	public function flat()
	{
	return $this->belongsTo('App\Models\Flat', 'flat_id', 'id');
	}

	public function children()
	{
		return $this->hasMany(Tenant::class, 'id');
	}

	public function parent()
	{
		return $this->belongsTo(Tenant::class, 'id');
	}
}
