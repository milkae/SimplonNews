@extends('layouts.app')
@section('title')
    <title>Simplon News - {{ $news->titre }}</title>
@endsection

@section('content')
<h1><a href="{{ $news->lien }}">{{ $news->titre }}</a></h1>
{{$news->user->name}} | {{ $news->likes->sum('val') }}<i class="empty star icon"></i>  
    <form class="inlineForm" action="{{ URL::route('handleVote', [ 'table' => 'liens', 'item' => $news->id, 'voteType' => 'upvote']) }}" method="POST">
        {!! csrf_field() !!}
        <button class="ui basic mini compact button {{ Auth::check() && Auth::user()->hasUpvoted($news)? 'green' : '' }}">+</button>
    </form>
    <form class="inlineForm" action="{{ URL::route('handleVote', [ 'table' => 'liens', 'item' => $news->id, 'voteType' => 'downvote']) }}}" method="POST">
        {!! csrf_field() !!}
        <button class="ui basic mini compact button {{ Auth::check() && Auth::user()->hasDownvoted($news)? 'red' : '' }}">-</button>
    </form>
<div class="ui threaded comments">
    @if(Auth::check())
    <form class="ui reply form" action="{{ URL::route('comment.store') }}" method="POST">
        {!! csrf_field() !!}
        <input type="hidden" name="news" value="{{ $news->id }}">
        <input type="hidden" name="comment_id" value="">
        <div class="field">
          <textarea name="comment"></textarea>
        </div>
        <button class="ui primary submit labeled icon button"><i class="icon send"></i> Commenter </button>
    </form>
    @endif
    @if (count($comments) > 0)
        <h5 class="ui dividing header">Commentaires</h5>
        @each('news.commentsview', $comments, 'comment')
    @endif
</div>
@endsection