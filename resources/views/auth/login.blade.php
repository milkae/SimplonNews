@extends('layouts.app')
@section('title')
    <title>Simplon News - Connexion</title>
@endsection

@section('content')
<div class="ui middle aligned center aligned grid">
    <div class="six wide column">
        <h2 class="ui teal image header">Connexion</h2>
        <div class="ui stacked segment">
            <form class="ui large error form" role="form" method="POST" action="{{ url('/login') }}">
                {!! csrf_field() !!}
                <div class="field {{ $errors->has('email') ? 'error' : '' }}">
                    <div class="ui left icon input">
                        <i class="at icon"></i>
                        <input type="text" name="email" placeholder="E-mail address" value="{{ old('email') }}">
                    </div>
                    @if ($errors->has('email'))
                    <div class="ui negative message">
                        <p>{{ $errors->first('email') }}</p>
                    </div>
                    @endif
                </div>  
                <div class="field {{ $errors->has('password') ? 'error' : '' }}">
                    <div class="ui left icon input">
                        <i class="lock icon"></i>
                        <input type="password" name="password" placeholder="Password">
                    </div>
                    @if ($errors->has('password'))
                    <div class="ui negative message">
                        <p>{{ $errors->first('password') }}</p>
                    </div>
                    @endif
                </div>
                <p><a href="{{ url('/password/reset') }}">Mot de passe oublié ?</a></p>
                <button class="ui fluid large inverted pink submit button">Se connecter</button>
            </form>
            <div class="ui message">
            <a class="" href="{{url('/auth/github')}}">Se connecter avec Github</a>
            </div>
            <div class="ui message">
                <a href="{{url('/register')}}">Pas encore inscrit ?</a>
            </div>
        </div>
    </div>
</div>
@endsection