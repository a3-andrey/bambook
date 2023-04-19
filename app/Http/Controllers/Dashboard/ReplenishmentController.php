<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReplenishmentController extends Controller
{
    //
    public function __invoke(){
        \request()->validate([
            'date_fill' => ['required','date'],
            'summa' => ['required','numeric'],
            'hash' => ['required','string'],
        ]);

        $tr = Transaction::create(\request()->only('date_fill','summa','hash'));
        $tr->user_id = Auth::user()->id;
        $tr->save();
        session()->flash('message','Ваша заявка на пополнение отправлена');
        return redirect()->route('dashboard.message');
    }
}
