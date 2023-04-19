<x-app-layout>
<main class="home-main order">
    <div class="cart-wrapper">
        <div class="container order">
            <div class="breadcrumbs">
                <ul class="breadcrumbs-list">
                    <li class="breadcrumbs-item">
                        <a href="/">Главная</a>
                    </li>
                    <li class="breadcrumbs-item">
                        <p>Сообщение</p>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="thanks-wrapper">
        <div class="container">
            <div class="thanks__inner">

                <p class="thanks__text">{{ session('message-order') }}</p>
{{--                <a href="" class="thanks__link">Войти</a>--}}
            </div>
        </div>
    </div>

</main>
</x-app-layout>
