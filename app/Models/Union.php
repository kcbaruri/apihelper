<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Union extends Model {

	protected $table = 'unions';
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
}
