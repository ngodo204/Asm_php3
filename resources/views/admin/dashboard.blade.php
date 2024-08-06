@extends('admin.layout')

@section('admin_content')

    <div class="mt-5" style="display: flex; justify-content:space-between; align-items:center;">
        <div>
            <h1>Quản lý user</h1>
            
        </div>
        
    </div>
    @if (session('success'))
    <div class="alert alert-success" style="margin-top: 12px;">
        {{ session('success') }}
    </div>
    @endif
    <div class="d-flex justify-content-between mt-5">
        <div></div>
        <a href="{{ route('admin.users.create', $user) }}" class="btn btn-success">Create</a>
    </div>
    <table class="table table-bordered mt-2">
        <thead>
            <tr>
                <th>ID</th>
                <th>Fullname</th>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th>Active</th>
                <th>Actions</th>
                <th>Crud</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->fullname }}</td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
                <td>{{ $user->active ? 'active' : 'inactive' }}</td>
                <td>
                    <form action="{{ route('admin.toggleActivation', $user->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn {{ $user->active ? 'btn-danger' : 'btn-success' }}">
                            {{ $user->active ? 'Inactive' : 'Activate' }}
                        </button>
                    </form>
                </td>
                <td style="width: 1px;" class="text-nowrap">
                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-warning">Edit</a>
                    
                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection