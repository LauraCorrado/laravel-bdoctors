<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'BDoctors') }}</title>
    <link rel="icon" href="{{ Vite::asset('/resources/img/logo.png') }}" type="image/x-icon">


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Usando Vite + Validate -->
    @vite(['resources/js/app.js', 'resources/js/validation.js'])

    {{-- jquery --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    {{-- Braintree --}}
    {{-- <script src="https://js.braintreegateway.com/web/dropin/1.30.1/js/dropin.min.js"></script> --}}
   
    <script src="https://js.braintreegateway.com/web/dropin/1.30.1/js/dropin.min.js"></script>
    <script src="https://js.braintreegateway.com/web/3.87.0/js/client.js"></script>
</head>

<body>
    <div id="app">
        @include('partials.header')
        <main>
            @yield('content')
        </main>
    </div>
</body>

</html>