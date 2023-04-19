<div class="block-slider">
    <div class="container block-slider-wrapper">
        <h2 class="block-slider-title">Сопутствующие товары</h2>
        <div class="products-slider no-border">
            <div class="swiper-wrapper">
                @foreach($productRelated as $product)
                <div class="product swiper-slide">
                    <a href="{{ route('product',$product->slug) }}" class="product-link">
                        <div class="product-image">
                            <img src="{{ image($product->image) }}" alt="">
                        </div>
                        <div class="product-info">
                            <h6 class="product-title">{{ $product->name }}</h6>
                            <div class="product-price">
                                <h5 class="product-price-current">{{ price_format_number($product->price) }} ₽</h5>
                            </div>
                        </div>
                    </a>
                    <livewire:cart-add :product="$product"/>
                </div>
                @endforeach

            </div>
            <div class="swiper-button-prev product-prev"></div>
            <div class="product-pagination"></div>
            <div class="swiper-button-next product-next"></div>
        </div>
    </div>
</div>
