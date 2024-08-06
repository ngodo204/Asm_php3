@extends('admin.layout')

@section('admin_content')
    <div class="container">
        <h1>Thêm mới sách</h1>
        <form action="{{ route('clothe.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="" class="form-label">Title</label>
                <input type="text" class="form-control" id="" name="title">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Url thumbnail</label>
                <input type="file" class="form-control" id="" name="thumbnail">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">describe</label>
                <input type="text" class="form-control" id="" name="describe">
            </div>

            <div class="mb-3">
                <label for="" class="form-label">price</label>
                <input type="number" class="form-control" id="" name="price">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">date</label>
                <input type="date" class="form-control" id="" name="date">
            </div>  
            <div class="mb-3">
                <label for="" class="form-label">quantity</label>
                <input type="number" class="form-control" id="" name="quantity">
            </div>

            <div class="mb-3">
                <label for="" class="form-label">clothe Name</label>
                <select name="category_id" class="form-control">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">
                            {{$category->name}}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-success">Add new</button>
                <a href="{{ route('clothe.index') }}" class="btn btn-danger">Quay lại</a>
            </div>
        </form>
    </div>
@endsection