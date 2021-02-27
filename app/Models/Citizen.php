<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Citizen extends Model {

	protected $table = 'citizens';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function vatatype()
	{
	return $this->belongsTo('App\Models\Vatatype', 'vata_type_id', 'id');
	}

	public function union()
	{
	return $this->belongsTo('App\Models\Union', 'union_id', 'id');
	}

	public function village()
	{
	return $this->belongsTo('App\Models\Village', 'village_id', 'id');
	}

	public function division()
	{
	return $this->belongsTo('App\Models\Division', 'division_id', 'id');
	}

	public function district()
	{
	return $this->belongsTo('App\Models\District', 'district_id', 'id');
	}

	public function thana()
	{
	return $this->belongsTo('App\Models\Thana', 'thana_id', 'id');
	}

	public function vatahandover()
	{
	return $this->hasMany('App\Models\Vatahandover', 'citizen_id', 'id');
	}
}
