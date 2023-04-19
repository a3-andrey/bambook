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
                            <p>Регистрация</p>
                        </li>
                    </ul>
                    <h1 class="page-name">Регистрация</h1>
                </div>
            </div>
        </div>

        <div class="reg-wrapper">
            <div class="container">
                <div class="reg__inner">
                    <form action="{{ route('register.store') }}" method="POST" class="reg__form">
                        @csrf
                        <div class="reg__block">
                            <h3 class="reg__title">Персональные данные:</h3>
                            <div class="reg__block-content">
                                <x-ui.input name="lastname" placeholder="Фамилия"  />

                                <x-ui.input name="firstname" placeholder="Имя" />

                                <x-ui.input name="patronymic" placeholder="Отчество" :required="false" />

                                <x-ui.input name="email" placeholder="E-mail" />

                                <x-ui.input type="tel" name="phone" placeholder="Номер телефона" />

                                <x-ui.input name="company" placeholder="Название организации" :required="false"  />

                            </div>
                        </div>
                        <hr class="reg__hr">
                        <div class="reg__block">
                            <h3 class="reg__title">Адрес доставки:</h3>
                            <div class="reg__block-content">
                                <x-ui.input name="country" placeholder="Страна" />

                                <x-ui.input name="city" placeholder="Город" />

                                <x-ui.input name="address" placeholder="Адрес" add="full" />

                            </div>
                        </div>
                        <hr class="reg__hr">
                        <div class="reg__block">
                            <h3 class="reg__title">Пароль:</h3>
                            <div class="reg__block-content">
                                <x-ui.input type="password" name="password" placeholder="Введите пароль" />

                                <x-ui.input type="password" name="password_confirmation" placeholder="Повторите пароль" />

                            </div>
                        </div>
                        <div class="reg__capcha">
                            <img src="assets/Bitmap.png" alt="" class="reg__capcha-img">
                        </div>
                        <div class="order__checkboxLine-line">
                            <div class="label-block">
                                <input  required type="checkbox" id="confirmation" name="confirmation" checked>
                                <label class="order__polit" for="confirmation">
                                    <p>Согласен с <a class="polit__underline" href="{{ route('polit') }}">политикой конфиденциальности</a></p>
                                    @error('confirmation') <p class="label__error">{{ $message }}</p>@enderror
                                </label>
                            </div>
                        </div>
                        <button type="submit" class="order__submit reg__button">Зарегистрироваться</button>
                       <div style="margin-top: 30px;">
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
                    </form>
                </div>
            </div>
        </div>
    </main>
</x-app-layout>

