<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Hiển thị danh sách người dùng
    public function index()
    {
        $users = User::all();
        return view('admin.dashboard', compact('users'));
    }

    // Hiển thị form tạo mới người dùng
    public function create()
    {
        return view('admin.users.create');
    }

    // Lưu người dùng mới vào cơ sở dữ liệu
    public function store(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'fullname' => $request->input('fullname'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role' => $request->input('role', 'user'),
            'active' => $request->input('active', 1),
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Người dùng đã được thêm thành công.');
    }

    // Hiển thị form chỉnh sửa người dùng
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    // Cập nhật thông tin người dùng
    public function update(Request $request, User $user)
    {
        $request->validate([
            'fullname' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->fullname = $request->input('fullname');
        $user->username = $request->input('username');
        $user->email = $request->input('email');

        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        $user->role = $request->input('role', 'user');
        $user->active = $request->input('active', 1);

        $user->save();

        return redirect()->route('admin.dashboard')->with('success', 'Người dùng đã được cập nhật thành công.');
    }

    // Xóa người dùng
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Người dùng đã được xóa thành công.');
    }




    // public function update(Request $request)
    // {
    //     $user = Auth::user();
    //     $user->fullname = $request->input('fullname');
    //     $user->username = $request->input('username');
    //     $user->email = $request->input('email');
    //     $user->update();

    //     return redirect()->route('welcome')->with('success', 'Thông tin đã được cập nhật thành công');
    // }

    // public function changePasswordForm()
    // {
    //     return view('changePassword');
    // }

    // public function changePassword(Request $request)
    // {
    //     // Validate yêu cầu
    //     $user = Auth::user();
    //     // Cập nhật mật khẩu mới
    //     if ($request->input('password') ==  $request->input('confirmPassword')) {
    //         $user->password = Hash::make($request->input('password'));
    //         $user->update();
    //         return redirect()->route('welcome')->with('success', 'Mật khẩu đã được thay đổi thành công.');
    //     }
    // }

    // public function logout(Request $request)
    // {
    //     Auth::logout(); // Đăng xuất người dùng
    //     $request->session()->invalidate(); // Xóa phiên làm việc
    //     $request->session()->regenerateToken(); // Tạo lại token CSRF

    //     return redirect('/login'); // Chuyển hướng người dùng đến trang đăng nhập
    // }
}
