@extends('layouts.app')
	@section('content')
	<!-- employeur travail github photo -->
	<div class="mid-content" style="position: relative; top: 15%;">
		<div class="ui center aligned container stackable grid">
			<div class="nine wide column">
				<div class="ui container stackable segments">
				@if(url()->current() == url('edit/profil'))
				<form action="{{ url('/edit/profil') }}" method="POST">
				{!! csrf_field() !!}
				@endif
					<div class="ui horizontal container stackable segments">
						<div class="ui left aligned attached padded segment">
							<div class="header dividing">{{ $user->name }}</div>
							@if(url()->current() == url('edit/profil'))
							<button class="ui compact icon pink inverted button show-next"><i class="setting icon"></i></button>
							<input type="text" name="name" value="{{$user->name}}" class="hidden">
							@endif
						</div>
						@if (Auth::check() && Auth::user()->id == $user->id && url()->current() == url('/profil'))
						<div class="ui right aligned attached segment">
							<a href="{{ url('/edit/profil') }}"><button class="ui compact labeled icon pink inverted button"><i class="setting icon"></i> Edit </button></a>
						</div>
						@endif
						@if(url()->current() == url('edit/profil'))
						<div class="ui right aligned attached segment">
							<input type="submit" value="Enregistrer les modifications" class="ui compact labeled icon pink inverted button">
						</div>
						@endif
					</div>
					<div class="ui segment">
						<div class="ui container stackable grid">
							<div class="eight wide column">
								<img src="{{$user->avatar}}" alt="Image de Profil" class="ui large rounded image">
							</div>
							<div class="eight wide left aligned verry padded column">
								<div class="ui list">
									<div class="item">
										<div class="header">Nom</div>
										{{$user->nom}}
										@if(url()->current() == url('edit/profil'))
										<button class="ui compact icon pink inverted button show-next"><i class="setting icon"></i></button>
										<input type="text" name="nom" value="{{$user->nom}}" class="hidden">
										@endif
									</div>
									<div class="ui divider"></div>

									<div class="item">
										<div class="header">Prénom</div>
										{{$user->prenom}}
										@if(url()->current() == url('edit/profil'))
										<button class="ui compact icon pink inverted button show-next"><i class="setting icon"></i></button>
										<input type="text" name="prenom" value="{{$user->prenom}}" class="hidden">
										@endif
									</div>
									<div class="ui divider"></div>

									<div class="item">
										<div class="header"><i class="travel icon"></i>Profession</div>
										{{$user->job}}
										@if(url()->current() == url('edit/profil'))
										<button class="ui compact icon pink inverted button show-next"><i class="setting icon"></i></button>
										<input type="text" name="job" value="{{$user->job}}" class="hidden">
										@endif
									</div>
									<div class="ui divider"></div>

									<div class="item">
										<div class="header">Employeur</div>
										{{$user->employeur}}
										@if(url()->current() == url('edit/profil'))
										<button class="ui compact icon pink inverted button show-next"><i class="setting icon"></i></button>
										<input type="text" name="employeur" value="{{$user->employeur}}" class="hidden">
										@endif
									</div>
									<div class="ui divider"></div>

									<div class="item">
										<div class="header">Github</div>
										<button class="ui circular github icon button">
											<i class="github icon"></i>
										</button>
										<a href="{{$user->github}}">{{ $user->name }}</a>
										@if(url()->current() == url('edit/profil'))
										<button class="ui compact icon pink inverted button next"><i class="setting icon"></i></button>
										<input type="text" name="github" value="{{$user->github}}" class="hidden">
										@endif
										<div class="right floated header">Karma : {{$user->karma}}</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				@if(url()->current() == url('edit/profil'))
				</form>
				@endif
				</div>
			</div>
		</div>
	</div>
