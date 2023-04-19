<form action="" class="profile__form">
    <div class="reg__block">
        <h3 class="reg__title">Персональные данные:</h3>
        <div class="reg__block-content">
            <x-ui.input name="lastname" placeholder="Фамилия" />

            <x-ui.input name="firstname" placeholder="Имя" />

            <x-ui.input name="patronymic" placeholder="Отчество" />

            <x-ui.input name="email" placeholder="E-mail" />

            <x-ui.phone />

            <x-ui.input name="company" placeholder="Название организации" />
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
    <div class="profile__line">
        <button wire:click.prevent="submit" type="submit" class="order__submit profile__button">Сохранить</button>
        @if(session('message'))
        <p class="profile__line-text">{{ session('message') }}</p>
        @endif
    </div>
</form>
