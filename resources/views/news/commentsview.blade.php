
<li>
    <div>{{ $comment->content }}</div>
    <div>{{$comment->user->name}}</div>
    <!--Bouton de suppression affiché seulement si l'utilisateur a les droits pour -->
    @if (Auth::check() && Auth::user()->id == $comment->user_id)
        <form action="{{ url('comment/'.$comment->id) }}" method="POST">
            {!! csrf_field() !!}
            {!! method_field('DELETE') !!}
            <button>X</button>
        </form>
    @endif
    @if (Auth::check())
        <a href="" class="comment-res">Répondre</a>
        @include('common.errors')
        <form action="{{ url('comment') }}" method="POST" class="hidden">
            {!! csrf_field() !!}
            <input type="hidden" name="comment_id" value="{{ $comment->id }}">
            <input type="hidden" name="news" value="{{$comment->lien_id}}">
            <input type="text" name="comment" class="comment-input" placeholder="Commentaire">
            <button type="submit" class="comment-btn">Send</button>
        </form>
    @endif
    @if (count($comment->children) > 0)
        <a href="" class="comment-res">Afficher les réponses</a>
        <ul class="hidden">
            @each('news.commentsview', $comment->children, 'comment')
        </ul>
    @endif
</li>