<livewire:scripts />
<script src="{{ asset('vendor/laravel-admin-ext/jquery-3.6.0.min.js') }}"></script>
<script>
    $('.redirecting').click()
    $(".header-catalog").hover(onIn, onOut);
    // Функция которая отработает при наведении курсора на элемент
    function onIn() {
        if($('.submenu').hasClass('menu-hover')){
            $(".submenu").addClass('open')
        }
    }
    // Функция которая отработает при выходе курсора за элемент
    function onOut() {
        if($('.submenu').hasClass('menu-hover')){
            $(".submenu").removeClass('open')
        }
    }
</script>
<script src="{{asset('scripts/jquery.inputmask.bundle.js')}}"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script src="{{asset('scripts/ts-select2.min.js')}}"></script>
<script src="{{asset('scripts/index.js')}}"></script>

<script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
<script src="{{ asset('scripts/google-translate.js') }}"></script>
<script src="//translate.google.com/translate_a/element.js?cb=TranslateInit"></script>

@include('components.cart-script')

@stack('scripts')

{{ $slot }}


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<script src="//translate.google.com/translate_a/element.js?cb=TranslateInit"></script>
<script>
    const googleTranslateConfig = {
        lang: "en",
    };

    function TranslateInit() {

        let code = TranslateGetCode();
        // Находим флаг с выбранным языком для перевода и добавляем к нему активный класс
        $('[data-google-lang="' + code + '"]').addClass('language__img_active');

        if (code == googleTranslateConfig.lang) {
            // Если язык по умолчанию, совпадает с языком на который переводим
            // То очищаем куки
            TranslateClearCookie();
        }

        // Инициализируем виджет с языком по умолчанию
        new google.translate.TranslateElement({
            pageLanguage: googleTranslateConfig.lang,
        });

        // Вешаем событие  клик на флаги
        $('[data-google-lang]').click(function () {
            TranslateSetCookie($(this).attr("data-google-lang"))
            // Перезагружаем страницу
            window.location.reload();
        });
    }

    function TranslateGetCode() {
        // Если куки нет, то передаем дефолтный язык
        let lang = ($.cookie('googtrans') != undefined && $.cookie('googtrans') != "null") ? $.cookie('googtrans') : googleTranslateConfig.lang;
        return lang.substr(-2);
    }

    function TranslateClearCookie() {
        $.cookie('googtrans', null);
        $.cookie("googtrans", null, {
            domain: "." + document.domain,
        });
    }

    function TranslateSetCookie(code) {
        // Записываем куки /язык_который_переводим/язык_на_который_переводим
        $.cookie('googtrans', "/auto/" + code);
        $.cookie("googtrans", "/auto/" + code, {
            domain: "." + document.domain,
        });
    }
</script>
