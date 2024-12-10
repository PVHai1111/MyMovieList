@extends('layout.admin_layout')
@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
                <h5 class="m-0 ">List comments</h5>
                <div class="form-inline">
                    <form action="#">
                        <input type="" class="form-control form-search mx-3" placeholder="Enter your keyword">
                        <input type="submit" name="btn-search" value="Search" class="btn btn-primary">
                    </form>
                </div>
            </div>
            @if ($comments->count() > 0)
                <div class="card-body">
                    <div class="form-action form-inline py-3">
                        <select class="form-control mr-1" id="">
                            <option>Chọn</option>
                            <option>Tác vụ 1</option>
                            <option>Tác vụ 2</option>
                        </select>
                        <input type="submit" name="btn-search" value="Áp dụng" class="btn btn-primary">
                    </div>
                    <table class="table table-striped table-checkall">
                        <thead>
                            <tr>
                                <th scope="col">
                                    <input name="checkall" type="checkbox">
                                </th>
                                <th scope="col">#</th>
                                <th scope="col">Id</th>
                                <th scope="col">User Id</th>
                                <th scope="col">Type Id</th>
                                <th scope="col">Type</th>
                                <th scope="col">Content</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($comments as $comment)
                                <tr>
                                    <td>
                                        <input type="checkbox">
                                    </td>
                                    <td scope="row">{{ $count++ }}</td>
                                    <td><a href="{{ route('admin.comment.detail', $comment->id) }}">{{ $comment->id }}</a>
                                    </td>
                                    <td><a
                                            href="{{ route('admin.user.edit', $comment->user->id) }}">{{ $comment->user->id }}</a>
                                    </td>
                                    <td><a
                                            href="{{ class_basename($comment->commentable_type) === 'Blog' ? route('user.blog.edit', $comment->commentable_id) : route('movie.edit', $comment->commentable_id) }}">{{ $comment->commentable_id }}</a>
                                    <td>{{ class_basename($comment->commentable_type) }}
                                    </td>
                                    <td>{{ ucfirst($comment->body) }}</td>
                                    <td>
                                        <a href="{{ route('admin.comment.delete', $comment->id) }}"
                                            class="btn btn-danger btn-sm rounded-0 delete-link" type="button"
                                            data-toggle="tooltip" data-placement="top" title="Delete"
                                            onclick="return confirmDelete()"><i class="fa fa-trash"></i></a>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <nav aria-label="Page navigation example">
                        {{ $comments->links('pagination::bootstrap-4') }}
                    </nav>
                </div>
            @endif
        </div>
    </div>
@endsection
