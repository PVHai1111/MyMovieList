@extends('layout.user_layout')
@section('content')
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{ route('home.index') }}"><i class="fa fa-home"></i> Home</a>
                        <a href="">Categories</a>
                        <span>{{ $movie->name }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Anime Section Begin -->
    <section class="anime-details spad">
        <div class="container">
            <div class="anime__details__content">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="anime__details__pic set-bg" data-setbg="{{ asset($movie->thumb) }}">
                            <div class="comment"><i class="fa fa-comments"></i> {{ $movie->comments->count() }}</div>
                            <div class="view"><i class="fa fa-eye"></i> {{ $movie->favorites->count() }}</div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="anime__details__text">
                            <div class="anime__details__title">
                                <h3>{{ $movie->name }}</h3>
                                <span>{{ $movie->serie ? $movie->serie->name : '' }}</span>
                            </div>
                            @auth
                                @php
                                    $user_rate = Auth::user()->getRatingForMovie($movie->id);
                                    $count = Auth::user()->getRatingForMovie($movie->id);
                                @endphp
                                <div class="anime__details__rating">
                                    <div class="rating">
                                        @for ($i = 0; $i < $user_rate; $i++)
                                            <a href="#" class="btn-vote" data-id="{{ Auth::user()->id }}"
                                                data-star="{{ $i + 1 }}" data-movie ="{{ $movie->id }}"><i
                                                    class="fa fa-star"></i></a>
                                        @endfor
                                        @for ($i = 5; $i > $user_rate; $i--)
                                            <a href="#" class="btn-vote" data-id="{{ Auth::user()->id }}"
                                                data-star="{{ ++$count }}" data-movie ="{{ $movie->id }}"><i
                                                    class="fa fa-star-o"></i></a>
                                        @endfor
                                    </div>
                                </div>
                            @endauth
                            <p>{!! $movie->description !!}</p>
                            <div class="anime__details__widget">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <ul>
                                            <li><span>Director:</span>
                                                @foreach ($movie->getDirectors() as $director)
                                                    <a
                                                        href="{{ route('user.member.show', $director->id) }}">{{ $director->name }}</a>
                                                    <span class="dot">, </span>
                                                @endforeach
                                            </li>
                                            <li><span>Release year:</span> {{ $movie->release_year }}</li>
                                            <li><span>Duration:</span> {{ $movie->duration }} min</li>
                                            <li><span>Actors:</span>
                                                @foreach ($movie->getActors() as $actor)
                                                    <a
                                                        href="{{ route('user.member.show', $actor->id) }}">{{ $actor->name }}</a>
                                                    <span class="dot">, </span>
                                                @endforeach
                                            </li>
                                            <li><span>Genre:</span>
                                                @foreach ($movie->cats as $cat)
                                                    <a
                                                        href="{{ route('user.movie.filter', $cat->id) }}">{{ $cat->name }}</a>
                                                    <span class="dot">, </span>
                                                @endforeach
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <ul>
                                            <li><span>Favorites:</span> {{ $movie->favorites->count() }}</li>
                                            <li><span>Rating:</span> {{ $movie->calculateRating() }} stars</li>
                                            <li><span>Votes:</span> {{ $movie->ratings->count() }} </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="anime__details__btn">
                                @auth
                                    <a href="#" class="follow-btn" data-movie="{{ $movie->id }}"
                                        data-id="{{ Auth::user()->id }}"><i
                                            class="fa {{ Auth::user()->hasFavorited($movie->id) ? 'fa-heart' : 'fa-heart-o' }}"></i>
                                        Follow</a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-md-8">
                    <div class="anime__details__review">
                        @include('user.movie.list_comments', ['comments' => $movie->comments])
                    </div>
                    @auth
                        <div class="anime__details__form">
                            <div class="section-title">
                                <h5>Your Comment</h5>
                            </div>
                            <form action="" class="form-submit-comment" data-id="{{ Auth::user()->id }}"
                                data-movie={{ $movie->id }}>
                                <textarea placeholder="Your Comment" id="input-comment"></textarea>
                                <button type="submit" class="btn-submit-comment"><i class="fa fa-location-arrow"></i>
                                    Review</button>
                            </form>
                        </div>
                    @endauth
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="anime__details__sidebar">
                        <div class="section-title">
                            <h5>you might like...</h5>
                        </div>
                        @if ($movie->getMoviesInSameSerieWithoutCurrent()->count() > 0)
                            @foreach ($movie->getMoviesInSameSerieWithoutCurrent() as $movie)
                                @include('user.home.movie_sidebar', ['movie' => $movie])
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
