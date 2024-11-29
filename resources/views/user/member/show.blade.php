@extends('layout.user_layout')
@section('content')
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{ route('home.index') }}"><i class="fa fa-home"></i> Home</a>
                        <a href="">{{ ucfirst($member->role) }}</a>
                        <span>{{ $member->name }}</span>
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
                        <div class="anime__details__pic set-bg" data-setbg="{{ asset($member->thumb) }}">
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="anime__details__text">
                            <div class="anime__details__title">
                                <h3>{{ $member->name }}</h3>
                                <span>{{ ucfirst($member->role) }}</span>
                            </div>
                            <p>{!! $member->biography !!}</p>
                            <div class="anime__details__widget">
                                <div class="row">
                                              <ul>
                                            <li><span>Date of Birth:</span> {{ $member->dob }}</li>
                                            @if (!empty($member->dod))
                                                <li><span>Passed away At:</span> {{ $member->dod }}</li>
                                            @endif
                                            <li><span>Movies:</span>
                                                @foreach ($member->movies as $movie)
                                                    <a
                                                        href="{{ route('user.movie.show', $movie->id) }}">{{ $movie->name }}</a>
                                                    <span class="dot">, </span>
                                                @endforeach
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
