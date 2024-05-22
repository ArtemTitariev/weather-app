@if ($errors->any())
    <div {{ $attributes->merge(['class' => 'mb-4 text-danger']) }}>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
