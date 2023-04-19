<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Chat extends Model
{
    use HasFactory;


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function messages(){
        return $this->hasMany(ChatMessage::class, 'chat_id', 'id')
            ->where('active',1);
//            ->orderBy('id','DESC');
    }

    public static function getCountNewMessage(){
        if($count = self::getNewMessage()){
            return $count->count();
        }
        return 0;
    }

    public static function getNewMessage(){
        $chat = Chat::where('user_id',Auth::user()->id)->first();
        if($chat){
            return \App\Models\ChatMessage::where('chat_id',$chat->id)
                ->where('guard','admin')
                ->where('show',0)->get();
        }
        return [];
    }
}
