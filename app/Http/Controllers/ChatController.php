<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ChatRoom;
use App\ChatRoomUser;
use App\ChatMessage;
use App\ChatUser;
Use App\Events\ChatPusher;
use Auth;

class ChatController extends Controller
{
    public static function show(Request $request)
    {
        $matching_user_id = $request->user_id;

        // 自分の持っているチャットルームを取得
        $current_user_chat_rooms = ChatRoomUser::where(
            'user_id', Auth::id())->pluck('chat_room_id');
        
        // 自分の持っているチャットルームからチャット相手のいるルームを探す
        $chat_room_id = ChatRoomUser::whereIn('chat_room_id', $current_user_chat_rooms)
            ->where('user_id', $matching_user_id)
            ->pluck('chat_room_id');

        if($chat_room_id->isRmpty()){

            ChatRoom::create();

            $latest_chat_room = ChatRoom::orderBy('created_at', 'desc')->first();
            $chat_room_id = $latest_chat_room->id;

            ChatRoomUser::create(
                ['chat_room_id' => $chat_room_id,
                'user_id' => Auth::id()]);

            ChatRoomUser::create(
                ['chat_room_id' => $chat_room_id,
                'user_id' => $matching_user_id]);
        }

        // 変数がオブジェクトかどうか判断して数値に変換
        if(is_object($chat_room_id)){
            $chat_room_id = $chat_room_id->first();
        }

        // チャット相手のユーザー情報を取得。なかったら例外を吐く
        $chat_room_user = User::findOrFail($matching_user_id);

        $chat_room_user_name = $chat_room_user->name;

        $chat_message = ChatMessage::where('chat_room_id', $chat_room_id)
            ->orderby('created_at')
            ->get();

        return view('chat.show')-with([
            'chat_room_id' => $chat_room_id,
            'chat_room_user' => $chat_room_user,
            'chat_message' => $chat_message,
            'chat_room_user_name' => $chat_room_user_name
        ]);
    }
}
