@extends('layouts.app')

@section('content')
        @include('common.errors')
        <form class="ui form" action="{{ url('poster/store') }}" method="POST">
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
            <button class="ui button" type="submit">Ajouter une news</button>
        </form>
@endsection