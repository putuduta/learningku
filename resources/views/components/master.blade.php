<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="/storage/assets/logo.png">

    <title>{{ $title }}</title>
    <script src="https://cdn.ckeditor.com/ckeditor5/11.0.1/classic/ckeditor.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="{{ mix('js/app.js') }}"></script>
</head>

<body class="bg-light">
    <div id="app">
        <x-alert></x-alert>
        @if (isset($navbar))
            <x-navbar></x-navbar>
        @endif
        @if (isset($navbarUser))
            <x-navbar-user></x-navbar-user>
        @endif
        @if (isset($sidebar))
            <main id="toggled" class="page-wrapper bg-light toggled">
                <x-sidebar></x-sidebar>
                <div class="page-content">
                    {{ $slot }}
                </div>
            </main>
        @else
            <main>
                {{ $slot }}
            </main>
        @endif
    </div>
</body>

</html>
