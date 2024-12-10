@extends('layout.admin_layout')
@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
                <h5 class="m-0 ">List users</h5>
                <div class="form-inline">
                    <form action="#">
                        <input type="" class="form-control form-search mx-3" placeholder="Enter your keyword">
                        <input type="submit" name="btn-search" value="Search" class="btn btn-primary">
                    </form>
                </div>
            </div>
            @if ($users->count() > 0)
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
                                <th scope="col">Image</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>
                                        <input type="checkbox">
                                    </td>
                                    <td scope="row">{{ $count++ }}</td>
                                    <td><img src="{{ asset($user->thumb) }}" alt=""
                                            style="height: 80px; width: 80px;"></td>
                                    <td><a href="{{ route('admin.user.edit', $user->id) }}">{{ $user->name }}</a>
                                    <td>{{ $user->email }}
                                    </td>
                                    <td>{{ ucfirst($user->status) }}</td>
                                    <td>
                                        <a href="{{ route('admin.user.delete', $user->id) }}"
                                            class="btn btn-danger btn-sm rounded-0 delete-link" type="button"
                                            data-toggle="tooltip" data-placement="top" title="Delete"
                                            onclick="return confirmDelete()"><i class="fa fa-trash"></i></a>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <nav aria-label="Page navigation example">
                        {{ $users->links('pagination::bootstrap-4') }}
                    </nav>
                </div>
            @endif
        </div>
    </div>
@endsection
