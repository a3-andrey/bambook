<ul class="user-controls">
    <li class="cart">
        <a href="{{route('cart')}}">
            <img src="{{asset('/assets/cart.svg')}}" alt="">
            <span class="items">{{ Cart::getContent()->count() }}</span>
        </a>
        <div class="cart_items-wrapper">
            <ul class="cart_list">
                @foreach($items as $item)
                    <li class="cart_list-item">
                        <a>
                            <div class="flex-0">
                                <figure  class="cart_item-image">
                                    <img style="cursor: pointer"
                                         onclick="window.location.assign('{{ route('product',$item->associatedModel->slug) }}')"
                                         src="{{ image($item->attributes['image']) }}">
                                </figure>
                            </div>
                           <div  class="flex-2">
                               <p style="cursor: pointer"
                                  onclick="window.location.assign('{{ route('product',$item->associatedModel->slug) }}')" class="cart_item-name">
                                   {{ $item->name  }}
                               </p>
                           </div>
                            <div class="flex-1">
                                <div class="count-cart cart-head">
                                    <button wire:click.prevent="minus({{ $item->id }})" class="minus-cart"></button>
                                    <input onchange="@this.updateCart({{ $item->id }},this.value)" class="count" type="text"
                                           value="{{ $item->quantity }}">
                                    <button wire:click.prevent="plus({{ $item->id }})" class="plus-cart"></button>
                                </div>
                            </div>
                            <div class="flex-1">
                                <x-cart.price-sum :item="$item"/>
                            </div>
                        </a>
                        <button wire:click="delete({{ $item->id }})" class="remove_list-item" title="Удалить из корзины">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 1L15 15M15 1L1 15" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                    </li>
                @endforeach
            </ul>
            <div class="cart-footer">
                <div class="result">
                    <p>Итого:</p>
                    <h3  @if(!\App\Facades\CartFacade::isSale()) style="color: #E7C35D" @endif>
                        {{ price_format_number($total) }}  ₽
                    </h3>
                    @if(\App\Facades\CartFacade::isSale())
                        <p class="result__oldPrice">{{ price_format_number($totalSale) }} ₽</p>
                    @endif
                </div>
                <a class="button go_to_cart" href="{{ route('cart') }}">Перейти в корзину</a>
            </div>
        </div>
    </li>
    <li>
        @auth
            <a href="{{ route('dashboard') }}">
                <img src="{{asset('/assets/user.svg')}}" alt="">
            </a>
        @endauth
        @guest
            <a href="{{ route('login') }}">
                <img src="{{asset('/assets/user.svg')}}" alt="">
            </a>
        @endguest

    </li>
</ul>
