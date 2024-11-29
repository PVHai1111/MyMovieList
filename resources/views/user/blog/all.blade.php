@extends('layout.user_layout')
@section('content')
    <section class="normal-breadcrumb set-bg" data-setbg="{{ asset('img/normal-breadcrumb.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="normal__breadcrumb__text">
                        <h2>Our Blog</h2>
                        <p>Welcome to the official MyMovieList blog.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Normal Breadcrumb End -->

    <!-- Blog Section Begin -->
    <section class="blog spad">
        <div class="container">
            <div class="row">
                @if ($blogChunks->count() > 0)
                    @foreach ($blogChunks as $blogs)
                        <div class="col-lg-6">
                            <div class="row">
                                @include('user.blog.big_blog',['blog' => $blogs[0]])
                                @include('user.blog.mini_blog',['blog' => $blogs[1]])
                                @include('user.blog.mini_blog',['blog' => $blogs[2]])
                                @include('user.blog.big_blog',['blog' => $blogs[3]])
                                @include('user.blog.mini_blog',['blog' => $blogs[4]])
                                @include('user.blog.mini_blog',['blog' => $blogs[5]])
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                @include('user.blog.mini_blog',['blog' => $blogs[6]])
                                @include('user.blog.mini_blog',['blog' => $blogs[7]])
                                @include('user.blog.big_blog',['blog' => $blogs[8]])
                                @include('user.blog.mini_blog',['blog' => $blogs[9]])
                                @include('user.blog.mini_blog',['blog' => $blogs[10]])
                                @include('user.blog.big_blog',['blog' => $blogs[11]])
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
@endsection
