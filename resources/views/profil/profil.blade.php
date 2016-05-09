@extends('layouts.app')
@section('title')
    <title>Simplon News - {{ $user->name }}</title>
@endsection

@section('content')
<div class="ui center aligned container stackable grid">
	<div class="nine wide column">
		<div class="ui labels">
		@foreach($user->roles as $role)
			<div class="ui label {{$user->hasRole($role->name)?$role->color:''}}">{{ ucfirst(trans($role->name)) }}</div>
		@endforeach
		</div>
		<div class="ui container stackable segments">
			<div class="ui horizontal container stackable segments">
				<div class="ui left aligned attached padded segment">
					<div class="header dividing">
						<h3>{{ $user->name }}</h3>
					</div>
				</div>
				<div class="ui left aligned attached segment">
						<div class=" header">Karma</div>
						@if($user->karma > 1000)
						<i class="icon diamond big pink"></i>
						@endif
				</div>
				@if (Auth::check() && Auth::user()->id == $user->id && url()->current() !== url('/edit/profil'))
				<div class="ui left aligned attached segment">
					<a href="{{ URL::route('user.profile.edit') }}" class="ui right floated compact labeled icon pink inverted button"><i class="setting icon"></i> Edit </a>
				</div>
				@endif
			</div>
			<div class="ui segment">
				<div class="ui container stackable grid">
					<div class="eight wide column">
						<img src="{{$user->avatar?$user->avatar:'http://lorempixel.com/600/600/cats'}}" alt="{{ $user->name }}" class="ui large rounded image">
					</div>
					<div class="eight wide left aligned verry padded column">
						<div class="ui list">
							<div class="item">
								<div class="content">
									<div class="header">Nom</div>
									{{$user->nom}}
								</div>
							</div>
							<div class="ui divider"></div>

							<div class="item">
								<div class="content">
									<div class="header">Prénom</div>
									{{$user->prenom}}
								</div>
							</div>
							<div class="ui divider"></div>

							<div class="item">
								<div class="content">
									<div class="header">Profession</div>
									{{$user->job}}
								</div>
							</div>
							<div class="ui divider"></div>

							<div class="item">
								<div class="content">
									<div class="header">Employeur</div>
									{{$user->employeur}}
								</div>
							</div>
							<div class="ui divider"></div>

							<div class="item">
								<div class="content">
									<div class="header">Github</div>
									<div class="description">
										<button class="ui circular github icon button">
											<i class="github icon"></i>
										</button>
										<a href="{{$user->github}}">{{ $user->name }}</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
