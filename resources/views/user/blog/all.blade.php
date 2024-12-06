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
                    @foreach ($blogChunks as $key => $blogs)
                        @php
                            $count += $key * 12;
                        @endphp
                        <div class="col-lg-6">
                            <div class="row">
                                @foreach (range(0, 5) as $i)
                                    @php
                                        $index = $count + $i;
                                    @endphp

                                    @if (isset($blogs[$index]))
                                        @include(
                                            $i == 0 || $i == 3 ? 'user.blog.big_blog' : 'user.blog.mini_blog',
                                            ['blog' => $blogs[$index]]
                                        )
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                @foreach (range(6, 11) as $i)
                                    @php
                                        $index = $count + $i;
                                    @endphp

                                    @if (isset($blogs[$index]))
                                        @include(
                                            $i == 8 || $i == 11 ? 'user.blog.big_blog' : 'user.blog.mini_blog',
                                            ['blog' => $blogs[$index]]
                                        )
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
@endsection
