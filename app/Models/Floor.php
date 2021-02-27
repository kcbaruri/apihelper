<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Floor extends Model
{
    protected $guarded = array();
	public $timestamps = false;

    public function flat()
    {
        return $this->hasMany('App\Models\Flat', 'floor_id', 'id');
    }
}
