@if ($blog->parentComments->count() > 0)
    <h4>{{ $blog->parentComments->count() }} Comments</h4>
    @foreach ($blog->parentComments as $comment)
        <div class="blog__details__comment__item">
            <div class="blog__details__comment__item__pic">
                <img src="{{ asset('img/blog/details/comment-1.png') }}" alt="">
            </div>
            <div class="blog__details__comment__item__text">
                <span>{{ $comment->created_at->format('d/m/Y') }}</span>
                <h5>{{ $comment->user->name }}</h5>
                <p>{{ $comment->body }}</p>
                <a href="#" class="btn-like">Like</a>
                <a href="#" class="btn-reply" data-comment="{{ $comment->id }}"
                    data-id="{{ Auth::check() ? Auth::user()->id : '' }}" data-blog="{{ $blog->id }}">Reply</a>
            </div>
        </div>

        @foreach ($comment->replies as $reply)
            <div class="blog__details__comment__item blog__details__comment__item--reply">
                <div class="blog__details__comment__item__pic">
                    <img src="{{ asset('img/blog/details/comment-2.png') }}" alt="">
                </div>
                <div class="blog__details__comment__item__text">
                    <span>{{ $reply->created_at->format('d/m/Y') }}</span>
                    <h5>{{ $reply->user->name }}</h5>
                    <p>{{ $reply->body }}</p>
                </div>
            </div>
        @endforeach
    @endforeach
@endif
