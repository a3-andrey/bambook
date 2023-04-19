<x-app-layout>
    <main class="home-main">
        @include('components.sliders.home-slider',['sliders'=>Slider::get(2)])
        <div class="advantages">
            <div class="container advantages-wrapper">
                @foreach(\App\Models\Advantage::all() as $advantage)
                <div class="advantage">
                    <img src="{{ image($advantage->image) }}" alt="Большой ассортимент">
                    <div class="advantage-info">
                        <h6 class="advantage-title">{{ $advantage->title }}</h6>
                        <p class="advantage-description">{{ $advantage->description }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @foreach(\App\Models\Promotion::orderBy('order','ASC')->get() as $item)
        <div class="block-slider">
            <div class="container block-slider-wrapper">
                <h2 class="block-slider-title">{{ $item->name }}</h2>
                <div class="products-slider">
                    <div class="swiper-wrapper">
                        @foreach($item->products as $product)
                            @include('components.products.cart')
                        @endforeach
                    </div>
                    <div class="swiper-button-prev product-prev"></div>
                    <div class="product-pagination"></div>
                    <div class="swiper-button-next product-next"></div>
                </div>
            </div>
        </div>
        @endforeach
        <div class="home-text">
            <div class="container home-text-wrapper">
                <h2 class="editable home-text-title">Кальяны в нашем магазине</h2>
                <div class="text-wrapper">
                    <p>
                        Вы задаетесь вопросом — где можно купить кальяны, чаши, колбы и другие аксессуары? Ответ достаточно прост — посетите магазин кальянов — Bamboo Hookah. Адрес наших отделов в Казани — ул. Декабристов, 113 (вход с ул. Лушникова), часы работы— 12:00-19:00.
                    </p>
                    <p>
                        Вы также можете позвонить нам по телефону +7(965)404-19-78 и мы ответим на интересующие вас вопросы. А наши продавцы-консультанты в магазине расскажут подробно о любом, интересующем вас товаре, помогут определиться вам с выбором.
                    </p>
                    <p>
                        Достаточно лишь раз посетить Bamboo Hookag, чтобы понять: широта и уникальность нашего ассортимента, а также выгодные цены не оставят вас равнодушными. Поэтому не стоит думать и гадать — у нас вы сможете купить кальяны в Казани или сделать заказ через наш интернет-магазин по самым лучшим ценам в городе. Bamboo Hookah — прими правильное решение, чтобы потом не жалеть!
                    </p>
                </div>
            </div>
        </div>
    </main>
</x-app-layout>
