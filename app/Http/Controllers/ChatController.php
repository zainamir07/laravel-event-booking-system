<?php

namespace App\Http\Controllers;

use App\Custom;
use App\Models\Chat;
use App\Models\Users;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    
   public function allmessages(){
    return view('messages');
   }

   public function chat_box($id){
    $reciever_id = Users::where('id', '=', $id)->first();
    $sender_id = session()->get('user_id');
    $sender = Chat::orderBy('chat_id', 'asc')->where('sender_id', '=', $sender_id)->get();
    $reciever = Chat::orderBy('chat_id', 'asc')->where('sender_id', '=', $reciever_id->id)->get();
    $data = compact('reciever_id', 'reciever', 'sender');
    return view('chatBox')->with($data);
   }

   public function send_message(Request $request){
       
    $chat = new Chat;
    $chat->reciever_id = $request['reciever'];
    $chat->sender_id = $request['sender'];
    $chat->message = $request['message'];
    $chat->save();
    if($chat){
        return response()->json(['success', 'Success']);
    }else{
        return response()->json(['errors', 'Something Went Worng']);
    }
   }

   public function fetch_out_message(Request $request){
        // return response()->json(['Done']);
        //Agr session id equal to sender_id this mean this is 'ou'
        //Agre session_id equal to  reciever_id thi means its 'in'
    $sender = $request['sender'];
    $reciever = $request['reciever'];
    $chat = Chat::where('sender_id', '=', $sender)->latest()->first();
    // if($chat->sender_id == $sender){
    //     return response()->json(['sender'=> 'Ye sender h']);
    // }elseif($chat->sender_id == $reciever){
    //     return response()->json(['receiver'=> 'Ye receiver h']);
    // }
    $sender = Custom::authorName($chat->sender_id);
    $senderImage = Custom::userImagePath($chat->sender_id);
    if($chat){
        return response()->json([
            'chat' => $chat,
            'sender' => $sender,
            'senderImage'  => $senderImage
        ]);
    }else{
        return response()->json(['errors'=> 'Something Went Worng']);
    }
   }

   public function fetch_in_message(Request $request){
    // return response()->json(['Done']);

    $reciever_id = $request['reciever'];
    $chat = Chat::where('reciever_id', '=', $reciever_id)->latest()->first();
    $reciever = Custom::authorName($chat->reciever_id);
    $recieverImage = Custom::userImagePath($chat->reciever_id);
    if($chat){
        return response()->json([
            'chat' => $chat,
            'reciever' => $reciever,
            'recieverImage'  => $recieverImage
        ]);
    }else{
        return response()->json(['errors'=> 'Something Went Worng']);
    }
    }

   

}
