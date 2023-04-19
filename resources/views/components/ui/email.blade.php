<label for="email" class="label__input @error('email') error @enderror">
    <p class="label__placeholder-required">*</p>
    <span wire:ignore>
        <input value="{{ \Illuminate\Support\Facades\Auth::check() ? \Illuminate\Support\Facades\Auth::user()->email:null }}"
               @auth disabled @endauth
               oninput="@this.set('email',this.value)"
               placeholder="E-mail" id="email"
               name="email" class="label__input-input"
        >
    </span>
</label>
