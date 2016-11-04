<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests;

class UserController extends Controller
{
     public function index(){
    	$users = User::where('status','A')->get();
        return view('contactos')->with('users', $users);
    }
}
