<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Gaming Engine</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="{{ asset('css/framework/gaming-engine.css') }}" rel="stylesheet">
</head>
<body class="font-sans antialiased text-gray-900">
<div class="pt-4">
    <img
        class="w-auto d-block m-auto"
        src="/images/framework/logo.svg"
        title="Gaming Engine"
        alt="Gaming Engine"
    />
</div>

<div class="py-16 xl:py-36 px-4 sm:px-6 lg:px-8 bg-white overflow-hidden">
    <div class="max-w-max-content lg:max-w-7xl mx-auto">
        <div class="relative z-10 mb-8 md:mb-2 md:px-6">
            <div class="text-base max-w-prose lg:max-w-none">
                <p class="leading-6 text-indigo-600 font-semibold tracking-wide uppercase">Transactions</p>
                <h1 class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl sm:leading-10">
                    A better way to send money</h1>
            </div>
        </div>
        <div class="relative">
            <svg class="hidden md:block absolute top-0 right-0 -mt-20 -mr-20" width="404" height="384" fill="none"
                 viewBox="0 0 404 384">
                <defs>
                    <pattern id="95e8f2de-6d30-4b7e-8159-f791729db21b" x="0" y="0" width="20" height="20"
                             patternUnits="userSpaceOnUse">
                        <rect class="text-gray-200" x="0" y="0" width="4" height="4" fill="currentColor"></rect>
                    </pattern>
                </defs>
                <rect width="404" height="384" fill="url(#95e8f2de-6d30-4b7e-8159-f791729db21b)"></rect>
            </svg>
            <svg class="hidden md:block absolute bottom-0 left-0 -mb-20 -ml-20" width="404" height="384" fill="none"
                 viewBox="0 0 404 384">
                <defs>
                    <pattern id="7a00fe67-0343-4a3c-8e81-c145097a3ce0" x="0" y="0" width="20" height="20"
                             patternUnits="userSpaceOnUse">
                        <rect class="text-gray-200" x="0" y="0" width="4" height="4" fill="currentColor"></rect>
                    </pattern>
                </defs>
                <rect width="404" height="384" fill="url(#7a00fe67-0343-4a3c-8e81-c145097a3ce0)"></rect>
            </svg>
            <div class="relative md:bg-white md:p-6">
                <div class="lg:grid lg:grid-cols-2 lg:gap-6 mb-8">
                    <div class="prose prose-lg text-gray-500 mb-6 lg:max-w-none lg:mb-0">
                        <p>Ultrices ultricies a in odio consequat egestas rutrum. Ut vitae aliquam in ipsum. Duis nullam
                            placerat cursus risus ultrices nisi, vitae tellus in. Qui non fugiat aut minus aut rerum.
                            Perspiciatis iusto mollitia iste minima soluta id.</p>
                        <p>Erat pellentesque dictumst ligula porttitor risus eget et eget. Ultricies tellus felis id
                            dignissim eget. Est augue <a href="#">maecenas</a> risus nulla ultrices congue nunc tortor.
                            Eu leo risus porta integer suspendisse sed sit ligula elit.</p>
                        <ol>
                            <li>Integer varius imperdiet sed interdum felis cras in nec nunc.</li>
                            <li>Quam malesuada odio ut sit egestas. Elementum at porta vitae.</li>
                        </ol>
                        <p>Amet, eu nulla id molestie quis tortor. Auctor erat justo, sed pellentesque scelerisque
                            interdum blandit lectus. Nec viverra amet ac facilisis vestibulum. Vestibulum purus nibh ac
                            ultricies congue.</p>
                    </div>
                    <div class="prose prose-lg text-gray-500">
                        <p>Erat pellentesque dictumst ligula porttitor risus eget et eget. Ultricies tellus felis id
                            dignissim eget. Est augue maecenas risus nulla ultrices congue nunc tortor.</p>
                        <p>Eu leo risus porta integer suspendisse sed sit ligula elit. Elit egestas lacinia sagittis
                            pellentesque neque dignissim vulputate sodales. Diam sed mauris felis risus, ultricies
                            mauris netus tincidunt. Mauris sit eu ac tellus nibh non eget sed accumsan. Viverra ac sed
                            venenatis pulvinar elit. Cras diam quis tincidunt lectus. Non mi vitae, scelerisque felis
                            nisi, netus amet nisl.</p>
                        <p>Eu eu mauris bibendum scelerisque adipiscing et. Justo, elementum consectetur morbi eros,
                            posuere ipsum tortor. Eget cursus massa sed velit feugiat sed ut. Faucibus eros mauris morbi
                            aliquam nullam. Scelerisque elementum sit magna ullamcorper dignissim pretium.</p>
                    </div>
                </div>
                <div class="inline-flex rounded-md shadow"><a
                        class="flex items-center justify-center px-5 py-3 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo transition duration-150 ease-in-out"
                        href="#">Contact sales</a></div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
