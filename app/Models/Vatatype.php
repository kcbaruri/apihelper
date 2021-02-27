<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vatatype extends Model {

	protected $table = 'vata_types';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function department()
	{
	 return $this->belongsTo('App\Models\Department', 'department_id', 'id');
	}
}
