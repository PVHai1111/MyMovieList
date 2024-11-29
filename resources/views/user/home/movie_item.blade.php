<div class="col-lg-4 col-md-6 col-sm-6">
    <div class="product__item">
        <div class="product__item__pic set-bg" data-setbg="{{ asset($movie->thumb) }}">
            <div class="ep">{{ $movie->calculateRating() }} Star</div>
            <div class="comment"><i class="fa fa-comments"></i> {{ $movie->comments->count() }}</div>
            <div class="view"><i class="fa fa-eye"></i> {{ $movie->favorites->count() }}</div>
        </div>
        <div class="product__item__text">
            <ul>
                @foreach ($movie->cats as $cat)
                    <li><a href="{{ route('user.movie.filter', $cat->id) }}"
                            style="color:#FFFFFF">{{ $cat->name }}</a></li>
                @endforeach
            </ul>
            <h5><a href="{{ route('user.movie.show', $movie->id) }}">{{ $movie->name }}</a></h5>
        </div>
    </div>
</div>
