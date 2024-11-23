
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</head>


<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card border-0 shadow-lg" style="max-width: 900px; border-radius: 12px;">
            <div class="row no-gutters d-flex align-items-stretch">
                <!-- Phần đăng nhập bên trái -->
                <div class="col-md-6 p-5">
                    <h3 class="card-title text-primary font-weight-bold text-center">Đăng nhập</h3>
                    <form action="" method="POST">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Email" name="email" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="password" name="password" required>
                        </div>
                        <button type="submit" name="btn_submit" class="btn btn-primary btn-block mb-3">Đăng nhập</button>
                    </form>
                    <div class="text-center text-muted mb-3">HOẶC</div>
                    <button type="button" class="btn btn-outline-primary btn-block mb-3">
                        <img src="https://img.icons8.com/color/16/000000/google-logo.png" alt="Google Logo"
                            class="mr-2">
                        Login with Google
                    </button>
                    <div class="text-center">
                        <a href="#" class="text-primary">Quên mật khẩu</a>
                    </div>
                    <hr>
                    <p class="text-center">Bạn chưa có tài khoản? <a href="?act=register" class="text-primary">Đăng ký ngay</a></p>
                </div>

                <!-- Phần hình ảnh bên phải -->
                <div class="col-md-6 h-100">
                    <img src="https://images.unsplash.com/photo-1616606103915-dea7be788566?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1887&q=80"
                        alt="Book Image" class="img-fluid h-100 w-100 rounded-right">
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>