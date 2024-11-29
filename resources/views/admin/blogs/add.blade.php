@extends('layout.admin_layout')
@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                Add new blog
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('user.blog.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Title</label>
                        <input class="form-control" type="text" name="title" id="name" value="{{old('title')}}">
                    </div>

                    <div class="form-group">
                        <label for="content">Description</label>
                        <textarea class="form-control d-none text-editor" name="content" id="description" cols="30" rows="5">{{old('content')}}</textarea>
                        <div id="editor" style="height: 300px;"></div>
                    </div>

                    <div class="form-group">
                        <label for="">Thumb</label>
                        <input type="file" name="thumb" class="form-control-file" id="image"
                            aria-describedby="inputGroupFileAddon01">
                    </div>

                    <div id="preview-container" style="height:auto; width: 300px;" class="my-3">
                        <img id="image-preview" class="img-fluid img-thumbnail" src="" alt="Image Preview"
                            style="display: none;">
                    </div>

                    <button type="submit" class="btn btn-primary">Add new</button>
                </form>
            </div>
        </div>
    </div>
@endsection
