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
                    <h1 class="page-name">Личный кабинет</h1>
                </div>
            </div>
        </div>

        <div class="profile-wrapper">
            <div class="container">
                <div class="profile__inner">
                    <div class="profile__menu">
                        <a href="#" class="profile__menu-item js-select-menu-page _active" data-select-menu-page="info">Личная информация</a>
                        <a href="#" class="profile__menu-item js-select-menu-page" data-select-menu-page="history">История Заказов</a>
                        <form id="logout" method="POST" action="{{ route('logout') }}">@csrf</form>
                        <a onclick="document.getElementById('logout').submit();return false;" href="/logout"
                           class="profile__menu-item">Выйти</a>
                    </div>
                    <div class="profile__content">
                        <div class="profile__content-page" data-menu-page="info">
                            <livewire:profile/>
                        </div>
                        <div class="profile__content-page" data-menu-page="history">
                            <div class="profile__table">
                                <div class="profile__table-titles">
                                    <p class="profile__table-title">Номер заказа:</p>
                                    <p class="profile__table-title">Дата:</p>
                                    <p class="profile__table-title last">Статус:</p>
                                </div>
                                <div class="profile__table-content">
                                    @foreach($orders as $order)
                                    <div class="profile__table-item">
                                        <div class="table__item-titles">
                                            <p class="table__item-title table__item-titles--item">№{{ $order->hash }}</p>
                                            <p class="table__item-title table__item-titles--item">
                                                {{ \Carbon\Carbon::parse($order->created_at)->format(\App\Models\Order::DATE) }}
                                            </p>
                                            <div class="table__item-status table__item-titles--item">
                                                @switch($order->status)
                                                    @case(0)
                                                    <svg class="loading" width="20" height="19" viewBox="0 0 20 19" fill="none" xmlns="http://www.w3.org/2000/svg">
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
                                                    <p class="table__status-text">Обрабатывается</p>
                                                    @break
                                                    @case(1)
                                                    <svg class="loadingSuccses" width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <g id="Group 15">
                                                            <g id="loading">
                                                                <circle id="Oval" cx="3.94334" cy="15.1308" r="2.1328" fill="#32BA46" fill-opacity="0.7"></circle>
                                                                <circle id="Oval_2" cx="17.8145" cy="13.6699" r="2" fill="#32BA46" fill-opacity="0.4"></circle>
                                                                <circle id="Oval_3" cx="16.4453" cy="4.97778" r="2" fill="#32BA46" fill-opacity="0.2"></circle>
                                                                <ellipse id="Oval_4" cx="2.26338" cy="9.84932" rx="2.26338" ry="2.20821" fill="#32BA46" fill-opacity="0.8"></ellipse>
                                                                <ellipse id="Oval_5" cx="8.76466" cy="17.995" rx="2.05763" ry="2.00503" fill="#32BA46" fill-opacity="0.6"></ellipse>
                                                                <circle id="Oval_6" cx="14.0996" cy="17.3149" r="2" fill="#32BA46" fill-opacity="0.5"></circle>
                                                                <ellipse id="Oval_7" cx="4.71194" cy="4.61955" rx="2.36624" ry="2.30974" fill="#32BA4E" fill-opacity="0.9"></ellipse>
                                                                <circle id="Oval_8" cx="18.502" cy="8.99487" r="2" fill="#32BA46" fill-opacity="0.3"></circle>
                                                                <circle id="Oval_9" cx="10.5848" cy="2.49497" r="2.49497" fill="#32BA46"></circle>
                                                            </g>
                                                            <g id="Group 13">
                                                                <path id="Shape" d="M10.3794 11.64C10.66 11.9206 10.66 12.4016 10.3794 12.6822L9.79814 13.2634C9.51754 13.544 9.03651 13.544 8.75591 13.2634L6.21045 10.6979C5.92985 10.4173 5.92985 9.93631 6.21045 9.65571L6.7917 9.07446C7.0723 8.79386 7.55333 8.79386 7.83393 9.07446L10.3794 11.64Z" fill="#32BA46"></path>
                                                                <path id="Shape_2" d="M12.6043 7.21045C12.8849 6.92985 13.3659 6.92985 13.6465 7.21045L14.2278 7.7917C14.5084 8.0723 14.5084 8.55333 14.2278 8.83393L9.8183 13.2233C9.5377 13.5039 9.05667 13.5039 8.77607 13.2233L8.19483 12.6421C7.91422 12.3615 7.91422 11.8805 8.19483 11.5999L12.6043 7.21045Z" fill="#32BA46"></path>
                                                            </g>
                                                        </g>
                                                    </svg>
                                                    <p class="table__status-text">Собирается</p>
                                                    @break
                                                    @case(2)
                                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <g id="tick">
                                                            <circle id="Oval" cx="9.98425" cy="9.98425" r="9.98425" fill="#216F2D"></circle>
                                                            <g id="Group 13">
                                                                <path id="Shape" d="M10.3794 11.64C10.66 11.9206 10.66 12.4016 10.3794 12.6822L9.79814 13.2634C9.51754 13.544 9.03651 13.544 8.75591 13.2634L6.21045 10.6979C5.92985 10.4173 5.92985 9.93631 6.21045 9.65571L6.7917 9.07446C7.0723 8.79386 7.55333 8.79386 7.83393 9.07446L10.3794 11.64Z" fill="white"></path>
                                                                <path id="Shape_2" d="M12.6043 7.21045C12.8849 6.92985 13.3659 6.92985 13.6465 7.21045L14.2278 7.7917C14.5084 8.0723 14.5084 8.55333 14.2278 8.83393L9.8183 13.2233C9.5377 13.5039 9.05667 13.5039 8.77607 13.2233L8.19483 12.6421C7.91422 12.3615 7.91422 11.8805 8.19483 11.5999L12.6043 7.21045Z" fill="white"></path>
                                                            </g>
                                                        </g>
                                                    </svg>
                                                    <p class="table__status-text">Отправлен</p>
                                                    @break
                                                    @default
                                                    <span>Статус неизвестен</span>
                                                @endswitch
                                            </div>
                                            <img src="{{ asset('assets/openV.svg') }}" alt="" class="table__item-titles--v">
                                        </div>
                                        <div class="table__item-content">
                                            <div class="table__content-top">
                                                @foreach($order->carts as $cart)
                                                    @php $cart = $cart->cart @endphp
                                                <div class="table__content-top--line">
                                                    <div class="table__part">
                                                        <p class="table__content-name">{{ $cart['name'] }}</p>
                                                        <p class="table__content-text">{{ $cart['quantity'] }} шт.</p>
                                                    </div>
                                                    <p class="table__content-text">{{ price_format_number($cart['price'])  }}₽</p>
                                                </div>
                                                @endforeach
                                            </div>
                                            <div class="table__content-bottom">
                                                <p class="table__content-bottom--text">Итого:</p>
                                                <p class="table__content-bottom--text">{{ price_format_number($order->total) }}₽</p>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    @if($orders->count() == 0)
                                        <p>У вас нет заказов</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
</x-app-layout>


