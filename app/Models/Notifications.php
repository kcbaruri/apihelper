<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Notifications extends Model {

	protected $guarded = array();
	public $timestamps = false;

	public function user() {
        return $this->belongsTo(User::class,'author','id');
    }

	public static function send( $destination, $author, $destination_type, $title, $body ){

		$noty = new Notifications;

		$noty->destination = $destination;
		$noty->author = $author;
		$noty->destination_type = $destination_type;
		$noty->notification_title = $title;
		$noty->notification_body = $body;
		$noty->save();

	}

}
