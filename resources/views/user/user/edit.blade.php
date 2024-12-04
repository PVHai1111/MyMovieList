@extends('layout.user_layout')
@section('content')
    <div id="form-change-user" class="container mb-5">
        <form action="{{ route('user.update') }}" class="row" method="POST" enctype="multipart/form-data">
            @csrf
            <div id="preview-container" style="" class="my-3 col-12 d-flex justify-content-center align-items-center">
                <div class="img-prev rounded-circle img-fluid img-thumbnail"
                    style="flex-basis: 150px; max-width:150px; height:150px; overflow:hidden">
                    <img id="image-preview" class="" style="width:100%; height:auto"
                        src="{{ $user->thumb ? asset($user->thumb) : asset('img/anime/review-1.jpg') }}" alt="Image Preview"
                        style="">
                </div>
            </div>
            <div class="form-group form-upload col-12">
                <label for="image" class="text-light">Avatar</label>
                <input type="file" id="image" class="form-control" name="thumb">
            </div>
            <div class="form-group col-12">
                <label for="email" class="text-light">Email</label>
                <input type="email" class="form-control" value="{{ $user->email }}" disabled>
            </div>
            <div class="form-group col-12">
                <label for="name" class="text-light">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
            </div>
            <div class="form-group col-12">
                <label for="password" class="text-light">Password</label>
                <input type="password" class="form-control" name="password">
            </div>
            <div class="form-group col-12 mt-4">
                <button class="btn btn-primary px-5">update</button>
            </div>
        </form>
    </div>

    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="trending__product">
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <div class="section-title">
                                    <h4>Your Favorite Movies</h4>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 d-flex justify-content-end">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="publish"
                                        @if (Auth::check() && Auth::user()->favorite_status) checked @endif>
                                    <label class="custom-control-label text-light" for="publish">Status</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @if ($favorite_movies->count() > 0)
                                @foreach ($favorite_movies as $movie)
                                    @include('user.home.movie_item', ['movie' => $movie])
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
