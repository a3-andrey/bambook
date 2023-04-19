<div class="footer-form">
    <h3 class="footer-title">Связаться с нами!</h3>
    <form >
        <div>
            <input style="color: #fff" type="text" wire:model.defer="name" placeholder="Ваше имя">
        </div>
        @error('name') <span style="color: red;">{{$message }}</span> @enderror
        <div wire:ignore>
            <input wire:ignore type="tel"
                   style="color: #fff"
                   onchange="@this.set('phoneContact',this.value)"
                   oninput="@this.set('phoneContact',this.value)"
                   placeholder="Номер телефона" >
        </div>

        @push('scripts')
            <script>
                window.addEventListener('clearPhone', event => {
                    $('[type="tel"]').val('');
                })
            </script>
        @endpush


        @error('phoneContact') <span style="color: red;">{{$message }}</span> @enderror
        @if(session('message-contact')) <span style="display:block;color: green;margin-bottom: 20px;">{{ session('message-contact') }}</span> @endif
        <div  class="label-block">
            <input id="privacy" type="checkbox" wire:model="privacy" checked >
            <label for="privacy">
                <p>Согласен с Политикой конфиденциальности</p>
            </label>
            @error('privacy') <span style="color: red;">{{$message }}</span> @enderror
        </div>
        <div>
            <button wire:click.prevent="submit" class="button" type="submit">
                Отправить
                <svg width="8" height="15" class="icon">
                  <use xlink:href="#arrow"></use>
                </svg>
            </button>
        </div>
    </form>
</div>
