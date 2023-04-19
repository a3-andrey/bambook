<label for="phone" class="label__input @error('phone') error @enderror">
    <p class="label__placeholder-required">*</p>
    <span wire:ignore>
        <input type="tel"
               value="{{ \Illuminate\Support\Facades\Auth::check() ? \Illuminate\Support\Facades\Auth::user()->phone:null }}"
               oninput="@this.set('phone',this.value)"
               placeholder="Номер телефона" name="phone" class="label__input-input">
    </span>
</label>
@push('scripts')
    <script>
        window.addEventListener('clear-phone', event => {
            $('[type="tel"]').val('');
        })
    </script>
@endpush
