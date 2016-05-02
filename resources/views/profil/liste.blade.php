@extends('layouts.app')
@section('title')
    <title>Simplon News - Utilisateurs</title>
@endsection

@section('content')
    @if (count($users) > 0)
		<h3 class="ui header">Liste des Utilisateurs</h3>
		<div class="ui large middle aligned celled list">
		@foreach($users as $user)
			<div class="item">
			    <img class="ui avatar image" src="{{$user->avatar?$user->avatar:'http://lorempixel.com/600/600/cats'}}" alt="{{ $user->name}}" />
			    <div class="content">
			      <a class="header" href="{{ URL::route('user.profile', [$user->id]) }}">{{ $user->name }}</a>
			      <div class="description">Inscrit le {{ $user->created_at->format('d/m/y') }}</div>
			    </div>
			    <div class="right floated">
				    @foreach($user->roles as $role)
						<div class="ui label {{$user->hasRole($role->name)?$role->color:''}}">{{ ucfirst(trans($role->name)) }}</div>
					@endforeach
				</div>
			</div>
		@endforeach
		</div>
    @endif
@endsection