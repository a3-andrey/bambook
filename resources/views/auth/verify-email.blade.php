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
                            <p>Подтверждение Email</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="auth-wrapper">
            <div class="container">
                <div style="justify-content: center" class="auth__inner">
                    <div class="auth__left">
                        <h3 class="auth__title">Авторизация</h3>
                        <div style="margin-top: 20px;">
                            Спасибо, что зарегистрировались! Прежде чем приступить к работе, не могли бы вы подтвердить свой адрес электронной почты, перейдя по ссылке, которую мы только что отправили вам по электронной почте? Если вы не получили электронное письмо, мы с радостью отправим вам другое.                        </div>
                        @if (session('status') == 'verification-link-sent')
                            <div style="    margin-top: 30px;
    margin-bottom: 30px;
    color: green;" class="mb-4 font-medium text-sm text-green-600">
                                Новая ссылка для подтверждения была отправлена на адрес электронной почты, который вы указали при регистрации.
                            </div>
                        @endif
                        <div style="display: flex;justify-content: center">
                            <form style="margin-right: 50px;" method="POST" action="{{ route('verification.send') }}">
                                @csrf
                                <button class="button">
                                    отправить повторное подтверждение
                                </button>
                            </form>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <button class="button">
                                    Выход
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
</x-app-layout>
