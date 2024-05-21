@if ($errors->any())
    <div {{ $attributes->merge(['class' => 'mb-4 text-red-600']) }}>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
