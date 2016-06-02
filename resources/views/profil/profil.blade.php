@extends('layouts.app')
@section('title')
    <title>Simplon News - {{ $user->name }}</title>
@endsection

@section('content')
<div class="ui center aligned grid">
	<div class="ui nine wide column segments">
		@if(count($user->roles) > 0)
		<div class="ui labels">
		@foreach($user->roles as $role)
			<div class="ui label {{$user->hasRole($role->name)?$role->color:''}}">{{ ucfirst(trans($role->name)) }}</div>
		@endforeach
		</div>
		@endif
			<div class="ui internally celled stackable equal width grid">
				<div class="center aligned row">
					<div class="column">
						<div class="header">
							<h3>{{ $user->name }}</h3>
						</div>
					</div>
					<div class="column">
							<h4 class="ui sub header">Karma</h4>
							@if($user->karma > 1000)
							<i class="icon diamond big pink"></i>
							@endif
					</div>
					@if (Auth::check() && Auth::user()->id == $user->id)
					<div class="column">
						<a href="{{ URL::route('user.profile.edit') }}" class="ui compact labeled icon pink inverted button"><i class="setting icon"></i> Editer </a>
					</div>
					@endif
				</div>
			</div>
			<div class="ui segment">
				<div class="ui stackable grid">
					<div class="eight wide column">
						<img src="{{$user->avatar?$user->avatar:'http://lorempixel.com/600/600/cats'}}" alt="{{ $user->name }}" class="ui large rounded image">
					</div>
					<div class="eight wide left aligned column">
						<div class="ui divided items">
							<div class="item">
								<div class="content">
									<div class="ui sub header">Nom</div>
									<div class="description">
										{{$user->nom}}
									</div>
								</div>
							</div>
							<div class="item">
								<div class="content">
									<div class="ui sub header">Prénom</div>
									<div class="description">
										{{$user->prenom}}
									</div>
								</div>
							</div>


							<div class="item">
								<div class="content">
									<div class="ui sub header">Profession</div>
									<div class="description">
										{{$user->job}}
									</div>
								</div>
							</div>


							<div class="item">
								<div class="content">
									<div class="ui sub header">Employeur</div>
									<div class="description">
										{{$user->employeur}}
									</div>
								</div>
							</div>

							<div class="item">
								<div class="content">
									<div class="ui sub header">Github</div>
									<div class="description">
									@if($user->github)
									<i class="ui circular github icon"></i>
										<a href="{{$user->github}}">{{ $user->name }}</a>
									@endif
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		@if(count($user->liens) > 0)
		<div class="ui left aligned segment">
			<h4 class="ui header">Liens postés</h4>
			<ul class="ui bulleted list">
				@foreach($user->liens as $lien)
					<a class="item" href="{{ URL::route('link.show', [$lien->id]) }}">{{ $lien->titre }}</a>
				@endforeach
			</ul>
		</div>
		@endif
		@if(count($user->comments) > 0)
		<div class="ui left aligned segment">
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
