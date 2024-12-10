<div class="product__sidebar__view__item set-bg mix" data-setbg="{{ asset($movie->thumb) }}">
    <div class="ep">{{ $movie->calculateRating() }} Star</div>
    <div class="view"><i class="fa fa-eye"></i> {{ $movie->favorites->count() }}</div>
    <h5><a href="{{ route('user.movie.show', $movie->id) }}">{{ $movie->name }}</a></h5>
</div>
