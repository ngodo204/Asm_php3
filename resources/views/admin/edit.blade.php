@extends('admin.layout')

@section('admin_content')
    <div class="container">
        <h1>Update sách</h1>
        <form action="{{ route('clothe.update', $clothe) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            {{-- <input type="hidden" name="id" value="{{ $clothe->id }}"> --}}
            <div class="mb-3">
                <label for="" class="form-label">Title</label>
                <input type="text" class="form-control" value="{{ $clothe->title }}" name="title">
            </div>

            <div class="mb-3">
                <label class="form-label">Image</label>
                <input class="form-control" type="file" name="thumbnail" id="thumbnail">
                <br>
                <img id="img" src="{{ asset('/storage/' . $clothe->thumbnail) }}" width="60"
                    alt="{{ $clothe->title }}">
            </div>

            <div class="mb-3">
                <label for="" class="form-label">describe</label>
                <input type="text" class="form-control" value="{{ $clothe->describe }}" name="describe">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">price</label>
                <input type="text" class="form-control" value="{{ $clothe->price }}" name="price">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Date</label>
                <input type="datetime-local" class="form-control" value="{{ $clothe->date }}" name="date">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">quantity</label>
                <input type="text" class="form-control" value="{{ $clothe->quantity }}" name="quantity">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">clothe Name</label>
                <select name="category_id" class="form-control">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @if ($category->id === $clothe->category_id) selected @endif>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-success">Update clothe</button>
                <a href="{{ route('clothe.index') }}" class="btn btn-danger">Quay lại</a>
            </div>
        </form>
    </div>
@endsection
