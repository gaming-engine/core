<x-ge:c:a-layout>
    <div class="flex-1 flex flex-col justify-center py-12 px-4 sm:px-6 lg:flex-none lg:px-20 xl:px-24">
        <div class="mx-auto w-full max-w-sm">
            <div>
                <a href="/">
                    <x-ge:c-logo class="d-block mx-auto"/>
                </a>
                <h2 class="mt-6 text-3xl leading-9 font-extrabold text-gray-900">
                    {{ __('gaming-engine:core::authentication.forgot-password.title') }}
                </h2>
            </div>

            <x-ge:c-notifications/>

            <div class="mt-8">
                <div class="mt-6">
                    <x-ge:c-information-alert class="mb-4">
                        {{ __('gaming-engine:core::authentication.forgot-password.details') }}
                    </x-ge:c-information-alert>

                    <v-form action="{{ route('password.email') }}" method="POST">
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
                        <div class="mt-6 flex items-center justify-between">
                            <div class="text-sm leading-5">
                                <a
                                    class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150"
                                    href="{{ route('password.request') }}">
                                    {{ __('gaming-engine:core::authentication.login.forgot') }}
                                </a>
                            </div>
                        </div>
                        <div class="mt-6">
                        <span class="block w-full rounded-md shadow-sm">
                            <button
                                class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out"
                                type="submit"
                            >
                                {{ __('gaming-engine:core::authentication.forgot-password.action') }}
                            </button>
                        </span>
                        </div>
                    </v-form>
                </div>
            </div>
        </div>
    </div>
    <div class="hidden lg:block relative w-0 flex-1">
        <img
            class="absolute inset-0 h-full w-full object-cover"
            src="https://images.unsplash.com/photo-1505904267569-f02eaeb45a4c?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1908&q=80"
            alt=" {{ $siteConfiguration->name }} Preview"
            title="{{ $siteConfiguration->name }} Preview"
        >
    </div>
</x-ge:c:a-layout>
