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
    <script src="{{ mix('/public/js/app.js', 'modules/framework') }}" defer></script>
</head>
<body class="font-sans antialiased text-gray-900">
<div>
    <div class="min-h-screen bg-white flex" id="app">
        {{ $slot }}
    </div>
</div>
</body>
</html>
