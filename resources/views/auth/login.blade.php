@extends('layouts.app')

@section('content')

<div class="mid-content" style="position: relative; top: 25%;">
    <!-- /* ne pas oublié d'enlever le style dans la balise*/ -->
    <div class="ui middle aligned center aligned grid">
        <div class="four wide column">
            <h2 class="ui teal image header">Connexion</h2>
            <form class="ui large form" role="form" method="POST" action="{{ url('/login') }}">
                {!! csrf_field() !!}
                
                

                <div class="ui stacked segment">
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <div class="field">
                            <div class="ui left icon input">
                                <i class="user icon"></i>
                                <input type="text" name="email" placeholder="E-mail address">
                            </div>

                            @if ($errors->has('email'))
                            <div class="ui negative message">
                                <div class="header">{{ $errors->first('email') }}</div>
                            </div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">   
                        <div class="field">
                            <div class="ui left icon input">
                                <i class="lock icon"></i>
                                <input type="password" name="password" placeholder="Password">
                            </div>

                            @if ($errors->has('password'))
                            <div class="ui negative message">
                                <div class="header">{{ $errors->first('password') }}</div>
                            </div>
                            @endif
                        </div>
                    </div>
                    <button class="ui fluid large inverted pink submit button">Login</button>
                </div>
                <div class="ui message">
                    <a href="{{url('/auth/github')}}">Se connecter avec Github</a>
                </div>
                <div class="ui message">
                    <a href="{{url('/auth/github')}}">Github</a>
                    <a class="" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
                </div>
            </form>
        </div>
    </div>
</div>
