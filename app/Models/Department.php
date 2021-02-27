<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $guarded = array();
	public $timestamps = false;

    public function vatatype()
    {
        return $this->hasMany('App\Models\VataType', 'department_id', 'id');
    }

    public function admin()
    {
        return $this->hasMany('App\Models\Admin', 'department_id', 'id');
    }
}
