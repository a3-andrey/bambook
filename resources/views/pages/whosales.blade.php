<x-app-layout>
    <main class="home-main">
		<div class="wholesale-wrapper">
			<div class="container wholesale">
				<div class="breadcrumbs">
					<ul class="breadcrumbs-list">
						<li class="breadcrumbs-item">
							<a href="/">Главная</a>
						</li>
						<li class="breadcrumbs-item">
							<p>Оптовые заказы</p>
						</li>
					</ul>
					<h1 class="page-name">Оптовые заказы</h1>
				</div>
			</div>
		</div>

		<div class="wholesale-info">
			<div class="container">
				<div class="wholesale-wrapper">
					<div class="economy">
						<h3 class="economy-title">Скидка для оптовых заказов</h3>
						<p class="economy-description">Минимальная сумма оптовой закупки — 15 000₽. <br /> При
							оформлении оптового заказа вам будет присвоена скидка:</p>
						<div class="economy-tiles">
							<div class="economy-tile-wrapper">
								<div class="economy-tile">
									<h3 class="economy-tile-title">
										СКИДКА 5%
									</h3>
									<p>при заказе <br />от 60 000₽ до 100 000₽ </p>
								</div>
							</div>
							<div class="economy-tile-wrapper">
								<div class="economy-tile">
									<h3 class="economy-tile-title">
										СКИДКА 10%
									</h3>
									<p>при заказе <br />от 60 000₽ до 100 000₽ </p>
								</div>
							</div>
							<div class="economy-tile-wrapper">
								<div class="economy-tile">
									<h3 class="economy-tile-title">
										СКИДКА 15%
									</h3>
									<p>при заказе <br />от 60 000₽ до 100 000₽ </p>
								</div>
							</div>
							<div class="economy-tile-wrapper">
								<div class="economy-tile">
									<h3 class="economy-tile-title">
										СКИДКА 20%
									</h3>
									<p>при заказе <br />от 60 000₽ до 100 000₽ </p>
								</div>
							</div>
						</div>
					</div>
					<div class="how-to-buy">
						<h3 class="how-to-buy-title">Как создать заказ?</h3>
						<p>Оптовый заказ осуществляется через Личный Кабинет.
							После регистрации и входа в ЛК товары добавляются в корзину.</p>
						<a href="{{ route('login') }}" class="button">ВОЙТИ В ЛК</a>
						<a style="margin-left: 30px;border-color: #ffffff" href="{{ route('register') }}" class="button">РЕГИСТРАЦИЯ</a>
						<h3 class="how-to-buy-title">Как оплатить заказ?</h3>
						<p>После оформления заказа на указанную Вами почту поступит Счет-оферта.
							Менеджер свяжется с Вами по указанному телефону.</p>

					</div>
				</div>
			</div>
		</div>
	</main>
</x-app-layout>
