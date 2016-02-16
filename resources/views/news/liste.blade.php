@extends('layouts.app')

@section('content')
    @if (count($news) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                Liste des News
            </div>

            <div class="panel-body">
                <table class="table table-striped task-table">
                    <thead>
                        <th>News</th>
                        <th>&nbsp;</th>
                    </thead>

                    <tbody>
                        @foreach ($news as $new)
                            <tr>
                                
                                <td class="table-text">
                                    <a href="{{ $new->lien }}">{{ $new->titre }}</a>
                                </td>
                                <td class="table-text">
                                    <div>{{$new->user->name}}</div>
                                </td>
                                <td>
                                    <div>Karma</div>
                                    <form action="{{ url('addKarma/'.$new->id) }}" method="POST">
                                        {!! csrf_field() !!}
                                        <input type="submit" value="+ {{ count($new->karmas->where('plus', '1')) }}">
                                    </form>
                                    <form action="{{ url('removeKarma/'.$new->id) }}" method="POST">
                                        {!! csrf_field() !!}
                                        <input type="submit" value="- {{ count($new->karmas->where('moins', '1')) }}">
                                    </form>
                                </td>
                                <!--Bouton de suppression affiché seulement si l'utilisateur a les droits pour -->
                                @if (Auth::check() && Auth::user()->id == $new->user->id)
                                <td>
                                    <form action="{{ url('poster/'.$new->id) }}" method="POST">
                                        {!! csrf_field() !!}
                                        {!! method_field('DELETE') !!}

                                        <button>X</button>
                                    </form>
                                </td>
                                @endif
                                <td>
                                    <button><a href="{{ url('/comments/' . $new->id) }}">Commentaires</a></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
    
    <!-- Formulaire de post uniquement affiché aux utilisateurs enregistrés -->
    @if (Auth::check())
        <a href="/poster">Poster une news</a>
    @endif
    {{ $news->render() }}
@endsection