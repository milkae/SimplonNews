@extends('layouts.app')

@section('content')
<div class="ui middle aligned center aligned grid">
    <div class="six wide column">
        <h2 class="ui teal image header">Connexion</h2>
        <form class="ui large error form" role="form" method="POST" action="{{ url('/login') }}">
            {!! csrf_field() !!}
            <div class="ui stacked segment">
                <div class="field {{ $errors->has('email') ? 'error' : '' }}">
                    <div class="ui left icon input">
                        <i class="email icon"></i>
                        <input type="text" name="email" placeholder="E-mail address">
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
                <button class="ui fluid large inverted pink submit button">Login</button>
                <div class="ui message">
                    <a href="{{url('/auth/github')}}">Se connecter avec Github</a>
                </div>
                <div class="ui message">
                    <a class="" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection