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
                            <p>Восстановление данных входа</p>
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
                        <strong style="display:block;color: green;text-align: center">{{ session('status') }}</strong>
                    @endif
                    <form method="POST" action="{{ route('password.update') }}" class="reset__form">
                        @csrf
                        <input type="hidden" name="token" value="{{ request()->route('token') }}">

                        <x-ui.input name="email" placeholder="E-mail" />

                        <x-ui.input type="password" name="password" placeholder="Пароль" />

                        <x-ui.input type="password" name="password_confirmation" placeholder=" Подтверждение пароля" />

                        <button type="submit" class="order__submit reset__submit">Отправить пароль</button>
                    </form>
                </div>
            </div>
        </div>

    </main>
</x-app-layout>

