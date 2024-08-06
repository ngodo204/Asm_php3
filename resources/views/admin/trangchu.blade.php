@extends('admin.layout')

@section('admin_content')
    <h1>Thống kê sản phẩm theo danh mục</h1>

    <table class="table table-bordered mt-5">
        <thead>
            <tr>
                <th scope="col">Danh mục</th>
                <th scope="col">Số lượng sản phẩm</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($statistics as $stat)
                <tr>
                    <td>{{ $stat->name }}</td>
                    <td>{{ $stat->clothes_count }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
