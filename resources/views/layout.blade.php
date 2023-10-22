<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>FIPE</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>

<body class="h-full min-h-screen">
    <header class="bg-blue-900 mb-4">
        <div class="container mx-auto">
            <h2 class="text-5xl leading-snug text-white inline pr-4">Fipe</h2>
            <a href="/" class="text-3xl leading-snug text-white inline hover:font-bold">Home</a>
        </div>
    </header>
    <section class="h-full">
    @yield('content')
    </section>
</body>

@stack('scripts')

</html>
