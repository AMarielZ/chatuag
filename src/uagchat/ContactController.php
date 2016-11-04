<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Contact_User;
use App\Http\Requests;

class ContactController extends Controller
{
    public function addContact($id){
    	//$fecha=Carbon::now();
       // $user = Auth()->user();

        $user = User::where('id', $id)->first();
        $userL = Auth::user();
        $contact = new Contact_User;
        $contact->main_user_id =$userL->id;
        $contact->user = $user->id;
       
        
        $contact->save();

        return redirect()->route('contactos', ['id' => $id]);
    }
}
