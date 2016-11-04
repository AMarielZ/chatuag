<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime;
use Carbon\Carbon;
use App\Chat;
use App\Message;
use App\User;
use App\Http\Requests;

class MessageController extends Controller
{
    public function store(Request $request, $id)
    {
        //$fecha=Carbon::now();
        $user = Auth()->user();
        $chat1 = User::findOrFail($id)->user1chats()->where('user2', $user->id)->with('messages')->get();

        $chat2 = User::findOrFail($id)->user2chats()->where('user1', $user->id)->with('messages')->get();
        $chat = $chat1->merge($chat2);
        $chat = $chat->first();

        if(!$chat){
            $chat = new Chat;
            $chat->user1 = $user->id;
            $chat->user2 = $id;
            $chat->save();
        }
       
        $message = new Message;
        $message->chat_id =$chat->id;
        $message->user_id = $user->id;
        $message->message= $request->mensaje;
        //$respuesta->fechaHora=$fecha->toDateTimeString();
    
        $message->save();

        return redirect()->back();
    }
}
