@extends('layout.admin_layout')
@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                Edit blog
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('user.blog.update', $blog->id) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Title</label>
                        <input class="form-control" type="text" name="title" id="name"
                            value="{{ $blog->title }}">
                    </div>

                    <div class="form-group">
                        <label for="content">Description</label>
                        <textarea class="form-control d-none text-editor" name="content" id="description" cols="30" rows="5">{{ $blog->content }}</textarea>
                        <div id="editor" style="height: 300px;"></div>
                    </div>

                    <div class="form-group">
                        <label for="">Thumb</label>
                        <input type="file" name="thumb" class="form-control-file" id="image"
                            aria-describedby="inputGroupFileAddon01">
                    </div>

                    <div id="preview-container" style="height:auto; width: 300px;" class="my-3">
                        <img id="image-preview" class="img-fluid img-thumbnail" src="{{asset($blog->thumb)}}" alt="Image Preview"
                            style="">
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
