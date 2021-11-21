@if (session('status'))
    <div>
        {{ session('status') }}
    </div>
@endif

@if ($errors->any())
    <div
        class="
            my-3
            block
            text-sm text-left text-red-600
            bg-red-500 bg-opacity-10
            border border-red-400
            h-12
            flex
            items-center
            p-4
            rounded-md
          "
        role="alert"
    >
        <div>{{ __('gaming-engine:core::notifications.error.title') }}</div>

        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
