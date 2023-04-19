@props([
'type' => 'text',
'placeholder'=>'',
'name',
'add' => '',
'required' => true,
])

<label for="{{ $name }}"
       class="label__input
        @error($name) error @enderror {{ $add }}"
>
    <p class="label__placeholder-required"> @if($required)*@endif</p>
    <input wire:model.defer="{{ $name }}" value="{{ old($name) }}" placeholder="{{ $placeholder  }}" id="{{ $name }}"
           name="{{ $name }}" type="{{ $type }}" class="label__input-input"
    >
</label>

