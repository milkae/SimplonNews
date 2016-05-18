@extends('layouts.app')
@section('title')
    <title>Simplon News - Inscription</title>
@endsection

@section('content')
<div class="ui middle aligned center aligned grid">
    <div class="six wide column">
        <h2 class="ui teal image header">Inscription</h2>
        <form class="ui large form" role="form" method="POST" action="{{ url('/register') }}">
            {!! csrf_field() !!}
            <div class="ui stacked segment">
                <div class="field {{ $errors->has('name') ? 'error' : '' }}">
                    <div class="ui left icon input">
                        <i class="user icon"></i>
                        <input type="text" name="name" placeholder="Nom" value="{{ old('name') }}">
                    </div>
                    @if ($errors->has('name'))
                    <div class="ui negative message">
                        <p>{{ $errors->first('name') }}</p>
                    </div>
                    @endif
                </div>
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
                <div class="field {{ $errors->has('password_confirmation') ? 'error' : '' }}">
                    <div class="ui left icon input">
                        <i class="lock icon"></i>
                        <input type="password" name="password_confirmation" placeholder="Confirm Password">
                    </div>
                    @if ($errors->has('password_confirmation'))
                    <div class="ui negative message">
                        <p>{{ $errors->first('password_confirmation') }}</p>
                    </div>
                    @endif
                </div>
                <button class="ui fluid large inverted pink submit button">Sign in</button>
                <div class="ui message">
                    <a href="{{url('/auth/github')}}">Se connecter avec Github</a>
                </div>
                <div class="ui message">
                    <a href="{{url('/login')}}">Déjà inscrit ?</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
