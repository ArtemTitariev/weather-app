@props(['type' => 'text', 'name', 'value' => '', 'class' => 'w-full p-2 border rounded mt-1', 'errorClass' => 'border-danger'])

@php
    // Об'єднання стилів у залежності від наявності помилки
    $inputClass = $class;
    if ($errors->has($name)) {
        $inputClass .= ' ' . $errorClass;
    }
@endphp

<input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" value="{{ old($name, $value) }}"
       class="{{ $inputClass }}"
       {{ $attributes }}>

@error($name)
    <x-forms.error-message :message="$message" />
@enderror
