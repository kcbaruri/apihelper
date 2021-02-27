<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model {

	protected $table = 'districts';
    protected $guarded = ['id', 'created_at', 'updated_at'];

	public function division()
	{
	return $this->belongsTo('App\Models\Division', 'division_id', 'id');
	}

	public function thana()
	{
	return $this->hasMany('App\Models\Thana', 'district_id', 'id');
	}
}
