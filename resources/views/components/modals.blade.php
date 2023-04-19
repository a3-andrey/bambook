<div id="modal__form-object" class="modal__form">
    <div class="modal__form-dialog">
        <div class="modal__form-content">
            <div data-close class="modal__close">
                <img data-close src="img/modal-close.svg" alt="">
            </div>
            <div class="modal__form-title">
                Напишите нам
            </div>
            <form id="modal-small-form" class="modal__form-form">
                <label class="modal__form-label">
                    <input name="name" class="modal__form-input " type="text" placeholder="Имя">
                </label>
                <label class="modal__form-label">
                    <input name="email" class="modal__form-input " type="email" placeholder="E-mail">
                </label>
                <label class="modal__form-label">
                    <input name="phone" class="modal__form-input " type="tel" placeholder="Телефон">
                </label>


                <button class="modal__form-btn">Отправить</button>
            </form>
            <p class="modal__form-descr">
                Нажимая кнопку «Отправить», я даю свое согласие на обработку моих персональных данных согласно 4 ст. 9 152-ФЗ
            </p>
        </div>
    </div>
</div>

<div id="modal__file-object" class="modal__form modal__file" data-aos="fade-down" data-aos-duration="1500">
    <div class="modal__form-dialog modal__file-dialog">
        <livewire:order/>
    </div>
</div>


<div>
    <livewire:recall/>
</div>

@stack('modals')
