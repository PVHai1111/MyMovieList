@extends('layout.admin_layout')
@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                Edit movie
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('movie.update', $movie->id) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input class="form-control" type="text" name="name" id="name"
                            value="{{ $movie->name }}">
                    </div>

                    <div class="form-group">
                        <label for="content">Description</label>
                        <textarea class="form-control d-none text-editor" name="description" id="description" cols="30" rows="5">{{ $movie->description }}</textarea>
                        <div id="editor" style="height: 300px;"></div>
                    </div>

                    <div class="form-group">
                        <label for="name">Duration (minutes)</label>
                        <input class="form-control" type="number" name="duration" id="duration" min="1"
                            value="{{ $movie->duration }}">
                    </div>

                    <div class="form-group">
                        <label for="name">Release year</label>
                        <input class="form-control" type="number" name="release_year" id="release_year" min="1800"
                            max ="{{ date('Y') }}" value="{{ $movie->release_year }}">
                    </div>


                    <div class="form-group">
                        <label for="">Categories</label>
                        <select id="cat-select" class="slim-select" name="cat_ids[]" multiple>
                            <option value="">-- Select Category --</option>
                            @foreach ($cats as $cat)
                                <option value="{{ $cat->id }}"
                                    {{ in_array($cat->id, $movie->cats->pluck('id')->toArray()) ? 'selected' : '' }}>
                                    {{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Series</label>
                        <select id="cat-select" class="slim-select" name="serie_id">
                            <option value="">-- Select Serie --</option>
                            @foreach ($series as $serie)
                                <option value="{{ $serie->id }}" {{ $movie->serie_id == $serie->id ? 'selected' : '' }}>
                                    {{ $serie->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Movie members</label>
                        <select id="member-select" class="slim-select" name="member_ids[]" multiple>
                            <option value="">-- Select Member --</option>
                            @foreach ($members as $member)
                                <option value="{{ $member->id }}"
                                    {{ in_array($member->id, $movie->members->pluck('id')->toArray()) ? 'selected' : '' }}>
                                    {{ $member->name }} - {{ ucfirst($member->role) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Thumb</label>
                        <input type="file" name="thumb" class="form-control-file" id="image"
                            aria-describedby="inputGroupFileAddon01">
                    </div>

                    <div id="preview-container" style="height:auto; width: 300px;" class="my-3">
                        <img id="image-preview" class="img-fluid img-thumbnail" src="{{ asset($movie->thumb) }}"
                            alt="Image Preview">
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
