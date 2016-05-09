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
		@if(count($user->liens) > 0)
		<div class="ui left aligned container segment">
			<h4 class="ui header">Liens postés</h4>
			<ul class="ui bulleted list">
				@foreach($user->liens as $lien)
					<a class="item" href="{{ URL::route('link.show', [$lien->id]) }}">{{ $lien->titre }}</a>
				@endforeach
			</ul>
		</div>
		@endif
		@if(count($user->comments) > 0)
		<div class="ui left aligned container segment">
			<h4 class="ui header">Commentaires</h4>
			<ul class="ui bulleted list">
				@foreach($user->comments as $comment)
					<div class="item">
						<div class="content">
							<a class="header" href="{{ URL::route('link.show', [$comment->lien->id]) }}">{{ $comment->lien->titre }}</a>
							<a class="description" href="{{ URL::route('link.show', [$comment->lien->id]) }}#{{$comment->id}}">{{ str_limit($comment->content, 100) }}</a>
						</div>
					</div>
				@endforeach
			</ul>
		</div>
		@endif
	</div>
</div>
@endsection
