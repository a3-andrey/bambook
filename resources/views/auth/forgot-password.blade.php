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
                            <p>Личный кабинет</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="reset-wrapper">
            <div class="container">
                <div class="reset__inner">
                    <h3 class="reset__title">Восстановление пароля</h3>
                    @if(session('status'))
                        <strong style="display: block; color: green;text-align: center">{{ session('status') }}</strong>
                    @endif
                    <form method="POST" action="{{ route('password.email') }}" class="reset__form">
                        @csrf
                        <x-ui.input name="email" placeholder="E-mail" />
                        <button type="submit" class="order__submit reset__submit">Отправить пароль</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
</x-app-layout>


