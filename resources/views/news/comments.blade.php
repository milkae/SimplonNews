@extends('layouts.app')

@section('content')
<div><a href="{{ $news->lien }}">{{ $news->titre }}</a></div>
{{$news->user->name}} | Karma 
<form class="inlineForm" action="{{ url('addKarma/'.$news->id) }}" method="POST">
    {!! csrf_field() !!}
    <button class="ui basic mini compact button">
    + {{ count($news->karmas->where('plus', '1')) }}
    </button>
</form>
<form class="inlineForm" action="{{ url('removeKarma/'.$news->id) }}" method="POST">
    {!! csrf_field() !!}
    <button class="ui basic mini compact button">
    - {{ count($news->karmas->where('moins', '1')) }}
    </button>
</form>
<div class="ui threaded comments">
    @if (Auth::check())
        <form class="ui reply form" action="{{ url('comment') }}" method="POST">
            {!! csrf_field() !!}
            <input type="hidden" name="news" value="{{ $news->id }}">
            <input type="hidden" name="comment_id" value="">
            <div class="field">
              <textarea name="comment"></textarea>
            </div>
            <button class="ui primary submit labeled icon button"><i class="icon edit"></i> Commenter </button>
        </form>
    @endif
    @if (count($comments) > 0)
        <h5 class="ui dividing header">Commentaires</h5>
        @each('news.commentsview', $comments, 'comment')
    @endif
</div>
@endsection