@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <a href="{{ $news->lien }}">{{ $news->titre }}</a>
            <div>{{$news->user->name}}</div>
        </div>
    </div>
    @if (count($comments) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                Liste des Commentaires
            </div>

            <div class="panel-body">
                <table class="table table-striped task-table">
                    <thead>
                        <th>Commentaires</th>
                        <th>&nbsp;</th>
                    </thead>

                    <tbody>
                        @foreach ($comments as $comment)
                            <tr>
                                
                                <td class="table-text">
                                    <div>{{ $comment->content }}</div>
                                </td>
                                <td class="table-text">
                                    <div>{{$comment->user->name}}</div>
                                </td>

                                <!--Bouton de suppression affiché seulement si l'utilisateur a les droits pour -->
                                @if (Auth::check() && Auth::user()->id == $comment->user_id)
                                <td>
                                    <form action="{{ url('poster/'.$comment->id) }}" method="POST">
                                        {!! csrf_field() !!}
                                        {!! method_field('DELETE') !!}

                                        <button>X</button>
                                    </form>
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
    
    <!-- Formulaire de post uniquement affiché aux utilisateurs enregistrés -->
    @if (Auth::check())
    <div class="panel-body">
        @include('common.errors')
        <form action="{{ url('comment') }}" method="POST" class="form-horizontal">
            {!! csrf_field() !!}
            <input type="hidden" name="news" value="{{ $news->id }}">
            <div class="form-group">
                <label for="news-comment" class="col-sm-3 control-label">Commentaire</label>
                <div class="col-sm-6">
                    <input type="text" name="comment" id="news-comment" class="form-control" aria-describedby="http">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> Ajouter un commentaire
                    </button>
                </div>
            </div>
        </form>
    </div>
    @endif
@endsection