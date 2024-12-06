@extends('layout.user_layout')
@section('content')
    @if ($list_people->count() > 0)
        <div class="list-people container my-5">
            <h2 class="text-light mb-3">List people</h2>
            <div class="row">
                @foreach ($list_people as $people)
                    <div class="people-item my-3 col-12 d-flex">
                        <img src="{{ asset($people->thumb) }}" alt="">
                        <div class="people-content">
                            <span>{{ $people->name }}</span>
                            <a href="{{ route('people.favorites', $people->id) }}">List favorite</a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="product__pagination">
                {{ $list_people->links('vendor.pagination.bootstrap-5') }}
            </div>
        </div>
    @endif
@endsection
