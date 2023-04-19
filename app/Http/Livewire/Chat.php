<?php

namespace App\Http\Livewire;

use App\Models\ChatMessage;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Chat as ChatModel;

class Chat extends Component
{
    public $chat;
    public $user;
    public $message;

    public function mount(){
        $this->message = null;
        $this->user = Auth::user();
        $this->chat = $this->user->chat;
        if(!$this->chat){
            $chat = new ChatModel();
            $chat->user_id = $this->user->id;
            $chat->save();
            $this->chat = $chat;
        }
        $this->storeNewMessage();
    }

    private function storeNewMessage()
    {
        $newMessages = \App\Models\Chat::getNewMessage();
        if(count($newMessages)>0){
           foreach ($newMessages as $newMessage){
               $newMessage->update([
                   'show' => 1
               ]);
           }
        }
    }

    public function submit(){
        if($this->message){
            $ch = ChatMessage::create([
                'chat_id' => $this->chat->id,
                'guard' => ChatMessage::GUARD['web']['name'],
                'message' =>  $this->message,
                'user_id' => $this->user->id,
            ]);
        }else{
            $this->addError('message', 'Напишите сообщение');
        }
        $this->mount();
        $this->dispatchBrowserEvent('endScrollChat', []);
    }

    public function render()
    {
        return view('livewire.chat',[
            'messages' => ChatMessage::where('chat_id',$this->chat->id)
                ->where('active',1)
                ->get(),
            ]);
    }
}
