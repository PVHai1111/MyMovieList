@if (!empty($blog))
    <div class="col-lg-12">
        <div class="blog__item set-bg" data-setbg="{{ asset($blog->thumb) }}">
            <div class="blog__item__text">
                <p><span class="icon_calendar"></span>{{ $blog->created_at->format('d/m/Y') }}</p>
                <h4><a href="{{ route('user.blog.detail', $blog->id) }}">{{ $blog->title }}</a></h4>
            </div>
        </div>
    </div>
@endif
