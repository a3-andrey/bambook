@if(\App\Facades\CartFacade::isSale())
    <span class="prices">
        <h5 class="product-price-new">{{ price_format_number($item->priceTotal) }} ₽</h5>
        <strike class="product-price-old">{{ price_format_number($item->price) }} ₽</strike>
    </span>
@else
    <span class="prices">
        <h5 class="product-price-current">{{ price_format_number($item->price) }} ₽</h5>
    </span>
@endif
