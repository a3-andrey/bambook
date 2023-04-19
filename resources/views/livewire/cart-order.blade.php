<div class="cart-item">
    <figure class="cart_item-image">
        <img src="{{ image($item->attributes['image']) }}">
    </figure>
    <div class="cart-item-info">
        <p class="cart-item-name">{{ $item->name }}</p>
        <span class="prices one-item">
        <h5 class="product-price-current">{{ price_format_number($item->price) }} ₽</h5>
        {{--<strike class="product-price-old">8 990 ₽</strike>--}}
        </span>
        <div class="count-cart">
            <button wire:click.prevent="minus" class="minus-cart"></button>
            <input class="count" type="text" value="{{ $item->quantity }}">
            <button wire:click.prevent="plus" class="plus-cart"></button>
        </div>
        <span class="prices">
            <h5 class="product-price-current">{{ price_format_number($item->price*$item->quantity) }} ₽</h5>
{{--            <strike class="product-price-old">8 990 ₽</strike>--}}
        </span>
        <button wire:click.prevent="del({{ $item->id }})" class="remove-list-item" title="Удалить из корзины">
            <svg class="icon">
                <use xlink:href="#remove"></use>
            </svg>
        </button>
    </div>
</div>
