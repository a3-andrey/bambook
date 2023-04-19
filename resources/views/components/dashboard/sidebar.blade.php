<div class="navigation-wrp">
    <ul class="header-menu">
        @foreach(Menu::get('saidbar-v-lk') as $item)
            <li class="header-menu__item {{ active_link($item->uri) }}">
            <a path="{{ request()->path() }}" href="{{ url($item->uri) }}"
               class="header-menu__link">
                <div class="header-menu__image-wrp">
                    <img src="{{ asset($item->parameters) }}" alt="{{ $item->title }}"
                         class="header-menu__image">
                </div>
                <span class="header-menu__text">{{ $item->title }}</span>
            </a>
        </li>
        @endforeach
    </ul>
</div>
