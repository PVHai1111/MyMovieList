@extends('layout.admin_layout')
@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                Edit user
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.user.update', $user->id) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input class="form-control" type="text" name="name" id="name"
                            value="{{ $user->name }}" disabled>
                    </div>

                    <div class="form-group">
                        <label for="name">Email</label>
                        <input class="form-control" type="email" name="email" id="email"
                            value="{{ $user->email }}" disabled>
                    </div>

                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" class="form-control" id="status">
                            <option value="active" {{ $user->status == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="ban" {{ $user->status == 'ban' ? 'selected' : '' }}>Ban</option>
                        </select>
                    </div>

                    <div id="preview-container" style="height:auto; width: 300px;" class="my-3">
                        <img id="image-preview" class="img-fluid img-thumbnail" src="{{ asset($user->thumb) }}"
                            alt="Image Preview">
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
