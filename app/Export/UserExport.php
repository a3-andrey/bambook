<?php

namespace App\Export;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class UserExport implements FromView
{
    public function view(): View
    {
        return view('exports.users', [
            'users' => User::all()
        ]);
    }
}
