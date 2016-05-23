<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('title')
    <link rel="stylesheet" href="{{url('assets/semantic-ui/semantic.min.css') }}">
    <link rel="stylesheet" href=" {{url('css/app.css')}} ">
</head>
<body id="app-layout">
    <nav class="ui fixed menu">
        <a href="{{ url('/') }}" class="item"><h1 class="header">SimploNews</h1></a>
        <div class="right menu">
            <a href="{{ url('/liste/users') }}" class="item">Utilisateurs</a>
            @if (Auth::guest())
            <a href="{{ url('/login') }}" class="item">Connexion</a>
            @else
                @if(Auth::user()->hasRole('admin'))
                    <a href="{{ url('/admin') }}" class="item">Administration</a>
                @endif  
            <div class="ui dropdown item">                       
                {{ Auth::user()->name }} 
                <i class="dropdown icon"></i>
                <div class="menu">
                    <a class="item" href="{{ URL::route('user.profile', [Auth::user()->id]) }}" data-text="profil">Profil</a>
                    <a class="item" href="{{ url('/logout') }}" data-text="logout">Déconnexion</a>
                </div>
            </div>
            <div class="item">    
            <a href="{{ URL::route('link.form') }}" class="ui pink button ">Poster un lien</a>
            </div>
            @endif
        </div>
    </nav>
        <section class="ui main container">
        @yield('content')
        </section>
    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="{{url('assets/semantic-ui/semantic.min.js') }}"></script>
    <script src="{{ url('js/app.js') }}"></script>
</body>
</html>
