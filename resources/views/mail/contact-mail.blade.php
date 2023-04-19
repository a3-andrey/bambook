@component('mail::message')
# Связаться с нами!

<div>
    <strong>Имя: </strong>{{ $user['name'] }}<br>
    <strong>Телефон: </strong>{{ $user['phone'] }}
</div>

Спасибо,<br>
{{ config('app.name') }}
@endcomponent
