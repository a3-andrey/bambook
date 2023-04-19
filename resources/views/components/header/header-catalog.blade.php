<div class="header-catalog">
    <button id="catalog" class="catalog-button">
        <span class="burger"></span>
        КАТАЛОГ
    </button>
    <ul class="submenu home @if(!Route::is('main')) page @endif
    @if(Route::is('contacs') || Route::is('product') || Route::is('dashboard')
    || Route::is('whosales') || Route::is('login') || Route::is('register') || Route::is('password.request')
       || Route::is('password.reset') || Route::is('cart' ) || Route::is('order' ) || Route::is('verification.notice')  )
            menu-hover
    @else
{{--            open--}}
    @endif
            ">
        <li class="sticky">
            <button id="close-catalog" class="close-catalog-button">
                <span class="close"></span>
                ЗАКРЫТЬ КАТАЛОГ
            </button>
        </li>
        @foreach(\App\Models\Category::where('category','Bamboo-hookah')->first()->parent->sortBy('order_column') as $item)
        <li>
            <a class="{{ is_active_category($item->category) }}"  href="{{ route('category',$item->slug) }}">
                {{ $item->category }}
            </a>
            @if($item->parent->count())
                <ul class="brands">
                    @foreach($item->parent as $itemP)
                    <li>
                        <a class="{{ is_active_category($itemP->slug) }}"
                           href="{{ route('category.subcategory',[$item->slug,$itemP->slug]) }}">
                            {{ $itemP->category }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            @endif
        </li>
        @endforeach
    </ul>
</div>
