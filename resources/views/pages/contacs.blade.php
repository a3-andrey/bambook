<x-app-layout>
    <main class="home-main">
        <div class="contacts-wrapper">
            <div class="container contacts">
                <div class="breadcrumbs">
                    <ul class="breadcrumbs-list">
                        <li class="breadcrumbs-item">
                            <a href="">Главная</a>
                        </li>
                        <li class="breadcrumbs-item">
                            <p>Контакты</p>
                        </li>
                    </ul>
                    <h1 class="page-name">Контакты</h1>
                </div>
            </div>
        </div>

        <div class="contacts-block">
            <div class="container contacts-block-wrapper">
                <div class="contacts-info">
                    <h4>Адрес:</h4>
                    <p>г. Казань, ул. Декабристов, 113 <br/> (вход со стороны ул. Лушникова)</p>
                    <h4>Телефон магазина:</h4>
                    <p>+7(965)404-19-78</p>
                    <h4>Режим работы:</h4>
                    <p>с понедельника по пятницу <br/> с 10:00 до 19:00</p>
                </div>
                <div id="map" class="map"></div>
            </div>
        </div>
    </main>
    @push('scripts')
        <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
    @endpush
</x-app-layout>
