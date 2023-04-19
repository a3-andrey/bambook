<?php

namespace App\Http\Livewire;

use App\Facades\MoySklad_1_2_Facade;
use App\Models\Delivery;
use App\Services\DadataClientService;
use App\Traits\MoySklad;
use App\Traits\OrderFormRequestTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Livewire\Component;
use Cart;

class OrderFormCart extends Component
{
    use MoySklad;
    use OrderFormRequestTrait;

    public $delivery=0;
    public $order=0;
    public $firstname;
    public $lastname;
    public $phone;
    public $email;
    public $city;
    public $address;
    public $company;
    public $inn;
    public $confirmation=1;
    public $comment;
    public $organisations=[];
    public $stringOrder='';

    public function mount(){
        if(Auth::check()){
            $user = Auth::user();
            $delivery = $user->delivery;

            $this->firstname = $user->firstname;
            $this->lastname = $user->lastname;
            $this->phone = $user->phone;
            $this->email = $user->email;

            $this->city = $delivery->city;
            $this->address = $delivery->address;

            $this->company = $user->company;
            $this->inn = $delivery->inn;
        }
    }

    public function updatedDelivery(){
        $this->clearData();
    }

//    public function updatedInn($val){
//        $dadata = new DadataClientService(config('dadata.token'), config('dadata.secret'));
//        $dadata->init();
//        $fields = array("query" => "5403", "count" => 5);
//        $result = $dadata->suggest("party", $fields);
//        if(isset($result['suggestions'])){
//            $this->organisations = $result['suggestions'];
//        }
//    }

    public function updatedOrder(){
        $this->clearData();
    }

    private function clearData(){
        if(!Auth::check()){
            $this->firstname = null;
            $this->lastname= null;
            $this->phone= null;
            $this->email= null;
            $this->city= null;
            $this->address= null;
            $this->inn = null;
            $this->company = null;
            $this->dispatchBrowserEvent('clear-phone', []);
        }
    }

    public function submit(){
        //Доставка
        if($this->delivery == 0){
            //Физическое
            if($this->order == 0){
                $this->validateIndividual();
            }

            //Юр
            if($this->order==1){
                $this->validateLegal();
            }
        }
       //Самовывоз
        if($this->delivery == 1){
            //Физическое
            if($this->order == 0){
                $this->validatePickupIndividual();
            }

            //Юр
            if($this->order==1){
                $this->validatePickupLegal();
            }
        }

        $customerOrder = MoySklad_1_2_Facade::createCustomerOrder();

        if(Auth::check()){
            $email = Auth::user()->email;
        }else{
            $email = config('moy_sklad.conterparty');
        }

        $counterparty = MoySklad_1_2_Facade::searchCounterparty(
            (new \Evgeek\Moysklad\Filter())
                ->eq('email', $email)
        );
        //Не найден контрогент по умолчанию
        if(
//            Auth::guest() &&
            $counterparty === false) {
            abort(406,'Не найден контрагент');
        }

//        if(Auth::check()){
//            $counterparty = $this->updateCounterparty($counterparty->id);
//        }

        $customerOrder->setCounterparty($counterparty);

        $order = \App\Models\Order::create([
            'user_id' => Auth::check()?Auth::id():null,
            'counterparty_id' => $counterparty->id,
            'order' => [
                'name' => $this->firstname,
                'lastname' => $this->lastname,
                'phone' => $this->phone,
                'email' => $this->email,
                'city' => $this->city,
                'address' => $this->address,
                'inn' => $this->inn,
                'company' => $this->company,
                'delivery' => $this->delivery,
                'order' => $this->order,
            ],
            'hash' => rand(11111111,99999999),
            'code' =>  (string) rand(11111,99999),
            'total' => \App\Facades\CartFacade::getTotalCart(),
        ]);

        $customerOrder->name = $order->code;

        $this->addCommentNotAuth($customerOrder);

//        if(!Auth::check()){
//            $this->addCommentNotAuth($customerOrder);
//        }else{
//            $delivery = \App\Models\Order::DELIVERY[$this->delivery];
//            $customerOrder->description = "СПОСОБ ПОЛУЧЕНИЯ ЗАКАЗА: {$delivery} \nКомментарий: {$this->comment}";
//        }

        foreach (\Cart::getContent() as $item){
            Cart::update($item->id, array(
                'price_old' =>  (integer)$item->associatedModel->priceold,
                'price' => (integer)$item->associatedModel->priceTotal,
            ));
        }

        foreach (\Cart::getContent() as $item){
            $customerOrder->pushAssortment($item);
            \App\Models\Cart::create([
                'cart' => $item,
                'order_id' => $order->id,
            ]);
        }

        Mail::to($this->email)->send(new \App\Mail\Order($order));

        Mail::to(config('mails.to'))->send(new \App\Mail\Order($order));

        $customerOrder->sendOrder();

        session()->flash('message-order',"Благодарим за заказ №{$order->code}! Мы начинаем работать с ним.");

        Cart::clear();

        return redirect()->route('message');
    }

    private function addCommentNotAuth($customerOrder){
        $delivery = \App\Models\Order::DELIVERY[$this->delivery];
        $statusPayment = \App\Models\Order::STATUS_BUYER[$this->order];
        //Доставка
        if($this->delivery == 0){
            //Физ
            if($this->order == 0){
                $customerOrder->description = "СПОСОБ ПОЛУЧЕНИЯ ЗАКАЗА: {$delivery} \nСТАТУС ПЛАТЕЛЬЩИКА: {$statusPayment} \nИМЯ: {$this->firstname} \nФАМИЛИЯ: {$this->lastname} \nEMAIL: {$this->email} \nТЕЛЕФОН: {$this->phone} \nГОРОД: {$this->city} \nАДРЕС: {$this->address} \nКомментарий: {$this->comment}";
            }else{
                $customerOrder->description = "СПОСОБ ПОЛУЧЕНИЯ ЗАКАЗА: {$delivery} \nСТАТУС ПЛАТЕЛЬЩИКА: {$statusPayment} \nEMAIL: {$this->email} \nТЕЛЕФОН: {$this->phone} \nГОРОД: {$this->city} \nАДРЕС: {$this->address} \nНАЗВАНИЕ ОРГАНИЗАЦИИ: {$this->company} \nИНН: {$this->inn} \nКомментарий: {$this->comment}";

            }
        }
        //Самовывоз
        if($this->delivery == 1){
            //Физ
            if($this->order == 0){
                $customerOrder->description = "СПОСОБ ПОЛУЧЕНИЯ ЗАКАЗА: {$delivery} \nСТАТУС ПЛАТЕЛЬЩИКА: {$statusPayment} \nИМЯ: {$this->firstname} \nФАМИЛИЯ: {$this->lastname} \nEMAIL: {$this->email} \nТЕЛЕФОН: {$this->phone} \nКомментарий: {$this->comment}";
            }else{
                $customerOrder->description = "СПОСОБ ПОЛУЧЕНИЯ ЗАКАЗА: {$delivery} \nСТАТУС ПЛАТЕЛЬЩИКА: {$statusPayment} \nEMAIL: {$this->email} \nТЕЛЕФОН: {$this->phone} \nНАЗВАНИЕ ОРГАНИЗАЦИИ: {$this->company} \nИНН: {$this->inn} \nКомментарий: {$this->comment}";

            }
        }

    }

    public function render()
    {
        return view('livewire.order-form-cart');
    }
}


//
