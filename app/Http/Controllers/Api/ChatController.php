<?php

namespace App\Http\Controllers\Api;

use App\Events\Message;
use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{

    public function send_message(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:255',
            'to_user_id' => ['required','exists:users,id'],
        ],[
            'message.required' => 'لابد من أدخال الرساله المراد أرسالها',
            'message.max' => 'لابد من ان تكون الرساله المراد أرسالها لا تزيد عدد حروفها عن 255 حرفا',
            'to_user_id.required' => 'لابد من أدخال الشخص المرسل اليه الرساله',
            'to_user_id.exists' => 'لابد أن يكون الشخص المرسل اليه الرساله مسجل فى التطبيق',
        ]);

        $from_user_id = Auth::guard('sanctum')->user()->id;   //id of auth user
        $to_user_id = $request->to_user_id;                   // user receive message

        if (Room::where(['from_user_id' => $from_user_id, 'to_user_id' => $to_user_id])->count() === 0
            && Room::where(['from_user_id' => $to_user_id, 'to_user_id' => $from_user_id])->count() === 0) {
                Room::updateOrCreate([
                        'from_user_id' => $from_user_id,
                        'to_user_id' => $to_user_id
            ]);
        }


            $chat = Chat::create([
            'from_user_id' => $from_user_id,
            'message' => $request->message,
            'room_id' => Room::where(['from_user_id' => $from_user_id, 'to_user_id' => $to_user_id])->first()?->id ??
            Room::where(['from_user_id' => $to_user_id, 'to_user_id' => $from_user_id])->first()?->id ,
            'to_user_id' => $to_user_id
        ]);


        return response()->json([
            'message' => 'لقد تم أرسال رسالتك بنجاح' ,
            'chat' => $chat->load('user_sent_message', 'user_receive_message' ,'room') ,
        ] , 200);
    }


// get all rooms --message sent from or to auth user;
    public function userRooms()
    {
        $room = Room::where("to_user_id", Auth::guard('sanctum')->user()->id)
                            ->withWhereHas('chats',function($q){
                                $q->select('id','from_user_id', 'to_user_id');
                            })->with('user_receive_message:id,first_name,last_name,profile_image' , 'user_sent_message:id,first_name,last_name,profile_image')->latest()->get();

        return response()->json([
            'rooms' => $room->load('chats')
        ] , 200);

    }



    public function chatsInRoom($to_user_id)
    {
        $chats = Chat::where(['from_user_id' => Auth::guard('sanctum')->user()->id  , 'to_user_id' => $to_user_id])
        ->orwhere(
            function($query)  use ($to_user_id) {
                return $query
                    ->where(['from_user_id' => $to_user_id ])
                    ->where(['to_user_id' => Auth::guard('sanctum')->user()->id]);
            })->get();

        return response()->json([
            'chats' => $chats->load('user_receive_message:id,first_name,last_name,profile_image' , 'user_sent_message:id,first_name,last_name,profile_image')
        ] , 200);

    }


}
