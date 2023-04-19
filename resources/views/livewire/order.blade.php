<div class="modal__form-content">
    <div data-close class="modal__close">
        <img data-close src="{{ asset('img/modal-close.svg') }}" alt="">
    </div>
    <div class="modal__form-title">
        Напишите нам
    </div>
    <form id="modal-big-form" class="modal__form-form">
        <label class="modal__form-label modal__file-label">
            @include('components.ui.input',['name'=>'name','placeholder'=>'Имя'])
        </label>
        <label class="modal__form-label modal__file-label">
            @include('components.ui.input',['name'=>'email','placeholder'=>'Email'])
        </label>
        <label class="modal__form-label modal__file-label">
            @include('components.ui.input',['type'=>'tel', 'name'=>'comment','placeholder'=>'Ваш комментарий'])
        </label>
        <div class="input__wrapper">
            <span class="modal-file__text">Прикрепить файл</span>
            <input id="modal-file__input-file" class="modal-file__input-file" type="file">
            <label class="modal-file__label-wrap" for="modal-file__input-file">
                <span class="modal-file__format">Файл.png</span>
                <img src="img/input-file-add.svg" alt="">
            </label>
        </div>

        <button class="modal__form-btn modal__file-btn">Отправить</button>
    </form>
    <p class="modal__form-descr">
        Нажимая кнопку «Отправить», я даю свое согласие на обработку моих персональных данных согласно 4 ст. 9 152-ФЗ
    </p>
</div>

<form>



    @if($file)
    <span>{{ $file->getClientOriginalName() }}</span>
    @endif
    <input type="file" wire:model="file">
    <button>Отправить</button>
</form>
