<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Vatahandover extends Model {

	protected $table = 'vata_handovers';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function citizen()
	{
	return $this->belongsTo(Citizen::class, 'citizen_id');
	}
}
