@php
    $class = 'w-full p-2 border rounded mt-1';

    if ($errors->has($name)) {
        $class .= ' border-danger';
    }
@endphp

<input {{ $attributes->merge([
    'value' => old($name),
    'class' => $class,
    ]) }}>

@error($name)
    <x-forms.error-message :message="$message" />
@enderror
