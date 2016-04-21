@extends('layouts.app')

@section('content')
    @if (count($users) > 0)
		<h3>Liste des Utilisateurs</h3>
		@foreach($users as $user)
		<a href="{{ URL::route('user.profile', [$user->id]) }}">{{ $user->name }}</a>
		@endforeach
    @endif
@endsection