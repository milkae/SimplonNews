@extends('layouts.app')

@section('content')
    <!-- Formulaire de post pour les users enregistrés -->
    @if (Auth::check())
        <a href="/poster">Poster un lien</a>
    @endif
    <!-- Liste des liens -->
    @if (count($news) > 0)
        <div class="ui relaxed divided list">
        @foreach ($news as $new)
            <div class="item">
                <div class="content">
                <div class="ui header">
                    <a href="{{ $new->lien }}">{{ $new->titre }}</a>
                    <!-- Del pour le posteur -->
                    @if (Auth::check() && Auth::user()->id == $new->user->id)
                        <form class="inlineForm right floated" action="{{ url('poster/'.$new->id) }}" method="POST">
                            {!! csrf_field() !!}
                            {!! method_field('DELETE') !!}
                            <button class="ui basic mini compact button"><i class="trash outline icon"></i></button>
                        </form>
                    @endif
                    </div>
                    <div class="description">
                        <i class="empty star icon"></i> {{ $new->likes->sum('val') }}
                        <!-- Change l'icone et l'action si un vote de l'utilisateur sur le lien existe -->
                        @if($new->voted)
                            <form class="inlineForm" action="{{ url('delLinkVote/'.$new->id) }}" method="POST">
                                {!! csrf_field() !!}
                                @if($new->voted == 1)
                                    <button class="ui basic mini compact green button"><i class="checkmark icon"></i></button>
                                @else
                                    <button class="ui basic mini compact red button"><i class="remove icon"></i></button>
                                @endif
                            </form>
                        @else
                            <form class="inlineForm" action="{{ url('upLink/'.$new->id) }}" method="POST">
                                {!! csrf_field() !!}
                                <button class="ui basic mini compact button">+</button>
                            </form>
                            <form class="inlineForm" action="{{ url('downLink/'.$new->id) }}" method="POST">
                                {!! csrf_field() !!}
                                <button class="ui basic mini compact button">-</button>
                            </form>
                        @endif
                        <a href="{{ url('/comments/' . $new->id) }}">{{ count($new->comments) }} commentaire{{ count($new->comments) == 1 ? '' : 's'}}</a>
                        | {{$new->user->name}} {{$new->created_at->format('d/m/y à h:i')}}
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