<div class="product swiper-slide">
    <a href="{{ route('product',$product->slug) }}" class="product-link">
        <div class="product-image">
            <img src="{{ image($product->image) }}" alt="">
        </div>
        <div class="product-info">
            <h6 class="product-title">{{ $product->name }}</h6>
            <div class="product-price">
                <h5 class="product-price-current">{{ price_format_number($product->priceold) }} ₽</h5>
            </div>
{{--            @if($product->isSale())--}}
{{--                <div class="product-price">--}}
{{--                    <h5 class="product-price-new">{{ price_format_number($product->priceTotal) }} ₽</h5>--}}
{{--                    <strike class="product-price-old">{{ price_format_number( $product->priceold ) }} ₽</strike>--}}
{{--                </div>--}}
{{--            @else--}}

{{--            @endif--}}
        </div>
    </a>
{{--    :wire:key="'item-'.$product->id"--}}
    <livewire:cart-add :product="$product" key="{{ $product->id }}"  />
</div>
