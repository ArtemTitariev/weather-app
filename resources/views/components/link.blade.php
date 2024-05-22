<a {{ $attributes->merge(
    ['class' =>'text-primary hover:text-accent'
    ]) }}>
    {{ $slot }}
</a>
