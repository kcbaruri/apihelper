<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FlatOwner extends Model {

    protected $table = 'flat_owners';

    protected $guarded = ['id', 'created_at', 'updated_at'];
   

    public function flats()
	{
        return $this->hasMany('App\Models\Flat', 'flatowner_id', 'id');
	}
}
