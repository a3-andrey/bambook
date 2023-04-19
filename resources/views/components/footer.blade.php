<footer class="footer">
    <div class="container">
        <div class="footer-top">
            <a href="/" class="footer-logo">
                <img src="{{asset('assets/footer-logo.svg')}}" alt="">
            </a>
            <div class="footer-catalog">
                <h3 class="footer-title">Каталог</h3>
                <ul class="footer-menu">
                    @foreach(Menu::get('katalog-futer') as $menuItem)
                        <li><a href="{{$menuItem->uri}}">{{$menuItem->title}}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="footer-contacts">
                <h3 class="footer-title">Контакты</h3>
                <div class="contact-block">
                    <p>Email:</p>
                    <a href="mailto:{{config('contacts.email')}}">{{config('contacts.email')}}</a>
                </div>
                <div class="contact-block">
                    <p>Телефон:</p>
                    <a href="tel:{{config('contacts.phone')}}">{{config('contacts.phone')}}</a>
                </div>
            </div>
            <livewire:contact-us-form />
        </div>
        <div class="copyright">
            <p class="copyright-text">Copyright © {{Carbon\Carbon::now()->year}} Bamboo Hookah</p>
            <a href="" class="copyright-link">Политика конфиденциальности</a>
            <p class="copyright-text develop">Сайт разработан: <a href="{{config('contacs.develop')}}">MonkeyGarden</a></p>
        </div>
    </div>
</footer>
