<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReferralSystemController extends Controller
{
    //
    public function __invoke()
    {
        $user = \Illuminate\Support\Facades\Auth::user();
        if(empty($user->referral_token)){
            $user->createReferralToken();
        }
        return view('pages.dashboard.referral-system',['user'=>$user]);
    }
}
