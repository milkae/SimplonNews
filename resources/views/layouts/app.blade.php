<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Simplon News</title>
<!--     <link rel="stylesheet" href="{{url('assets/semantic-ui/semantic.min.css') }}">
 -->    <link rel="stylesheet" href=" {{url('css/app.css')}} ">
</head>
<body id="app-layout">
    <div class="ui container grid">
        <div class="column">
            <nav class="ui large top fixed menu">
                <div class="ui container">
                    <a href="{{ url('/') }}" class="item"><h2 class="header">SimploNewZ</h2></a>
                    <div class="right menu">
                        <a href="{{ url('/liste/users') }}" class="item">Users</a>
                        @if (Auth::guest())
                        <a href="{{ url('/login') }}" class="item">Login</a>
                        <a href="{{ url('/register') }}" class="item">Sign Up</a>
                        @else  
                        <div class="ui dropdown item">                       
                            {{ Auth::user()->name }} 
                            <i class="dropdown icon"></i>
                            <div class="menu">
                                <a class="item" href="{{ url('/profil') }}" data-text="profil">Profil</a>
                                <a class="item" href="{{ url('/logout') }}" data-text="logout">Logout</a>
                            </div>
                        </div>
                        @endif    
                        <a href="/poster" class="item">
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
    <script src="{{url('assets/semantic-ui/semantic.min.js') }}"></script>
    <script src="{{ url('js/app.js') }}"></script>
</body>
</html>
