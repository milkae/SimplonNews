
<div class="comment">
    <a class="avatar"><img src="{{ $comment->user->avatar }}" /></a>
    <div class="content">
        <a href="{{ url('/profil/' . $comment->user->id) }}" class="author">{{$comment->user->name}}</a>
        <div class="metadata">
            <span class="date">{{ $comment->created_at->format('d/m/y à H:i') }}</span>
        </div>
        <div class="text">    
            {{ $comment->content }}
        </div>
        @if (Auth::check())
            <div class="actions">
                <a class="reply active">Répondre</a>
                <a class="edit active">Editer</a>
                {{ $comment->votes }}
            <form action="{{ url('comment') }}" method="POST" class="ui reply form hidden">
                {!! csrf_field() !!}
                <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                <input type="hidden" name="news" value="{{$comment->lien_id}}">
                <div class="field">
                    <textarea name="comment"></textarea>
                </div>
                <button type="submit" class="ui primary submit labeled icon button comment-btn"><i class="icon edit"></i>Poster</button>
            </form>
            @if (Auth::check() && Auth::user()->id == $comment->user_id)
                <form action="{{ url('comment/'.$comment->id) }}" method="POST" class="ui edit form hidden">
                    {!! csrf_field() !!}
                    {!! method_field('PUT') !!}
                    <div class="field">
                        <textarea name="comment">{{ $comment->content }}</textarea>
                    </div>
                    <button type="submit" class="ui primary submit labeled icon button comment-btn"><i class="icon edit"></i>Editer</button>
                </form>
            @endif
            </div>   
        @endif
    </div>
    @if (count($comment->children) > 0)
        <div class="comments">
            @each('news.commentsview', $comment->children, 'comment')
        </div>
    @endif
</div>
<!--Bouton d'édition affiché seulement si l'utilisateur a les droits pour -->