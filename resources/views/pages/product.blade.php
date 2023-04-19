<x-app-layout>
    <main class="home-main">
		<div class="article-wrapper">
			<div class="container article">
				<div class="breadcrumbs">
					<ul class="breadcrumbs-list">
						<li class="breadcrumbs-item">
							<a href="/">Главная</a>
						</li>
						@foreach($categories as $category)
						<li class="breadcrumbs-item">
							<a href="{{ $category->parent_id == 0 ?
							route('category',$category->slug) :
							route('category.subcategory',[$category->child->slug,$category->slug])
							}}">
								{{ $category->category }}
							</a>
						</li>
						@endforeach
						<li class="breadcrumbs-item">
							<p>{{ $product->name }}</p>
						</li>
					</ul>
				</div>
				<div class="article-block">
					<div class="article-top">
						<div class="article-controls">
							<div class="big-article">
								<div class="swiper-wrapper">
									@foreach($product->images as $image)
									<div class="slide swiper-slide">
										<img src="{{ image($image->image) }}" alt="">
									</div>
									@endforeach
								</div>
							</div>
							<div class="small-article">
								<div class="swiper-wrapper">
									@foreach($product->images as $image)
									<div class="slide swiper-slide">
										<img src="{{ image($image->image) }}" alt="">
									</div>
									@endforeach
								</div>
								<div class="swiper-button-prev article-prev"></div>
								<div class="swiper-button-next article-next"></div>
							</div>
						</div>
						<div class="article-info">
							<h2 class="article-name">
								{{ $product->name }}
							</h2>
							<p class="article-price-for-one">Цена за единицу: <span>
									{{ price_format_number($product->price) }}₽</span>
							</p>
							<div class="pricing-table">
								<div class="pricing-table-row">
									<div>
										<p>Сумма покупки</p>
									</div>
									<div>
										<p>Скидка</p>
									</div>
									<div>
										<p>1 шт. со скидкой</p>
									</div>
								</div>
								@foreach($prices as $price)
								<div class="pricing-table-row">
									<div>
										<p>
											@switch($price->name)
												@case('Цена "опт"')
												от 15 000₽
												@break
												@case('Цена "крупный опт"')
												от 60 000₽
												@break
												@case('Цена "спец цена"')
												от 100 000₽
												@break
											@endswitch
										</p>
									</div>
									<div>
										<strike>
											@switch($price->name)
												@case('Цена "опт"')
												{{ price_format_number($product->price,2) }}₽
												@break
												@case('Цена "крупный опт"')
												{{ price_format_number($product->price,2) }}₽
												@break
												@case('Цена "спец цена"')
												{{ price_format_number($product->price,2) }}₽
												@break
											@endswitch
										</strike>
									</div>
									<div>
										<p>
											@switch($price->name)
												@case('Цена "опт"')
												{{ price_format_number($price->price,2) }}₽
												@break
												@case('Цена "крупный опт"')
												{{ price_format_number($price->price,2) }}₽
												@break
												@case('Цена "спец цена"')
												{{ price_format_number($price->price,2) }}₽
												@break
											@endswitch
										</p>
									</div>
								</div>
								@endforeach
							</div>
							<p class="article-warning">Минимальное кол-во для заказа этого товара: {{ $product->multiple?:1 }}. <br /> Заказ
								отгружается кратно упаковке (кратность упаковки: {{ $product->multiple?:1 }})</p>
{{--								<livewire:product-price :product="$product"/>--}}
							<div class="article-settings">
								<livewire:cart-add :product="$product" :isProduct="true"  />
							</div>
						</div>
					</div>
					<div class="article-more">
						<h2 class="article-more-title">Описание и характеристики</h2>
						<p class="article-description">
							{{ $product->description }}
						</p>
					</div>
				</div>
			</div>
		</div>
		@if($productRelated->count() > 0)
		@include('components.products.related_products')
		@endif
	</main>
</x-app-layout>
