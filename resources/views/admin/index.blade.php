@extends('admin.layout')
@section('panel')
  	@if (count($users) > 0)
		<h3 class="ui header">Liste des Utilisateurs</h3>
		<div class="ui middle aligned celled list">
		@foreach($users as $user)
		  <div class="item">
		    <img class="ui avatar image" src="{{$user->avatar?$user->avatar:'http://lorempixel.com/600/600/cats'}}" alt="{{ $user->name }}">
		    <div class="content">
		      <a class="header" href="{{ URL::route('user.profile', [$user->id]) }}">{{ $user->name }}</a>
		    </div>
		    <div class="right floated">
		    	@foreach($roles as $role)
			    	<form class="inlineForm" action="{{ URL::route($user->hasRole($role->name)?'remove.role':'set.role', [$user->id, $role->id]) }}" method="POST">
	                    {!! csrf_field() !!}
			    		<button class="ui button {{$user->hasRole($role->name)?$role->color:''}}">{{ ucfirst(trans($role->name)) }}</button>
			    	</form>
		    	@endforeach
		    </div>
		  </div>
		@endforeach
		</div>
    @endif
@endsection
