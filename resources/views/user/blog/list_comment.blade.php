@if ($blog->parentComments->count() > 0)
    <h4>{{ $blog->parentComments->count() }} Comments</h4>
    @foreach ($blog->parentComments as $comment)
        <div class="blog__details__comment__item">
            <div class="blog__details__comment__item__pic">
                <img src="{{ $comment->user->thumb ? asset($comment->user->thumb) : asset('img/anime/review-1.jpg') }}"
                    alt="">
            </div>
            <div class="blog__details__comment__item__text">
                <span>{{ $comment->created_at->format('d/m/Y') }}</span>
                <h5>{{ $comment->user->name }}</h5>
                <p>{{ $comment->body }}</p>
                @if (Auth::check())
                    @if (Auth::user()->id != $comment->user->id)
                        <a href="#" data-id="{{ $comment->id }}" data-type="App\Models\Comment"
                            class="report">Report</a>
                    @endif
                @endif
                @auth
                    <a href="#" class="btn-reply" data-comment="{{ $comment->id }}" data-id="{{ Auth::user()->id }}"
                        data-blog="{{ $blog->id }}">Reply</a>
                @endauth
            </div>
        </div>

        @foreach ($comment->replies as $reply)
            <div class="blog__details__comment__item blog__details__comment__item--reply">
                <div class="blog__details__comment__item__pic">
                    <img src="{{ $comment->user->thumb ? asset($comment->user->thumb) : asset('img/anime/review-1.jpg') }}"
                        alt="">
                </div>
                <div class="blog__details__comment__item__text">
                    <span>{{ $reply->created_at->format('d/m/Y') }}</span>
                    <h5>{{ $reply->user->name }}</h5>
                    <p>{{ $reply->body }}</p>
                    @if (Auth::check())
                        @if (Auth::user()->id != $comment->user->id)
                            <a href="#" data-id="{{ $comment->id }}" data-type="App\Models\Comment"
                                class="report">Report</a>
                        @endif
                    @endif
                </div>
            </div>
        @endforeach
    @endforeach
@endif
