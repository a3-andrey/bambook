<div>
    {{-- The Master doesn't talk, he acts. --}}
    <div class="filter">
        <p class="filter-text">Сортировать:</p>
        <a wire:click.prevent="sort" href="#"  class="filter-link">
            По цене
            <svg width="9" height="9" class="icon @if($sort == 'ASC') rotation-180 @endif">
                <use xlink:href="#arrow-down"></use>
            </svg>
        </a>
    </div>
    <div class="products-wrapper">
        <div class="products">
            @foreach($products as $product)
                @include('components.products.cart')
            @endforeach
        </div>
        @if($products->count()<$totalItems)
            <button wire:click="showMore()" class="button secondary more">
                Показать еще
                <svg style="margin-left: 15px;" width="19" height="19" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path id="+" fill-rule="evenodd" clip-rule="evenodd" d="M9.14857 19.991V11.6097H0.881104V9.3722H9.14857V0.990967H11.6516V9.3722H19.919V11.6097H11.6516V19.991H9.14857Z" fill="#9A9A9A"/>
                </svg>
            </button>
        @endif
    </div>
</div>
