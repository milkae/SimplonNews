@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <a href="{{ $news->lien }}">{{ $news->titre }}</a>
            <div>{{$news->user->name}}</div>
        </div>
    </div>
    @if (Auth::check())
        <a href="" class="comment-res">Commenter</a>
        @include('common.errors')
        <form action="{{ url('comment') }}" method="POST" class="hidden">
            {!! csrf_field() !!}
            <input type="hidden" name="news" value="{{ $news->id }}">
            <input type="hidden" name="comment_id" value="">
            <input type="text" name="comment" placeholder="Commentaire">
            <button type="submit">Send</button>
        </form>
    @endif
    @if (count($comments) > 0)
        <div class="panel-heading">
            Liste des Commentaires
        </div>
        <ul>
            @each('news.commentsview', $comments, 'comment')
        </ul>
    @endif
@endsection