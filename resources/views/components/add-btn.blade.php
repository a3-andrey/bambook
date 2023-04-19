<div class="cart__buttons">
    <style>
        @if(Route::currentRouteName() != 'product')
        .count-cart{
            margin-top: 18px;
        }
        @endif
    </style>

    @if($qtu > 0)
        <div class="btn count-cart">
            <button wire:click.prevent="minus" class="minus-cart"></button>
            <div wire:loading  wire:target="plus, minus" class="preloader-cart-product-add-btn">
                <svg class="loading" width="20" height="19" viewBox="0 0 20 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g id="loading">
                        <circle id="Oval" cx="3.74686" cy="14.3743" r="2.02616" fill="#F77623" fill-opacity="0.7"></circle>
                        <circle id="Oval_2" cx="16.9234" cy="12.9864" r="1.9" fill="#F77623" fill-opacity="0.4"></circle>
                        <circle id="Oval_3" cx="15.6246" cy="4.72886" r="1.9" fill="#F77623" fill-opacity="0.2"></circle>
                        <ellipse id="Oval_4" cx="2.15021" cy="9.35683" rx="2.15021" ry="2.0978" fill="#F77623" fill-opacity="0.8"></ellipse>
                        <ellipse id="Oval_5" cx="8.32584" cy="17.0952" rx="1.95474" ry="1.90478" fill="#F77623" fill-opacity="0.6"></ellipse>
                        <circle id="Oval_6" cx="13.3941" cy="16.4491" r="1.9" fill="#F77623" fill-opacity="0.5"></circle>
                        <ellipse id="Oval_7" cx="4.47644" cy="4.38859" rx="2.24793" ry="2.19425" fill="#F77623" fill-opacity="0.9"></ellipse>
                        <circle id="Oval_8" cx="17.5777" cy="8.54502" r="1.9" fill="#F77623" fill-opacity="0.3"></circle>
                        <circle id="Oval_9" cx="10.0538" cy="2.37022" r="2.37022" fill="#F77623"></circle>
                    </g>
                </svg>
            </div>
            <input disabled  wire:model="qtu" class="count" type="text" >
            <button wire:click.prevent="plus" class="plus-cart"></button>
        </div>
    @else
        <a wire:click.prevent="add('{{ $product->slug }}')" href="#" class="{{ $btnClass }}">
            <svg class="icon">
                <use xlink:href="#button-cart"></use>
            </svg>
            В корзину
        </a>
    @endif
</div>
