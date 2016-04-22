@extends('layouts.app')

@section('content')
    <div class="ui fluid four item menu">
      <a href="{{ URL::route('index', ['page' => 'all']) }}" class="{{ $page == 'all'? 'active':'' }} item">Tout</a>
      <a href="{{ URL::route('index', ['page' => 'web']) }}" class="{{ $page == 'web'? 'active':'' }} item">Culture web</a>
      <a href="{{ URL::route('index', ['page' => 'tutos']) }}" class="{{ $page == 'tutos'? 'active':'' }} item">Tutos/Tech</a>
      <a href="{{ URL::route('index', ['page' => 'jobs']) }}" class="{{ $page == 'jobs'? 'active':'' }} item">Jobs</a>
    </div>
    <div class="ui secondary pointing menu">
      <a href="{{ URL::route('index', [$page, 'order' => 'top']) }}" class="{{ $order == 'top'? 'active':'' }} item">Top</a>
      <a href="{{ URL::route('index', [$page, 'order' => 'new']) }}" class="{{ $order == 'new'? 'active':'' }} item">Nouveaux</a>
    </div>
    @if($order == 'top')
        <div class="ui text menu">
          <a href="{{ URL::route('index', [$page, 'order' => 'top', 'top' => 'd']) }}" class="item">Du jour</a>
          <a href="{{ URL::route('index', [$page, 'order' => 'top', 'top' => 'w']) }}" class="item">De la semaine</a>
          <a href="{{ URL::route('index', [$page, 'order' => 'top', 'top' => 'm']) }}" class="item">Du mois</a>
          <a href="{{ URL::route('index', [$page, 'order' => 'top']) }}" class="item">De tous les temps</a>
        </div>
    @endif
    @if (count($news) > 0)
        <div class="ui relaxed divided list">
        @foreach ($news as $new)
            <div class="item">
            <div class="ui left floated">
                        <!-- Change l'icone et l'action si un vote de l'utilisateur sur le lien existe -->
            @if($new->liked())
                <form class="" action="{{ URL::route('link.vote.del', [$new->id]) }}" method="POST">
                    {!! csrf_field() !!}
                    @if($new->liked() == 1)
                        <button class="ui basic mini compact green button"><i class="plus icon"></i></button>
                    @else
                        <button class="ui basic mini compact red button"><i class="minus icon"></i></button>
                    @endif
                </form>
            @else
                <form class="" action="{{ URL::route('link.vote.up', [$new->id]) }}" method="POST">
                    {!! csrf_field() !!}
                    <button class="ui basic mini compact button"><i class="plus icon"></i></button>
                </form>
                <form class="" action="{{ URL::route('link.vote.down', [$new->id]) }}" method="POST">
                    {!! csrf_field() !!}
                    <button class="ui basic mini compact button"><i class="minus icon"></i></button>
                </form>
            @endif
            </div>
                <div class="row content">
                <div class="ui header">
                    <a href="{{ $new->lien }}">{{ $new->titre }}</a>
                    <!-- Del pour le posteur -->
                    @if (Auth::check() && (Auth::user()->id == $new->user->id || Auth::user()->hasRole('admin')))
                        <form class="inlineForm right floated" action="{{ URL::route('link.del', [$new->id]) }}" method="POST">
                            {!! csrf_field() !!}
                            {!! method_field('DELETE') !!}
                            <button class="ui basic mini compact button"><i class="trash outline icon"></i></button>
                        </form>
                    @endif
                    </div>
                    <div class="description">
                        {{ $new->likes->sum('val') }} <i class="empty star icon"></i>
                        <a href="{{ URL::route('link.show', [$new->id]) }}">{{ count($new->comments) }} commentaire{{ count($new->comments) == 1 ? '' : 's'}}</a>
                        | {{$new->user->name}} {{$new->created_at->format('d/m/y à H:i')}}
                        <div class="right floated">
                        @foreach($new->tags as $tag)
                            <div class="ui label">{{ $tag->name }}</div>
                        @endforeach
                        </div>
                    </div>
                </div>   
            </div>
        @endforeach
        </div>
    @endif
@endsection