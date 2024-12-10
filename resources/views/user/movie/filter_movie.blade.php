@extends('layout.user_layout')
@section('content')
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{route('home.index')}}"><i class="fa fa-home"></i> Home</a>
                        <a href="">Categories</a>
                        <span>{{ ucfirst($cat->name) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Product Section Begin -->
    <section class="product-page spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="product__page__content">
                        <div class="product__page__title">
                            <div class="row">
                                <div class="col-lg-8 col-md-8 col-sm-6">
                                    <div class="section-title">
                                        <h4>{{ $cat->name }}</i></h4>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6">
                                    <div class="product__page__filter">
                                        <p>Order by:</p>
                                        <select>
                                            <option value="">A-Z</option>
                                            <option value="">1-10</option>
                                            <option value="">10-50</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if ($movies->count() > 0)
                            <div class="row">
                                @foreach ($movies as $movie)
                                    @include('user.home.movie_item', ['movie' => $movie])
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <div class="product__pagination">
                        {{ $movies->links('vendor.pagination.bootstrap-5') }}
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-8">
                    <div class="product__sidebar">
                        <div class="product__sidebar__view">
                            <div class="section-title">
                                <h5>Top Interaction</h5>
                            </div>
                            <div class="filter__gallery">
                                @if ($interaction_movies->count() > 0)
                                    @foreach ($interaction_movies as $movie)
                                        @include('user.home.movie_sidebar', ['movie' => $movie])
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
