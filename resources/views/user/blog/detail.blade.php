@extends('layout.user_layout')
@section('content')
    <section class="blog-details spad">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-8">
                    <div class="blog__details__title">
                        <h6>{{ $blog->user->name }} <span>- {{ $blog->created_at->format('d/m/Y') }}</span></h6>
                        <h2>{{ $blog->title }}</h2>
                        <div class="blog__details__social">
                            <a href="#" class="facebook"><i class="fa fa-facebook-square"></i> Facebook</a>
                            <a href="#" class="pinterest"><i class="fa fa-pinterest"></i> Pinterest</a>
                            <a href="#" class="linkedin"><i class="fa fa-linkedin-square"></i> Linkedin</a>
                            <a href="#" class="report" data-id="{{ $blog->id }}" data-type="App\Models\Blog"><i
                                    class="fa fa-flag"></i> Report</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="blog__details__pic">
                        <img src="{{ asset($blog->thumb) }}" alt="">
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="blog__details__content">
                        <div class="blog__details__item__text">
                            {!! $blog->content !!}
                        </div>
                        <div class="blog__details__comment">
                            @include('user.blog.list_comment', [
                                'blogs' => $blog,
                            ])
                        </div>
                        @auth
                            <div class="blog__details__form">
                                <h4>Enter your comment</h4>
                                <form action="#" data-comment="" data-id="{{ Auth::user()->id }}"
                                    data-blog="{{ $blog->id }}">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <textarea placeholder="Message" class="input-message"></textarea>
                                            <button type="submit" class="site-btn">Send</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
