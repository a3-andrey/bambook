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
                <div wire:id="vWFT1tCDtbpAOooMzDtk" class="order__inner">
                    <form action="" class="order__form">
                        <div class="order__left">
                            <div class="order__page outer active" data-page="delivery">
                                <div class="order__page inner active" data-inner-page="phys">
                                    <p class="order__checkboxLine-title">Введите данные заказчика:</p>
                                    <div class="order__inputsLine">
                                        <!-- Ошибка - error на label__input -->
                                        <!-- Правильно - success на label__input -->
                                        <label for="firstname" class="label__input">
                                            <p class="label__placeholder-required"> *</p>
                                            <input wire:model.defer="firstname" value="" placeholder="Имя" id="firstname" name="firstname" type="text" class="label__input-input">
                                        </label>

                                        <label for="lastname" class="label__input
         ">
                                            <p class="label__placeholder-required"> *</p>
                                            <input wire:model.defer="lastname" value="" placeholder="Фамилия" id="lastname" name="lastname" type="text" class="label__input-input">
                                        </label>

                                        <label for="phone" class="label__input
         ">
                                            <p class="label__placeholder-required"> *</p>
                                            <input wire:model.defer="phone" value="" placeholder="Номер телефона" id="phone" name="phone" type="text" class="label__input-input">
                                        </label>

                                        <label for="email" class="label__input
         ">
                                            <p class="label__placeholder-required"> *</p>
                                            <input wire:model.defer="email" value="" placeholder="E-mail" id="email" name="email" type="text" class="label__input-input">
                                        </label>

                                        <label for="city" class="label__input
         ">
                                            <p class="label__placeholder-required"> *</p>
                                            <input wire:model.defer="city" value="" placeholder="Город" id="city" name="city" type="text" class="label__input-input">
                                        </label>

                                        <label for="address" class="label__input
         ">
                                            <p class="label__placeholder-required"> *</p>
                                            <input wire:model.defer="address" value="" placeholder="Адрес доставки" id="address" name="address" type="text" class="label__input-input">
                                        </label>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="order__right">
                            <p class="order__right-title">Итого:</p>
                            <p class="order__right-price">15 400 ₽</p>
                            <div class="order__checkboxLine-line">
                                <div class="label-block">
                                    <input wire:model="confirmation" type="checkbox" id="polit">
                                    <label class="order__polit" for="polit">
                                        <p>Согласен с <a class="polit__underline" href="#">политикой конфиденциальности</a></p>
                                    </label>
                                </div>
                            </div>
                            <button wire:click.prevent="submit" type="submit" class="order__submit">Оформить заказ</button>

                            <div wire:loading="">
                                <svg style="    margin-left: 95px;
    margin-top: -40px;
    position: absolute;" class="loading" width="20" height="19" viewBox="0 0 20 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g id="loading">
                                        <circle id="Oval" cx="3.74686" cy="14.3743" r="2.02616" fill="#F77623" fill-opacity="0.7"></circle>
                                        <circle id="Oval_2" cx="16.9234" cy="12.9864" r="1.9" fill="#F77623" fill-opacity="0.4"></circle>
                                        <circle id="Oval_3" cx="15.6246" cy="4.72886" r="1.9" fill="#F77623" fill-opacity="0.2"></circle>
                                        <ellipse id="Oval_4" cx="2.15021" cy="9.35683" rx="2.15021" ry="2.0978" fill="#F77623" fill-opacity="0.8"></ellipse>
                                        <ellipse id="Oval_5" cx="8.32584" cy="17.0952" rx="1.95474" ry="1.90478" fill="#F77623" fill-opacity="0.6"></ellipse>
                                        <circle id="Oval_6" cx="13.3941" cy="16.4491" r="1.9" fill="#F77623" fill-opacity="0.5"></circle>
                                        <ellipse id="Oval_7" cx="4.47644" cy="4.38859" rx="2.24793" ry="2.19425" fill="#F77623" fill-opacity="0.9"></ellipse>
                                        <circle id="Oval_8" cx="17.5777" cy="8.54502" r="1.9" fill="#F77623" fill-opacity="0.3"></circle>
                                        <circle id="Oval_9" cx="10.0538" cy="2.37022" r="2.37022" fill="#F77623"></circle>
                                    </g>
                                </svg>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </main>
</x-app-layout>
