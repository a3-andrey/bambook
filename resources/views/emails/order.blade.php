@component('mail::message')
    @php
        $orderArr = $order->order
    @endphp

# Заказ №{{ $order->code }}

# Cпособ получения заказа
<p><strong></strong>{{ \App\Models\Order::DELIVERY[$orderArr['delivery']] }}</p>

# Статус заказчика
<p><strong></strong>{{ \App\Models\Order::DELIVERY[$orderArr['order']] }}</p>

# Контактные данные
<p><strong>Имя</strong>:{{ $orderArr['name'] }}</p>
<p><strong>Фамилия</strong>: {{ $orderArr['lastname'] }}</p>
<p><strong>Телефон</strong>: {{ $orderArr['phone'] }}</p>
<p><strong>Email</strong>: {{ $orderArr['email'] }}</p>
<p><strong>Город</strong>: {{ $orderArr['city'] }}</p>
<p><strong>Адрес доставки</strong>: {{ $orderArr['address'] }}</p>
<p><strong>ИНН</strong>: {{ $orderArr['inn'] }}</p>
<p><strong>Название компании</strong>: {{ $orderArr['company'] }}</p>

@component('mail::table')
|    Картинка   | Название товара | Кол-во  | Цена | Сумма |
| ------------- |:---------------:|--------:|--------:|--------:|
@foreach($order->carts as $item)
| <img  width="100" src="{{ asset(image($item->cart['attributes']['image'])) }}"> | {{ $item->cart['name'] }} |  {{ $item->cart['quantity'] }} | {{ $item->cart['price'] }} |  {{ $item->cart['quantity']*$item->cart['price'] }}
@endforeach
# Итого:
{{ $order->total }} Р
@endcomponent
{{ config('app.name') }}
@endcomponent
