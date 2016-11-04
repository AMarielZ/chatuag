<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contacts_user';

    public function user_(){
    	return $this->belongsTo('App\User','user');
    }
}
