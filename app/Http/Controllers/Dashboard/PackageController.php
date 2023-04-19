<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PackageController extends Controller
{
    //
    public function __invoke(){
        $package = \request('package');
        $user = Auth::user();
        $user->package = $package;
        $user->save();

        return redirect()->back();
    }
}
