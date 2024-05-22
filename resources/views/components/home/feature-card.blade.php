@props(['title', 'description'])

<div class="bg-white p-4 rounded-lg shadow-md w-full h-48 flex flex-col justify-center items-center">
    <h3 class="text-xl font-bold text-secondary mb-2">{{ $title }}</h3>
    <p class="text-gray text-center">{{ $description }}</p>
</div>

