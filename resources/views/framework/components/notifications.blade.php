@if (session('status'))
    <div>
        {{ session('status') }}
    </div>
@endif

@if ($errors->any())
    <x-ge:c-error-alert :title="__('gaming-engine:core::notifications.error.title')">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </x-ge:c-error-alert>
@endif
