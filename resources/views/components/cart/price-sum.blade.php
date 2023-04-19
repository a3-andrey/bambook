@if(\App\Facades\CartFacade::isSale($item))
    <span class="prices">
        <h5 class="product-price-new">{{ price_format_number($item->associatedModel->priceTotal*$item->quantity) }} ₽</h5>
        <strike class="product-price-old">{{ price_format_number($item->associatedModel->priceold*$item->quantity) }} ₽</strike>
    </span>
@else
    <span class="prices">
        <h5 class="product-price-current">{{ price_format_number($item->associatedModel->price*$item->quantity) }} ₽</h5>
    </span>
@endif
