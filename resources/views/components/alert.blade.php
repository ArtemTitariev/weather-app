@if ($errors->any())
    <div id="error-alert" class="bg-red-100 border border-red-400 text-danger px-4 py-3 rounded relative mb-4" role="alert">
        <strong class="font-bold">{{ __('Whoops!') }}</strong>
        <ul class="mt-3 list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <span onclick="closeAlert()" class="absolute top-0 bottom-0 right-0 px-4 py-3">
            <svg class="fill-current h-6 w-6 text-danger" role="button" viewBox="0 0 20 20"><path d="M14.348 14.849a1 1 0 01-1.414 0L10 11.414l-2.934 2.935a1 1 0 11-1.414-1.415l2.934-2.934-2.934-2.934a1 1 0 011.414-1.415L10 8.586l2.934-2.935a1 1 0 111.414 1.415L11.414 10l2.934 2.934a1 1 0 010 1.415z"/></svg>
        </span>
    </div>
    <script>
        function closeAlert() {
            document.getElementById('error-alert').style.display = 'none';
        }
    </script>
@endif