<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Simplon News</title>
    <link rel="stylesheet" href="../../../node_modules/semantic-ui-css/semantic.min.css">
    {{-- <link rel="stylesheet" href=" {{elixir('css/app.css')}} "> --}}
</head>
<body id="app-layout">
    <div class="ui container grid">
    <div class="column">
        <nav class="ui large top fixed pointing menu">
        <div class="ui container">
                <a href="{{ url('/') }}" class="item"><h2 class="header">SimploNewZ</h2></a>
                <div class="right menu">
                    <a href="{{ url('/liste') }}" class="item">Newz</a>
                    <a href="{{ url('/profil') }}" class="item">User</a>
                    <a href="{{ url('/login') }}" class="item">Login</a>
                    <a href="{{ url('/register') }}" class="item">Sign Up</a>
                    <a href="#" class="item">
                        <button class="ui pink button">Post</button>
                    </a>
                </div>
            </div>
        </nav>
    </div>

    @yield('content')
    </div>
    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
