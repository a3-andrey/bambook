<div>
    {{-- Be like water. --}}
    <p class="article-price">
        @if($qtu > 1)
            {{ price_format_number($product->priceTotal*$qtu) }} ₽
        @else
            {{ $product->priceold }} ₽
        @endif
    </p>
</div>
