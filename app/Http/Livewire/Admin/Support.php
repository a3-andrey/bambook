<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Database\Eloquent\Builder;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Support extends Component
{
    public $user;
    public $message;
    public $messages=[];

    public function mount(){
        $this->user = Auth::user();
    }

    public function selectUser(User $user){
        $this->user = $user;
        $this->setMessages();
        $this->viewed();
    }

    public function viewed(){

        $this->user->messages()->update([
            'is_show'=>1,
        ]);
        $this->dispatchBrowserEvent('skroll', []);
    }

    private function setMessages(){
        $this->messages = $this->user->messages;
    }

    public function sendMessage(){

//        $this->validate([
//            'message' => 'required',
//        ]);


        $this->user->messages()->create([
            'message'=>$this->message,
            'guard' => 'admin'
        ]);

        $this->message = null;

//        $this->setMessages();
//        $this->updateMessages();
    }

    public function render()
    {
        $users = User::all();



        return view('livewire.admin.support',[
            'users'=>$users
        ]);
    }
}
