@extends('layout.admin_layout')
@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                Comment detail
            </div>
            <div class="card-body">
                <form>
                    <div class="form-group">
                        <label for="name">User:</label>
                        <a href="{{ route('admin.user.edit', $comment->user->id) }}"
                            class="">{{ $comment->user->name }}</a>
                    </div>

                    <div class="form-group">
                        <label for="name">Type Id:</label>
                        <a href="{{ class_basename($comment->commentable_type) === 'Blog' ? route('user.blog.edit', $comment->commentable_id) : route('movie.edit', $comment->commentable_id) }}"
                            class="">{{ $comment->commentable_id }}</a>
                    </div>

                    <div class="form-group">
                        <label for="name">Type:</label>
                        <span>{{ class_basename($comment->commentable_type) }}</span>
                    </div>

                    <div class="form-group">
                        <label for="content">Content:</label>
                        <input type="text" class="form-control" disabled value="{{ $comment->body }}">
                    </div>

                    <a href="{{ route('admin.comment.delete', $comment->id) }}"
                        class="btn btn-danger rounded px-4 py-2 delete-link" type="button" data-toggle="tooltip"
                        data-placement="top" title="Delete" onclick="return confirmDelete()">Delete</a>
                </form>
            </div>
        </div>
    </div>
@endsection
