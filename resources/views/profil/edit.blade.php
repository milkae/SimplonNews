@extends('layouts.app')
@section('title')
<title>Simplon News - {{ $user->name }}</title>
@endsection

@section('content')
<div class="ui center aligned grid">
	<div class="nine wide column">
		<div class="ui segment">
			<form class="ui form" action="{{ URL::route('user.profile.edit') }}" method="POST">
				{!! csrf_field() !!}
				<div class="field">
					<label>Pseudo</label>
					<input type="text" name="name" value="{{$user->name}}" class="">
				</div>
				<div class="ui stackable internally celled two column grid">
					<div class="eight wide column">
						<img src="{{$user->avatar?$user->avatar:'http://lorempixel.com/600/600/cats'}}" alt="{{ $user->name }}" class="ui large rounded image">
					<div class="ui  row">
				</div>
					</div>
					<div class="eight wide column">
						<div class="field">
							<label>Nom</label>
							<input type="text" name="nom" value="{{$user->nom}}" class="">
						</div>
						<div class="field">
							<label>Prénom</label>
							<input type="text" name="prenom" value="{{$user->prenom}}" class="">
						</div>
						<div class="field">
							<label>Profession</label>
							<input type="text" name="job" value="{{$user->job}}" class="">
						</div>
						<div class="field">
							<label>Employeur</label>
							<input type="text" name="employeur" value="{{$user->employeur}}" class="">
						</div>
						<div class="field">
							<label>Github</label>
							<input type="text" name="github" value="{{$user->github}}" class="">
						</div>
					</div>
					</div>
				<input type="submit" value="Enregistrer" class="ui pink inverted button">
			</form>
		</div>
	</div>
</div>
@endsection
