<div class="section-title">
    <h5>Reviews</h5>
</div>
@if ($comments)
    @foreach ($comments as $comment)
        <div class="anime__review__item">
            <div class="anime__review__item__pic">
                <img src="{{ $comment->user->thumb ? asset($comment->user->thumb) : asset('img/anime/review-1.jpg') }}"
                    alt="">
            </div>
            <div class="anime__review__item__text">
                <h6>{{ $comment->user->name }} -
                    <span>{{ $comment->created_at->format('d/m/Y') }}</span>
                </h6>
                <p>{{ $comment->body }}</p>
            </div>
        </div>
    @endforeach
@endif
