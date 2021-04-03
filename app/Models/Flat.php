<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Flat extends Model {

	protected $table = 'flats';
    protected $guarded = ['id', 'created_at', 'updated_at'];

	public function floor()
	{
	return $this->belongsTo('App\Models\Floor', 'floor_id', 'id');
	}

	public function tenant()
	{
	return $this->belongsTo('App\Models\Tenant', 'flat_id', 'id');
	}

	public function flatowner()
	{
	return $this->belongsTo('App\Models\FlatOwner', 'flat_owner_id', 'id');
	}
}
