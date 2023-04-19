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
                            <p>Авторизация</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="auth-wrapper">
            <div class="container">
                <div class="auth__inner">
                    <div class="auth__left">
                        <h3 class="auth__title">Авторизация</h3>
                        <div style="margin-top: 20px;">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                        <form action="{{ route('login') }}" method="POST" class="auth__form">
                            @csrf
                            <!-- Ошибка - error на label__input -->
                            <!-- Правильно - success на label__input -->
                            <x-ui.input name="email" placeholder="E-mail" />
                            <x-ui.input type="password" name="password" placeholder="Пароль" />
                            <button type="submit" class="order__submit auth__button">Войти</button>
                        </form>
                        <div class="auth__button-wrapper">
                            <a href="{{ route('password.request') }}" class="auth__link">Забыл пароль</a>
                        </div>

                    </div>
                    <hr class="auth__hr">
                    <div class="auth__right">
                        <h3 class="auth__title">Регистарция</h3>
                        <p class="auth__description">Регистрация личного кабинета позволит вам совершаться оптовые закупки, пользоваться скидками для оптовиков и отслеживать статус вашего заказа.</p>
                        <div class="auth__button-wrapper">
                            <a href="{{ route('register') }}" class="auth__button-link">Зарегистрироваться</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
</x-app-layout>
