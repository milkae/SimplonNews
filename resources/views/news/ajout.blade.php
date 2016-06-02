@extends('layouts.app')
@section('title')
    <title>Simplon News - Ajouter un lien</title>
@endsection

@section('content')
        @include('common.errors')
        @if(Auth::check())
        <form class="ui form" action="{{ URL::route('link.store') }}" method="POST">
        @else
        <form class="ui form" action="{{ URL('/guestPost') }}" method="POST">
        @endif
            {!! csrf_field() !!}
            <div class="field">
                <label for="news-titre">Titre</label>
                <input type="text" name="titre" id="news-titre">
            </div>
            <div class="field">
                <label for="news-lien">Lien</label>
                <input type="url" name="lien" id="news-lien" class="form-control">
            </div>
            <div class="field">
                <label>Tags</label>
                <select multiple class="ui dropdown" name="tags[]">
                <option value="">Selectionnez vos tags</option>
                @foreach ($tags as $tag)
                <option value="{{$tag->id}}">{{ $tag->name }}</option>
                @endforeach
                </select>
            </div>
            <div class="inline fields">
                <label for="categorie">Catégorie du lien :</label>
                <div class="field">
                  <div class="ui radio checkbox">
                    <input type="radio" name="categorie" value="web" checked="" tabindex="0" class="hidden">
                    <label>Culture web</label>
                  </div>
                </div>
                <div class="field">
                  <div class="ui radio checkbox">
                    <input type="radio" name="categorie" value="tutos" tabindex="0" class="hidden">
                    <label>Tutos/Tech</label>
                  </div>
                </div>
                <div class="field">
                  <div class="ui radio checkbox">
                    <input type="radio" name="categorie" value="jobs" tabindex="0" class="hidden">
                    <label>Jobs</label>
                  </div>
                </div>
            </div>
            <div class="inline fields">
                <label for="fruit">Langue du lien :</label>
                <div class="field">
                  <div class="ui radio checkbox">
                    <input type="radio" name="langue" value="fr" checked="" tabindex="0" class="hidden">
                    <label>Français</label>
                  </div>
                </div>
                <div class="field">
                  <div class="ui radio checkbox">
                    <input type="radio" name="langue" value="gb" tabindex="0" class="hidden">
                    <label>Anglais</label>
                  </div>
                </div>
                <div class="field">
                  <div class="ui radio checkbox">
                    <input type="radio" name="langue" value="misc" tabindex="0" class="hidden">
                    <label>Autre</label>
                  </div>
                </div>
            </div>
            <button class="ui button" type="submit">Ajouter une news</button>
        </form>
@endsection
