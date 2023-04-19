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
                            <a href="/cart">Корзина</a>
                        </li>
                        <li class="breadcrumbs-item">
                            <p>Оформление заказа</p>
                        </li>
                    </ul>
                    <h1 class="page-name">Оформление заказа</h1>
                </div>
            </div>
        </div>
        <div class="order-wrapper">
            <div class="container">
                <livewire:order-form-cart/>
            </div>
        </div>
    </main>
</x-app-layout>
