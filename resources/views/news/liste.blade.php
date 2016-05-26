@extends('layouts.app')
@section('title')
    <title>Simplon News</title>
@endsection

@section('content')
    <div class="ui fluid four item menu">
      <a href="{{ URL::route('index', ['page' => 'all']) }}" class="{{ $page == 'all'? 'active':'' }} item"><h4>Tout</h4></a>
      <a href="{{ URL::route('index', ['page' => 'web']) }}" class="{{ $page == 'web'? 'active':'' }} item"><h4>Culture web</h4></a>
      <a href="{{ URL::route('index', ['page' => 'tutos']) }}" class="{{ $page == 'tutos'? 'active':'' }} item"><h4>Tutos/Tech</h4></a>
      <a href="{{ URL::route('index', ['page' => 'jobs']) }}" class="{{ $page == 'jobs'? 'active':'' }} item"><h4>Jobs</h4></a>
    </div>
    <div class="ui text menu">
        <div class="header item">Top</div>
        <a href="{{ URL::route('index', [$page, 'order' => 'd']) }}" class="{{ $order == 'd'? 'active':'' }} item">Du jour</a>
        <a href="{{ URL::route('index', [$page, 'order' => 'w']) }}" class="{{ $order == 'w'? 'active':'' }} item">De la semaine</a>
        <a href="{{ URL::route('index', [$page, 'order' => 'm']) }}" class="{{ $order == 'm'? 'active':'' }} item">Du mois</a>
        <a href="{{ URL::route('index', [$page]) }}" class="{{ !$order? 'active':'' }} item">De tous les temps</a>
    </div>
    @if (count($news) > 0)
        <div class="ui relaxed divided list home-list">
        @foreach ($news as $new)
            <div class="item">
            <div class="ui left floated">
                <form class="" action="{{ URL::route('handleVote', [ 'table' => 'liens', 'item' => $new->id, 'voteType' => 'upvote']) }}" method="POST">
                    {!! csrf_field() !!}
                    <button class="ui basic mini compact button icon {{ Auth::check()&&Auth::user()->hasUpvoted($new)?'green': '' }}"><i class="caret up icon"></i></button>
                </form>
                <form class="" action="{{ URL::route('handleVote', [ 'table' => 'liens', 'item' => $new->id, 'voteType' => 'downvote']) }}" method="POST">
                    {!! csrf_field() !!}
                    <button class="ui basic mini compact button icon {{ Auth::check()&&Auth::user()->hasDownvoted($new)?'red': '' }}"><i class="caret down icon"></i></button>
                </form>
            </div>
                <div class="row content">
                <div class="ui header">
                    <a href="{{ $new->lien }}" rel="nofollow">
                        @if($new->langue !== 'misc')
                            <i class="{{ $new->langue }} flag"></i>
                        @endif
                        {{ $new->titre }} 
                    </a>
                    @if (Auth::check() && (Auth::user()->id == $new->user->id || Auth::user()->hasRole('admin')))
                        <form class="inlineForm right floated" action="{{ URL::route('link.del', [$new->id]) }}" method="POST">
                            {!! csrf_field() !!}
                            {!! method_field('DELETE') !!}
                            <button class="ui basic mini compact button icon"><i class="trash outline icon"></i></button>
                        </form>
                    @endif
                    </div>
                    <div class="description">
                        {{ $new->likes->sum('val') }} <i class="empty star icon"></i>
                        <a href="{{ URL::route('link.show', [$new->id]) }}">{{ count($new->comments) }} commentaire{{ count($new->comments) == 1 ? '' : 's'}}</a>
                        | 
                        {{$new->user->name}} {{$new->created_at->format('d/m/y à H:i')}}
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