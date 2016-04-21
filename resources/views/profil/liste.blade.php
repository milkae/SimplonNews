@extends('layouts.app')

@section('content')
    @if (count($users) > 0)
		<h3 class="ui header">Liste des Utilisateurs</h3>
		<div class="ui middle aligned celled list">
		@foreach($users as $user)
		  <div class="item">
		    <img class="ui avatar image" src="{{$user->avatar?$user->avatar:'http://lorempixel.com/600/600/cats'}}">
		    <div class="content">
		      <a class="header" href="{{ URL::route('user.profile', [$user->id]) }}">{{ $user->name }}</a>
		    </div>
		  </div>
		@endforeach
    @endif
@endsection