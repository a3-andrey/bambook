<x-app-layout>
    <main class="catalog-main">
        <div class="container catalog">
            <div class="breadcrumbs">
                <ul class="breadcrumbs-list">

                    <li class="breadcrumbs-item">
                        <a href="/">Главная</a>
                    </li>

                    <li class="breadcrumbs-item">
                        <a href="{{ route('category',$category->slug) }}">{{ $category->category }}</a>
                    </li>

                    <li class="breadcrumbs-item">
                        <p>{{ $subcategory->category }}</p>
                    </li>

                </ul>
                <h1 class="page-name">{{ $subcategory->category }}</h1>
            </div>
            <livewire:category :category="$subcategory"/>
            <div class="full-description-block">
                <h3>Кальяны в нашем магазине</h3>
                <p>Вы задаетесь вопросом — где можно купить кальяны, чаши, колбы и другие аксессуары? Ответ достаточно прост — посетите магазин кальянов — Bamboo Hookah. Адрес наших отделов в Казани — ул. Декабристов, 113 (вход с ул. Лушникова), часы работы — 12:00-19:00.</p>
                <p>Вы также можете позвонить нам по телефону +7(965)404-19-78 и мы ответим на интересующие вас вопросы. А наши продавцы-консультанты в магазине расскажут подробно о любом, интересующем вас товаре, помогут определиться вам с выбором.</p>
                <p>Достаточно лишь раз посетить Bamboo Hookag, чтобы понять: широта и уникальность нашего ассортимента, а также выгодные цены не оставят вас равнодушными. Поэтому не стоит думать и гадать — у нас вы сможете купить кальяны в Казани или сделать заказ через наш интернет-магазин по самым лучшим ценам в городе. Bamboo Hookah — прими правильное решение, чтобы потом не жалеть!</p>
            </div>

        </div>
    </main>
</x-app-layout>
