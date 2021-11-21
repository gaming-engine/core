<div class="mx-auto w-full max-w-sm">
    <div>
        <a href="/">
            <x-ge:c-logo class="d-block mx-auto"/>
        </a>
        <h2 class="mt-6 text-3xl leading-9 font-extrabold text-gray-900">
            {{ __('gaming-engine:core::authentication.register.title') }}
        </h2>
    </div>
    <div class="mt-8">
        @if (session('status'))
            <div>
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div>
                <div>{{ __('Whoops! Something went wrong.') }}</div>

                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="mt-6">
            <v-form action="{{ route('login') }}" method="POST">
                @csrf
                <div>
                    <input-field
                        :required="true"
                        placeholder="{{ __('gaming-engine:core::authentication.register.email.placeholder') }}"
                        label="{{ __('gaming-engine:core::authentication.register.email.label') }}"
                        type="email"
                        name="email"
                        id="email"></input-field>
                </div>
                <div class="mt-6">
                    <input-field
                        :required="true"
                        placeholder="{{ __('gaming-engine:core::authentication.register.name.placeholder') }}"
                        label="{{ __('gaming-engine:core::authentication.register.name.label') }}"
                        type="text"
                        name="name"
                        id="name"></input-field>
                </div>
                <div class="mt-6">
                    <password-field
                        :required="true"
                        :show-indicator="true"
                        placeholder="{{ __('gaming-engine:core::authentication.register.password.placeholder') }}"
                        label="{{ __('gaming-engine:core::authentication.register.password.label') }}"
                        name="password"
                        id="password"></password-field>
                </div>
                <div class="mt-6">
                    <password-field
                        :required="true"
                        :show-indicator="true"
                        placeholder="{{ __('gaming-engine:core::authentication.register.password-confirmation.placeholder') }}"
                        label="{{ __('gaming-engine:core::authentication.register.password-confirmation.label') }}"
                        name="password-confirmed"
                        id="password-confirmed"></password-field>
                </div>
                <div class="mt-6 flex items-center justify-between">
                    <div class="text-sm leading-5">
                        <a
                            class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150"
                            href="{{ route('login') }}">
                            {{ __('gaming-engine:core::authentication.register.login') }}
                        </a>
                    </div>
                </div>
                <div class="mt-6">
                    <span class="block w-full rounded-md shadow-sm">
                        <button
                            class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out"
                            type="submit"
                        >
                            {{ __('gaming-engine:core::authentication.register.action') }}
                        </button>
                    </span>
                </div>
            </v-form>
        </div>
    </div>
</div>
