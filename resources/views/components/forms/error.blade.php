@if ($errors->any())
    <div {{ $attributes->merge(['class' => 'mb-4 text-danger']) }}>
        {{ __('Fix the following errors:') }}
    </div>
@endif
