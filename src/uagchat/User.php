<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

   /* public function user1chats(){
        return $this->hasMany('App\Chat', 'user1');
    }
     public function chats(){
        return $this->hasMany('App\Chat', 'user1')->orWhere('user2', $this->id);
    }
    */
    public function messages(){
        return $this->hasMany('App\Message');
    }

    public function contacts(){
        return $this->hasMany('App\Contact','user');
    }

    public function user1chats() {
        return $this->hasMany('App\Chat', 'user1');
    }

    public function user2chats() {
        return $this->hasMany('App\Chat', 'user2');
    }

    public function allChats() {
        return $this->user1chats->merge($this->user2chats);
    }
}

