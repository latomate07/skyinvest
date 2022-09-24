<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SkyInvest</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/1ba83f2b65.js" crossorigin="anonymous"></script> 
    <script src="{{ asset('assets/js/app.js') }}" defer></script>
    @auth
    <script>sessionStorage.setItem('user_id', {{ auth()->user()->id }})</script>
    @endauth
</head>
<body>
    <div class="container">
        @include('partials.header')
        @yield('content')
        @include('partials.footer')
    </div>
    @yield('scripts')
</body>
</html>