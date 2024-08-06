<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link href="{{asset('lib')}}/bootstrap.min.css" rel="stylesheet">
    <script src="{{asset('lib')}}/bootstrap.bundle.min.js"></script>
    <script src="{{asset('lib')}}/font-fontawesome-ae333ffef2.js"></script>
</head>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f8f9fa;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    .container {
        max-width: 500px;
        width: 100%;
    }

    .card {
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        margin: 20px 0;
    }

    .card-header {
        background: #007bff;
        color: #fff;
        padding: 10px 15px;
        font-size: 1.25rem;
        text-align: center;
    }

    .card-body {
        padding: 15px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
    }

    .alert-success {
        background-color: #dff0d8;
        color: #3c763d;
        padding: 10px;
        border: 1px solid #d6e9c6;
        margin-bottom: 20px;
        border-radius: 5px;
    }

    .alert-danger {
        background-color: red;
        color: white;
        padding: 10px;
        border: 1px solid #d6e9c6;
        margin-bottom: 20px;
        border-radius: 5px;
    }

    .form-group input {
        width: 100%;
        padding: 8px;
        box-sizing: border-box;
        border: 1px solid #ced4da;
        border-radius: 4px;
    }

    .btn {
        display: inline-block;
        background: #007bff;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        text-align: center;
    }

    .btn:hover {
        background: #0056b3;
    }
</style>
<body>
    <div class="container">
        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif
        <div class="card">
            <div class="card-header">Login User</div>
            <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label for="username">Email:</label>
                        <input type="text" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div style="display: flex; justify-content:space-between;">
                        <button type="submit" class="btn">Submit</button>
                        <a href="{{ route('register') }}">Đăng ký</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
