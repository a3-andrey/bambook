<div class="order__inner">
    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            /* display: none; <- Crashes Chrome on hover */
            -webkit-appearance: none;
            margin: 0; /* <-- Apparently some margin are still there even though it's hidden */
        }
    </style>
    <form  class="order__form">
        <div class="order__left">
            <div class="order__checkboxLine">
                <p class="order__checkboxLine-title">Выберите способ получения заказа:</p>
                <div class="order__checkboxLine-line">
                    <div class="order__line">
                        <div class="label-block">
                            <input wire:loading.attr="disabled" value="0" wire:model="delivery" class="js-select-page"
                                   type="radio" id="delivery1"
                                   name="delivery" checked data-select-page="delivery" data-select-warning="">
                            <label for="delivery1">
                                <p>Доставка</p>
                            </label>
                        </div>
                        <div class="label-block">
                            <input wire:loading.attr="disabled" wire:model="delivery" value="1" class="js-select-page"
                                   type="radio" id="delivery2" name="delivery"
                                   data-select-page="selfDelivery"
                                   data-select-warning="selfDeliver">
                            <label for="delivery2">
                                <p>Самовывоз</p>
                            </label>
                        </div>
                    </div>

                    <div  @if($delivery==0) style="display: none" @endif class="js-order__page-warning order__column" data-warning="selfDeliver">
                        <div class="order__page-warning">
                            <img src="assets/warning.svg" alt="" class="order__warning-img">
                            <p class="order__warning-text">Самовывоз производится: с пн-сб (7:00-19:00). По адресу г. Казань, ул. Восстания, 100 </p>
                        </div>
                    </div>

                    <hr class="order__hr">
                </div>
            </div>

            <div  class="order__page outer active" data-page="delivery">
                <p class="order__checkboxLine-title">Выберите статус плательщика:</p>
                <div class="order__checkboxLine-line">
                    <div class="order__line">
                        <div class="label-block">
                            <input wire:loading.attr="disabled"
                                   wire:model="order"
                                   value="0"
                                   class="js-innerSelect-page"
                                   type="radio" id="status1"
                                   name="status" checked data-inner-select-page="phys">
                            <label for="status1">
                                <p>Физическое лицо</p>
                            </label>
                        </div>
                        <div class="label-block">
                            <input wire:loading.attr="disabled"
                                   wire:model="order"
                                   value="1"
                                   class="js-innerSelect-page"
                                   type="radio"
                                   id="status2"
                                   name="status"
                                   data-inner-select-page="ur">
                            <label for="status2">
                                <p>Юридическое лицо</p>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="order__page inner active" data-inner-page="phys">
                    <p class="order__checkboxLine-title">Введите данные заказчика:</p>
                    <div class="order__inputsLine">
                        <!-- Ошибка - error на label__input -->
                        <!-- Правильно - success на label__input -->

                        <label @if($order==1) style="display:none;" @endif for="firstname" class="label__input @error('firstname') error @enderror ">
                            <p class="label__placeholder-required">*</p>
                            <input oninput="this.value=this.value.replace(/[^а-яА-Я]/g,'');" wire:model.defer="firstname" placeholder="Имя" id="firstname"
                                   type="text" class="label__input-input">
                        </label>

                        <label @if($order==1) style="display:none;" @endif for="lastname" class="label__input @error('lastname') error @enderror ">
                            <p class="label__placeholder-required">*</p>
                            <input oninput="this.value=this.value.replace(/[^а-яА-Я]/g,'');" wire:model.defer="lastname"  placeholder="Фамилия" id="lastname"
                                   type="text" class="label__input-input">
                        </label>

                        <label @if($order==0) style="display:none;" @endif for="company" class="label__input @error('company') error @enderror ">
                            <p class="label__placeholder-required">*</p>
                            <input wire:model.defer="company"  placeholder="Название организации" id="company"
                                   type="text" class="label__input-input">
                        </label>

                        @push('scripts')
                            <link href="https://cdn.jsdelivr.net/npm/suggestions-jquery@21.12.0/dist/css/suggestions.min.css" rel="stylesheet" />
                            <script src="https://cdn.jsdelivr.net/npm/suggestions-jquery@21.12.0/dist/js/jquery.suggestions.min.js"></script>
                            <script>
                                // Замените на свой API-ключ
                                var token = "{{ config('dadata.token') }}";

                                function join(arr /*, separator */) {
                                    var separator = arguments.length > 1 ? arguments[1] : ", ";
                                    return arr.filter(function(n){return n}).join(separator);
                                }

                                function typeDescription(type) {
                                    var TYPES = {
                                        'INDIVIDUAL': 'Индивидуальный предприниматель',
                                        'LEGAL': 'Организация'
                                    }
                                    return TYPES[type];
                                }

                                function showSuggestion(suggestion) {
                                    console.log(suggestion);
                                    var data = suggestion.data;
                                    if (!data)
                                        return;

                                    // $("#type").text(
                                    //     typeDescription(data.type) + " (" + data.type + ")"
                                    // );

                                    if (data.name) {
                                        $("#company").val(data.name.full || "");
                                        @this.set('company',data.name.full);
                                    }

                                    $("#party").val(data.inn);
                                    @this.set('inn',data.inn);

                                    if (data.address) {
                                        var address = "";
                                        var city = data.address.data.city;

                                        if (data.address.data.qc == "0") {
                                            address = join([data.address.data.postal_code, data.address.value]);
                                        } else {
                                            address = data.address.data.source;
                                        }
                                        @this.set('address',address);
                                        @this.set('city',city);
                                        $("#address").val(address);
                                        $("#city").val(city);

                                    }
                                }
                                $("#party").suggestions({
                                    token: token,
                                    type: "PARTY",
                                    count: 5,
                                    /* Вызывается, когда пользователь выбирает одну из подсказок */
                                    onSelect: showSuggestion
                                });
                            </script>
                        @endpush

                        <label  @if($order==0) style="display:none;" @endif
                        for="inn" class="label__input @error('company') error @enderror ">
                            <span wire:ignore>
                                 <p class="label__placeholder-required">*</p>
                                    <input id="party"
                                           oninput="@this.set('inn',this.value)"
                                            placeholder="ИНН"
                                            type="text"
                                            class="label__input-input">
                            </span>
                        </label>
                        <x-ui.phone/>
                        <x-ui.email/>
                        <label @if($delivery==1) style="display:none;" @endif for="city" class="label__input @error('city') error @enderror ">
                            <p class="label__placeholder-required">*</p>
                            <input oninput="this.value=this.value.replace(/[^а-яА-Я]/g,'');"
                                   wire:model.defer="city"
                                   placeholder="Город"
                                   id="city"
                                   type="text"
                                   class="label__input-input">
                        </label>

                        <label @if($delivery==1) style="display:none;" @endif for="address" class="label__input @error('address') error @enderror ">
                            <p class="label__placeholder-required">*</p>
                            <input wire:model.defer="address"
                                   placeholder="Адрес доставки"
                                   id="address"
                                   type="text"
                                   class="label__input-input">
                        </label>
                        <label for="city" class="label__input @error('comment') error @enderror ">
                            <p class="label__placeholder-required"></p>
                            <input
                                   wire:model.defer="comment"
                                   placeholder="Комментарий"
                                   id="comment"
                                   type="text"
                                   class="label__input-input">
                        </label>
                    </div>
                </div>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <div class="order__right">
            <p class="order__right-title">Итого:</p>
            <p class="order__right-price">{{ price_format_number( \App\Facades\CartFacade::getTotalCart() ) }} ₽</p>
            <div class="order__checkboxLine-line">
                <div class="label-block">
                    <input  wire:model="confirmation" type="checkbox" id="polit" >
                    <label class="order__polit" for="polit">
                        <p>Согласен с <a class="polit__underline" href="#">политикой конфиденциальности</a></p>
                    </label>
                </div>
                @error('confirmation') <p class="label__error">{{ $message }}</p>@enderror
            </div>
            <button wire:loading.attr="disabled" wire:click.prevent="submit" type="submit" class="order__submit">Оформить заказ</button>

            <div  wire:loading >
                <svg style="    margin-left: 95px;
    margin-top: -40px;
    position: absolute;" class="loading" width="20" height="19" viewBox="0 0 20 19" fill="none" xmlns="http://www.w3.org/2000/svg">
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
        </div>
    </form>
</div>
