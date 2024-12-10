@extends('layout.admin_layout')
@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                Add Category
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('cat.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="name">Tên danh mục</label>
                        <input class="form-control" type="text" name="name" id="name" value="{{ old('name') }}">
                    </div>
                    <div class="form-group">
                        <label for="content">Mô tả</label>
                        <textarea name="description" class="form-control" id="content" cols="30" rows="5">{{ old('description') }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Thêm mới</button>
                </form>
            </div>
        </div>
    </div>
@endsection
