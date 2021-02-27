<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Village extends Model {

	protected $table = 'villages';
    protected $guarded = ['id', 'created_at', 'updated_at'];

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

	public function union()
	{
	return $this->belongsTo('App\Models\Union', 'union_id', 'id');
	}
}
