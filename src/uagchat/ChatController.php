<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Chat;
use App\Contact;
use Auth;
use App\Message;
use App\Http\Requests;

class ChatController extends Controller
{
    public function index(){
    	//$chats = Chat::where('status','A')->where('id',1)->get();  
        $chats=$user->chats();
         return view('contactos')->with('chats', $chats);
    }

    public function viewChat($id = null){
         $user = Auth::user();
        if($id == $user->id){
            return redirect()->back();
        }
    	$chat = null;
       
    	if($id){
    	//$chat = Chat::with('messages')->where('id',$id)->where('receiving_user_id',1)->first();
       // $chat = User::findOrFail($id)->chats()->where('user1', $user->id)->with('messages')->first();
        $users = User::where('id', '!=', $user->id)->get();

        $contacts = Contact::where('main_user_id', $user->id)->with('user_')->get();

        $chat_user = User::findOrFail($id);

        $chat1 = User::findOrFail($id)->user1chats()->where('user2', $user->id)->with('messages')->get();
        $chat2 = User::findOrFail($id)->user2chats()->where('user1', $user->id)->with('messages')->get();

        $chat = $chat1->merge($chat2);
        $chat = $chat->first();
    	}
    	

        if(!$chat){
            $chatN = new Chat;
            $chatN->user1 = $user->id;
            $chatN->user2 = $id;
            $chatN->save();  

            //$chat = User::findOrFail($id)->chats()->where('user1', $user->id)->orWhere('user2',$user->id)->with('messages')->first();
            $chat1 = User::findOrFail($id)->user1chats()->where('user2', $user->id)->with('messages')->first();
            $chat2 = User::findOrFail($id)->user2chats()->where('user1', $user->id)->with('messages')->first();
            
            $chat = $chat1->merge($chat2);
            $chat = $chat->first();
        }

    	return view('menu')->with('contacts', $contacts)->with('chat', $chat)->with('users',$users)->with('user',$user)->with('chat_user',$chat_user);
    }

    /*public function addToChat(Request $request, $id){
        $user = $request->get('user');
        $now = new DateTime('America/Mexico_City');
        $fecha=Carbon::now();
        $user = Auth()->user();
        $chat = Chat::where('idchat', $user->user_chat)->first();
        $user = User::where('iduser', $id)->first();

        $message = new Message;
        $message->idchat=$chat->idchat;
        $message->iduser=1;
        $message->message=$request->mensaje;
        $respuesta->fechaHora=$fecha->toDateTimeString();
        $message->datetime=$now;
        
        $message->save();
        
        return redirect()->back();

    }*/
    
    	
    
}
