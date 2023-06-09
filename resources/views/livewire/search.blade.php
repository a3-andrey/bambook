<form action="" class="search-form">
    <!-- class="active" for input open search wrapper -->
    <input wire:model="search"  @if($result) class="active" @endif type="text" placeholder="Поиск по сайту">
    <div class="search-wrapper">
        <ul class="search-list">
            @if(count($items) > 0)
            @foreach($items as $item)
            <li class="search-listitem">
                <a href="{{ route('product',$item->slug) }}">
                    <figure class="cart_item-image">
                        <img src="{{ image($item->image) }}">
                    </figure>
                    <p class="cart_item-name">{{ $item->name }}</p>
                    <x-cart.price :item="$item"/>
                </a>
            </li>
            @endforeach
            @else
                <li class="search-listitem">
                    <p class="cart_item-name">Нечего не найдено</p>
                </li>
           @endif
        </ul>
    </div>

    <button onclick="return false;" class="search-form-button">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none">
            <mask id="a" width="20" height="20" x="2" y="2"
                  maskUnits="userSpaceOnUse" style="mask-type:alpha">
                <path fill="#fff" fill-rule="evenodd"
                      d="m21.8336 20.2158-5.1748-5.2131c-.1943-.1954-.2137-.4965-.0634-.7274 2.1217-3.2543 1.6268-7.72963-1.5034-10.40274-3.012-2.5714-7.59655-2.4834-10.51481.19542-3.3497 3.07483-3.43427 8.30852-.25257 11.49242 2.71312 2.7154 6.91248 3.0451 9.99648 1.0052.2314-.1532.5349-.1332.7303.0634l5.1634 5.2022c.2234.2246.5857.2252.8097.0012l.808-.8086c.2229-.2229.2234-.584.0011-.808ZM5.94061 13.9427c-2.20799-2.2097-2.20799-5.80505 0-8.01474 2.20798-2.20969 5.80049-2.21026 8.00849 0 2.208 2.20969 2.208 5.80504 0 8.01474-2.208 2.2097-5.80051 2.2097-8.00849 0Z"
                      clip-rule="evenodd" />
            </mask>
            <g mask="url(#a)">
                <path fill="#E7C35D" d="M0 0h24v24H0z" />
            </g>
        </svg>
    </button>
</form>
