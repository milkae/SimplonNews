@extends('layouts.app')

<!-- Main Content -->
@section('content')
<div class="ui middle aligned center aligned grid">
    <div class="six wide column">
        <h2 class="ui teal image header">Reset Password</h2>
        @if (session('status'))
            <div class="ui succes message">
                {{ session('status') }}
            </div>
        @endif
        <form class="ui large error form" role="form" method="POST" action="{{ url('/password/email') }}">
            {!! csrf_field() !!}
            <div class="ui segment">
                <div class="field {{ $errors->has('email') ? 'error' : '' }}">
                    <div class="ui left icon input">
                        <i class="user icon"></i>
                        <input type="text" name="email" placeholder="E-mail address">
                    </div>
                    @if ($errors->has('email'))
                    <div class="ui negative message">
                        <p>{{ $errors->first('email') }}</p>
                    </div>
                    @endif
                </div>
                <button class="ui fluid large inverted blue submit button">Send primary reset link</button>
            </div>
        </form>
    </div>
</div>
@endsection
