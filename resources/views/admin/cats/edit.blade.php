@extends('layout.admin_layout')
@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                Edit Category
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('cat.update', $cat->id) }}">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input class="form-control" type="text" name="name" id="name" value="{{ $cat->name }}">
                    </div>
                    <div class="form-group">
                        <label for="content">Description</label>
                        <textarea name="description" class="form-control" id="content" cols="30" rows="5">{{ $cat->description }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
