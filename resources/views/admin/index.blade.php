@extends('admin.layout')

@section('admin_content')
    <h1>Quản lý sản phẩm</h1>

    

    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <div class="d-flex justify-content-between mt-5">
      <div><form action="{{ route('clothe.search') }}" method="GET">
        <input type="text" name="query" placeholder="Nhập tên sản phẩm...">
        <button type="submit">Tìm kiếm</button>
      </div>
      <a href=" {{route('clothe.create')}} " class="btn btn-success">Create New</a>
    </div>
    <table class="table table-bordered mt-2">
        <thead>
          <tr>
            <th scope="col">#ID</th>
            <th scope="col">Title</th>
            <th scope="col">thumbnail</th>
            <th scope="col">describe</th>
            <th scope="col">date</th>
            <th scope="col">price</th>
            <th scope="col">quantity</th>
            <th scope="col">clothe Name</th>
            <th scope="col">Crud</th>
          </tr>
          
        </thead>
        <tbody>
          @foreach ($clothes as $clothe)
              <tr>
            <th scope="row">{{ $clothe->id }}</th>
            <td>{{ $clothe->title }}</td>
            
            <td>
              <img src="{{ asset('/storage/' . $clothe->thumbnail) }}" width="50" alt="{{ $clothe->title }}">
            </td>
            <td>{{ $clothe->describe }}</td>
            <td>{{ $clothe->price }}</td>
            <td>{{ $clothe->date }}</td>
            <td>{{ $clothe->quantity }}</td>
            <td>{{ $clothe->category->name ?? 'Chưa có danh mục' }}</td>
            <td class="d-flex gap-1 text-nowrap">
                <a href="{{ route('clothe.edit', $clothe) }}" class="btn btn-success">Edit</a>
                <a href="{{ route('clothe.detail', $clothe) }}" class="btn btn-success">Detail</a>
                <form action="{{ route('clothe.destroy', $clothe) }}" method="post">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn muốn xóa?')">Delete</button>
                </form>
              
            </td>
          </tr>
          @endforeach
          
        </tbody>
      </table>
      {{ $clothes->links() }}
@endsection