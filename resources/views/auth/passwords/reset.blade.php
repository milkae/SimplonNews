@extends('layouts.app')

@section('content')
<div class="ui middle aligned center aligned grid">
    <div class="six wide column">
        <h2 class="ui teal image header">Reset Password</h2>
        @if (session('status'))
            <div class="ui succes message">
                {{ session('status') }}
            </div>
        @endif
        <form class="ui large error form" role="form" method="POST" action="{{ url('/password/reset') }}">
            {!! csrf_field() !!}
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="ui segment">
                <div class="field {{ $errors->has('email') ? 'error' : '' }}">
                    <div class="ui left icon input">
                        <i class="email icon"></i>
                        <input type="text" name="email" placeholder="E-mail address">
                    </div>
                    @if ($errors->has('email'))
                    <div class="ui error message">
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
                    <div class="ui error message">
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
                    <div class="ui error message">
                        <p>{{ $errors->first('password_confirmation') }}</p>
                    </div>
                    @endif
                </div>
                <button class="ui fluid large inverted blue submit button">Reset Password</button>
            </div>
        </form>
    </div>
</div>
@endsection
