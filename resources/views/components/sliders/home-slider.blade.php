<div class="home-slider">
    <div class="container home-slider-wrapper">
        <div class="home-slider-block">
            <div class="big-slider">
                <div class="swiper-wrapper">
                    @foreach($sliders as $slider)
                    <div class="slide swiper-slide">
                        <a href="{{ $slider->btn_action }}">
                            <picture>
                                <img src="{{ image($slider->image) }}" alt="">
                            </picture>
                        </a>
                    </div>
                    @endforeach
                </div>
                <div class="swiper-navigation">
                    <div class="swiper-button-prev prev-slide"></div>
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-next next-slide"></div>
                </div>
            </div>
        </div>
    </div>
</div>
