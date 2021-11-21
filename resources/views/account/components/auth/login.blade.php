<div class="mx-auto w-full max-w-sm">
    <div>
        <a href="/">
            <x-ge:c-logo class="d-block mx-auto"/>
        </a>
        <h2 class="mt-6 text-3xl leading-9 font-extrabold text-gray-900">
            {{ __('gaming-engine:core::authentication.login.title') }}
        </h2>
    </div>

    <x-ge:c-notifications/>

    <div class="mt-8">
        <div class="mt-6">
            <v-form action="{{ route('login') }}" method="POST">
                @csrf
                <div>
                    <input-field
                        :required="true"
                        placeholder="{{ __('gaming-engine:core::authentication.login.email.placeholder') }}"
                        label="{{ __('gaming-engine:core::authentication.login.email.label') }}"
                        type="email"
                        name="email"
                        id="email"></input-field>
                </div>
                <div class="mt-6">
                    <password-field
                        :required="true"
                        placeholder="{{ __('gaming-engine:core::authentication.login.password.placeholder') }}"
                        label="{{ __('gaming-engine:core::authentication.login.password.label') }}"
                        name="password"
                        :show-indicator="false"
                        id="password"></password-field>
                </div>
                <div class="mt-6 flex items-center justify-between">
                    <div class="flex items-center">
                        <input class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded"
                               id="remember_me" name="remember_me" type="checkbox"/>
                        <label class="ml-2 block text-sm text-gray-900" for="remember_me">
                            {{ __('gaming-engine:core::authentication.login.remember.label') }}
                        </label>
                    </div>
                    <div class="text-sm leading-5"><a
                            class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150"
                            href="#">
                            {{ __('gaming-engine:core::authentication.login.forgot') }}
                        </a></div>
                </div>
                <div class="mt-6">
                    <span class="block w-full rounded-md shadow-sm">
                        <button
                            class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out"
                            type="submit"
                        >
                            {{ __('gaming-engine:core::authentication.login.action') }}
                        </button>
                    </span>
                </div>
            </v-form>
        </div>
    </div>
</div>
