@extends('layouts.app')

@section('content')

<div class="mid-content" style="position: relative; top: 25%;">
    <!-- /* ne pas oublié d'enlever le style dans la balise*/ -->
    <div class="ui middle aligned center aligned grid">
        <div class="four wide column">
            <h2 class="ui teal image header">Inscription</h2>
            <form class="ui large form" role="form" method="POST" action="{{ url('/register') }}">
                {!! csrf_field() !!}

                <div class="ui stacked segment">
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <div class="field">
                            <div class="ui left icon input">
                                <i class="user icon"></i>
                                <input type="text" name="name" placeholder="Nom">
                                
                                @if ($errors->has('name'))
                                <div class="ui negative message">
                                    <div class="header">{{ $errors->first('name') }}</div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <div class="field">
                            <div class="ui left icon input">
                                <i class="user icon"></i>
                                <input type="text" name="email" placeholder="E-mail address">

                                @if ($errors->has('email'))
                                <div class="ui negative message">
                                    <div class="header">{{ $errors->first('email') }}</div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <div class="field">
                            <div class="ui left icon input">
                                <i class="lock icon"></i>
                                <input type="password" name="password" placeholder="Password">
                                @if ($errors->has('password'))
                                <div class="ui negative message">
                                    <div class="header">{{ $errors->first('password') }}</div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        <div class="field">
                            <div class="ui left icon input">
                                <i class="lock icon"></i>
                                <input type="password" name="password_confirmation" placeholder="Confirm Password">

                                @if ($errors->has('password_confirmation'))
                                <div class="ui negative message">
                                    <div class="header">{{ $errors->first('password_confirmation') }}</div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <br>
                    <button class="ui fluid large inverted pink submit button">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>
