@extends('layout.admin_layout')
@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                Add new movie member
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('member.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input class="form-control" type="text" name="name" id="name"
                            value="{{ old('name') }}">
                    </div>

                    <div class="form-group">
                        <label for="content">Biography</label>
                        <textarea class="form-control d-none text-editor" name="biography" id="biography" cols="30" rows="5">{{ old('biography') }}</textarea>
                        <div id="editor" style="height: 300px;"></div>
                    </div>


                    <div class="form-group">
                        <label for="">Role</label>
                        <select class="form-control" name="role" id="">
                            <option value="actor">Actor</option>
                            <option value="director">Director</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Day of Birh</label>
                        <input type="date" name="dob" class="form-control" value="{{ old('dob') }}">
                    </div>

                    <div class="form-group">
                        <label for="">Day of Death</label>
                        <input type="date" name="dod" class="form-control" value="{{ old('dod') }}">
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