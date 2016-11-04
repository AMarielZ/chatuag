<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Chat extends Model
{
   protected $table = "chat_user";

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function chat(){
    	return $this->belongsTo('App\Chat');
    }

     public function userS(){
        return $this->hasMany('App\User');
    }

}
