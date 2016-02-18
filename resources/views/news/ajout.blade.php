@extends('layouts.app')

@section('content')
        @include('common.errors')
        <form action="{{ url('poster/store') }}" method="POST">
            {!! csrf_field() !!}
            <label for="news-titre">Titre</label>
                <input type="text" name="titre" id="news-titre">
            <label for="news-lien">Lien</label>
            <div class="input-group">
                <!-- <span class="input-group-addon" id="http">http://</span> -->
                <input type="url" name="lien" id="news-lien" class="form-control">
            </div>
            <button type="submit">Ajouter une news</button>
        </form>
@endsection