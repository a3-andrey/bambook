<?php

namespace App\Http\Controllers\Auth;

use App\Facades\MoySklad_1_2_Facade;
use App\Facades\MoySkladOrderFacade;
use App\Http\Controllers\Controller;
use App\Models\Delivery;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {

        $referral = User::where('referral_token',\request('referral'))->first();

        return view('auth.register',['referral'=>$referral]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
      $data = $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:5255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'confirmation' => ['required'],
        ]);

        //        Ищем Контрагента
        $counterparty = MoySklad_1_2_Facade::searchCounterparty(
            (new \Evgeek\Moysklad\Filter())
            ->eq('email', $data['email'])
        );

        if($counterparty === false)
        {
            $counterparty = MoySklad_1_2_Facade::createCounterparty([
                'companyType' => 'individual',
                'name' => $data['lastname'].' '.mb_substr($data['firstname'], 0,1).'.',
                'description' => 'Создан при регистрации на сайте '.url('/'),
                'legalFirstName' => $data['firstname'],
                'legalLastName' => $data['lastname'],
                'legalAddress' => $data['country'].', '.$data['city'].', '.$data['address'],
                'email' => $data['email'],
                'phone' => $data['phone'],
            ]);
        }

        $user = User::create([
            'external_id' => $counterparty->id,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'patronymic' => $request->patronymic,
            'phone' => $request->phone,
            'email' => $request->email,
            'company' => $request->company,
            'password' => Hash::make($request->password),
        ]);

        Delivery::create([
            'user_id' => $user->id,
            'country' => $request->country,
            'city' => $request->city,
            'address' => $request->address,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
