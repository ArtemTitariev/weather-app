@props([
    'title' => __('Notice'), 
    'message'
])

<div {{ $attributes->merge([
    'class' => 'bg-yellow-100 border border-warning text-secondary px-4 py-3 rounded relative mb-4',
    'role' => 'alert',
    ]) }}>
    
    <strong class="font-bold">{{ $title }}</strong>
    <span class="block sm:inline">{{ $message }}</span>
</div>