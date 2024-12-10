@extends('layout.admin_layout')
@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
                <h5 class="m-0 ">List Categories</h5>
                <div class="form-inline">
                    <form action="#" class="d-flex">
                        <input type="" class="form-control form-search mx-4" placeholder="Enter your keyword">
                        <input type="submit" name="btn-search" value="Search" class="btn btn-primary">
                    </form>
                </div>
            </div>
            @if ($cats->count() > 0)
                <div class="card-body">
                    <div class="form-action form-inline py-3">
                        <select class="form-control mr-1" id="">
                            <option>Select</option>
                            <option>Option 1</option>
                            <option>Option 2</option>
                        </select>
                        <input type="submit" name="btn-search" value="Apply" class="btn btn-primary">
                    </div>
                    <table class="table table-striped table-checkall">
                        <thead>
                            <tr>
                                <th scope="col">
                                    <input name="checkall" type="checkbox">
                                </th>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cats as $cat)
                                <tr>
                                    <td>
                                        <input type="checkbox">
                                    </td>
                                    <td scope="row">{{ $count++ }}</td>
                                    <td><a href="{{ route('cat.edit', $cat->id) }}">{{ $cat->name }}</a>
                                    </td>
                                    <td>{{ $cat->created_at }}</td>
                                    <td>
                                        <a href="{{ route('cat.delete', $cat->id) }}"
                                            class="btn btn-danger btn-sm rounded-0 delete-link" type="button"
                                            data-toggle="tooltip" data-placement="top" title="Delete"
                                            onclick="return confirmDelete()"><i class="fa fa-trash"></i></a>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <nav aria-label="Page navigation example">
                        {{ $cats->links('pagination::bootstrap-4') }}
                    </nav>
                </div>
            @endif
        </div>
    </div>
@endsection
