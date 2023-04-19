<?php

namespace App\Http\Livewire;

use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class OutputMoney extends Component
{
    public $user,$summa,$type_wallet,$wallet,$summa_available;

    public function submit()
    {
        $this->validate([
            'summa' => ['required'],
            'type_wallet' => 'required',
            'wallet' => 'required',
        ]);

       Transaction::create([
            'summa' => $this->summa,
            'type_wallet' => $this->type_wallet,
            'wallet' => $this->wallet,
            'user_id' => $this->user->id,
       ]);

        $this->reset(['summa', 'type_wallet','wallet']);

        $this->dispatchBrowserEvent('message', [
            'title' => 'Успешно',
            'content' => 'Заявка на вывод средств успешно отправлена',
        ]);
    }

    public function mount(){
        $this->user = Auth::user();
        $this->summa_available = \Illuminate\Support\Arr::get($this->user->profile,'balance')??0;
    }

    public function render()
    {
        return view('livewire.output-money');
    }
}
