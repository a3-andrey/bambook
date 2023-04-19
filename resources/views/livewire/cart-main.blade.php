<div class="cart-block">
    <div class="container cart-block-wrapper">
        <div class="cart-info">
            <div class="cart-header">
                <p class="cart-header-items">В корзине <span>{{ $items->count() }}</span> товара</p>
                <button wire:click.prevent="clearCart" class="button secondary">
                    <svg class="icon">
                        <use xlink:href="#remove"></use>
                    </svg>
                    Очистить корзину
                </button>
            </div>
            <div class="cart-main">
                @foreach($items as $item)
                    <div class="cart-item">
                        <figure class="cart_item-image">
                            <a href="{{ $item->attributes['link'] }}">
                                <img src="{{ image($item->attributes['image']) }}">
                            </a>
                        </figure>
                        <div class="cart-item-info">
                            <div class="flex-2 d-f justify--c">
                                <p class="cart-item-name">
                                    <a href="{{ $item->attributes['link'] }}">
                                        {{ $item->name }}
                                    </a>
                                </p>
                            </div>
                            <div class="flex-2 d-f justify--c">
                                <span class="prices one-item">
                                  <x-cart.price :item="$item->associatedModel"/>
                                </span>
                            </div>
                            <div class="flex-2 d-f justify--c">
                                <div class="count-cart">
                                    <button wire:click.prevent="minus({{ $item->id }})" class="minus-cart"></button>
                                    <input onchange="@this.updateCart({{ $item->id }},this.value)"
                                           class="count" type="text"
                                           value="{{ $item->quantity }}">
                                    <button wire:click.prevent="plus({{ $item->id }})" class="plus-cart"></button>
                                </div>
                            </div>
                            <div class="flex-2 d-f justify--c">
                                 <span class="prices">
                                     <x-cart.price-sum :item="$item"/>
                                </span>
                            </div>
                            <div class="flex-0">
                                <button wire:click.prevent="delete({{ $item->id }})" class="remove-list-item" title="Удалить из корзины">
                                    <svg class="icon">
                                        <use xlink:href="#remove"></use>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
                @if($items->count() == 0)
                    <p>Корзина пустая</p>
                @endif
            </div>
        </div>
        <div class="cart-checkout">
            <div class="result">
                <p>Итого:</p>
                <h3 @if(\App\Facades\CartFacade::isSale()) style="color: #F35523" @endif>
                    {{ price_format_number(\App\Facades\CartFacade::getTotalCart()) }} ₽
                </h3>
                @if(\App\Facades\CartFacade::isSale())
                    <p class="result__oldPrice">{{ price_format_number(\App\Facades\CartFacade::getSaleTotalCart()) }} ₽</p>
                @endif
            </div>
            @if($items->count()>0)
                <a wire:click.prevent="submit" class="button go_to_cart" href="">Оформить заказ</a>
            @endif
        </div>
    </div>
</div>
