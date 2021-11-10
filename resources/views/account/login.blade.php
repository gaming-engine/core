<html lang="en">
<head>
    <title>{{ $siteConfiguration->name }}</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content="Log into {{ $siteConfiguration->name }}"/>
    <meta name="author" content="{{ $siteConfiguration->name }}"/>
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css"/>
    <link href="{{ mix('/public/css/gaming-engine.css', 'modules/framework') }}" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ $siteConfiguration->logoUrl }}"/>
</head>
<body class="font-sans antialiased text-gray-900">
<div>
    <div class="min-h-screen bg-white flex">
        <div class="flex-1 flex flex-col justify-center py-12 px-4 sm:px-6 lg:flex-none lg:px-20 xl:px-24">
            <div class="mx-auto w-full max-w-sm">
                <div>
                    <a href="/">
                        <x-ge:c-logo class="d-block mx-auto"/>
                    </a>
                    <h2 class="mt-6 text-3xl leading-9 font-extrabold text-gray-900">
                        {{ __('gaming-engine:core::authentication.login.title') }}
                    </h2>
                </div>
                <div class="mt-8">
                    <div class="mt-6">
                        <form action="#" method="POST">
                            <div>
                                <label class="block text-sm font-medium leading-5 text-gray-700" for="email">
                                    {{ __('gaming-engine:core::authentication.login.email.label') }}
                                </label>
                                <div class="mt-1 rounded-md shadow-sm">
                                    <input
                                        class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                                        id="email" type="email" required=""
                                        placeholder="{{ __('gaming-engine:core::authentication.login.email.placeholder') }}"
                                    />
                                </div>
                            </div>
                            <div class="mt-6">
                                <label class="block text-sm font-medium leading-5 text-gray-700"
                                       for="password">
                                    {{ __('gaming-engine:core::authentication.login.password.label') }}
                                </label>
                                <div class="mt-1 rounded-md shadow-sm">
                                    <input
                                        class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                                        id="password" type="password" required=""
                                        placeholder="{{ __('gaming-engine:core::authentication.login.password.placeholder') }}"
                                    />
                                </div>
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
                            <div class="mt-6"><span class="block w-full rounded-md shadow-sm">
                      <button
                          class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out"
                          type="submit">
                          {{ __('gaming-engine:core::authentication.login.action') }}
                      </button></span></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="hidden lg:block relative w-0 flex-1"><img class="absolute inset-0 h-full w-full object-cover"
                                                              src="https://images.unsplash.com/photo-1505904267569-f02eaeb45a4c?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=1908&amp;q=80"
                                                              alt=""/></div>
    </div>
</div>
</body>
</html>
