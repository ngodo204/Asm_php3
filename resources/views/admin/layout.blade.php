<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('lib') }}/bootstrap.min.css" rel="stylesheet">
    <script src="{{ asset('lib') }}/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('lib') }}/font-fontawesome-ae333ffef2.js"></script>

    <title>ADMIN</title>
</head>
{{-- <style>
    .size{
        border: 1px solid rgb(170, 170, 170);
        width: 40px;
    }
    .size:focus{
        background-color: red;
    }
</style> --}}

<body>
    <nav class="navbar navbar-expand-sm bg-secondary shadow">
        <div class="container-fluid">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="" href="admin.html">
                        <img style="height: 50px;" src="/img/logo.jpg" alt="">
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav ">
                <li class="nav-item ">
                    @auth
                        <b style="color: rgb(255, 255, 255); margin-right: 20px">ADMIN: {{ Auth::user()->fullname }}</b>
                        <a class="btn btn-danger text-light" href="{{ route('login') }}"><b>Logout</b></a>
                    @endauth
                </li>
            </ul>
        </div>
    </nav>
    <div class="d-flex">
        <div class="bg-dark" style=" width: 300px; height: calc(100vh - 66px);">
            <ul class="nav flex-column mt-5">
                <li class="nav-item">
                    <a class="nav-link text-light" href="{{ route('statistics.trangchu') }}">
                        <h5 style="margin-top: 20px;"><i class="fa-solid fa-shirt"></i> Trang chủ</h5>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="{{ route('clothe.index') }}">
                        <h5 style="margin-top: 20px;"><i class="fa-solid fa-table-cells-large"></i> Danh sách sản phẩm
                        </h5>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="{{ route('admin.dashboard') }}">
                        <h5 style="margin-top: 20px;"><i class="fa-solid fa-user-group"></i> Quản lý user</h5>
                    </a>
                </li>

            </ul>
        </div>
        <!-- 3. Bên phải: Nội dung chính (container) -->
        <div class="" style="width: calc(100% - 300px);">
            <div class="container mt-3">
                <div>
                    <article>
                        @yield('admin_content')
                    </article>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
