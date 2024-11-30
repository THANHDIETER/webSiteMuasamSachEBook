<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <style>
        body {
            background-color: #e9ecef;
            font-family: 'Arial', sans-serif;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
        }

        h3 {
            color: #343a40;
            font-weight: bold;
        }

        .table {
            border-radius: 8px;
            overflow: hidden;
        }

        .table-bordered {
            border: 1px solid #dee2e6;
        }

        .table thead {
            background-color: #212529;
            color: white;
        }

        .badge {
            padding: 0.5em 1em;
            font-size: 90%;
        }

        .btn {
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }

        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }

        .text-danger,
        .text-success,
        .text-primary {
            font-weight: bold;
        }

        .alert-info {
            text-align: center;
            font-size: 1.2em;
        }

        header {
            margin-bottom: -20px;
        }
    </style>
</head>

<body>
    <header>
        <!-- nav 1 -->
        <nav style="background-color: lightgray;" class="navbar navbar-expand-lg  ">
            <div class="container  container-fluid">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
                        <li class="nav-item">
                            <a class="nav-link active position-relative" aria-current="page" href="#"> <i
                                    class="bi bi-info-circle"></i> - Trợ Giúp </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#"> <i class="bi bi-newspaper"></i> -
                                Tin Tức</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#"> <i class="bi bi-credit-card"></i> -
                                Khuyễn
                                Mãi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="?act=/"> <i
                                    class="bi bi-credit-card"></i> - Home</a>
                        </li>
                    </ul>
                    <ul class="d-flex navbar-nav  mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#"><i class="bi bi-gift-fill"></i> - Ưu
                                đãi & Tiện
                                Ích</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="?act=order"><i class="bi bi-boxes"></i>
                                - Kiểm Tra
                                Đơn Hàng</a>
                        </li>
                        <?php



                        if (isset($_SESSION['id'])) { // Check if the user session exists
                            // $userName = htmlspecialchars(); 
                            echo '
                                   <li class="nav-item">
                                       <a class="nav-link active" aria-current="page" href="?act=profile"><i class="bi bi-person-circle"> </i></a>
                                   </li>
                                   <li class="nav-item">
                                       <a class="nav-link active" aria-current="page" href="?act=logout"><i class="bi bi-box-arrow-right"></i> Logout</a>
                                   </li>';
                        } else {
                            echo '
                                   <li class="nav-item">
                                       <a class="nav-link active" aria-current="page" href="?act=login"><i class="bi bi-box-arrow-in-left"></i> Login</a>
                                   </li>
                                   <li class="nav-item">
                                       <a class="nav-link active" aria-current="page" href="?act=register"><i class="bi bi-file-earmark-person"></i> Register</a>
                                   </li>';
                        }
                        ?>



                    </ul>
                </div>
            </div>
        </nav>
        <!-- nav 2 -->
    </header>
    <?php if (isset($message)) {
        echo 'Đăng ký thành công';
    } ?>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card border-0 shadow-lg" style="max-width:800px; border-radius: 12px;">
            <div class="row no-gutters">
                <div class="col-md-6">
                    <img src="https://images.unsplash.com/photo-1544947950-fa07a98d237f?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTB8fGJvb2t8ZW58MHx8MHx8fDA%3D"
                        alt="Book Image" class="img-fluid h-100 rounded-left">
                </div>

                <!-- Form đăng ký bên phải -->
                <div class="col-md-6 p-5">
                    <?php if (isset($_SESSION['message'])): ?>
                        <div class="alert alert-danger">
                            <?php echo htmlspecialchars($_SESSION['message']);
                            unset($_SESSION['message']) ?>
                        </div>
                    <?php endif; ?>
                    <h3 class="card-title text-primary font-weight-bold text-center">Đăng ký</h3>
                    <p class="text-muted">Nếu bạn đã có tài khoản hãy đăng nhập</p>
                    <form action="?act=register" method="post">
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="Username">
                            <span><?php if (isset($_SESSION['errorsName'])): ?>
                                    <div class="text-danger">
                                        <?php echo htmlspecialchars($_SESSION['errorsName']);
                                        unset($_SESSION['errorsName']) ?>
                                    </div>
                                <?php endif; ?>
                            </span>
                        </div><br>
                        <div class="form-group">
                            <input type="email" name="email" class="form-control" placeholder="Email">
                            <span><?php if (isset($_SESSION['errorsName'])): ?>
                                    <div class="text-danger">
                                        <?php echo htmlspecialchars($_SESSION['errorsName']);
                                        unset($_SESSION['errorsEmail']) ?>
                                    </div>
                                <?php endif; ?>
                            </span>
                        </div><br>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control" placeholder="Password">
                            <span><?php if (isset($_SESSION['errorsPassword'])): ?>
                                    <div class="text-danger">
                                        <?php echo htmlspecialchars($_SESSION['errorsName']);
                                        unset($_SESSION['errorsName']) ?>
                                    </div>
                                <?php endif; ?>
                            </span>
                        </div><br>
                        <button type="submit" name="btn_dk" class="btn btn-primary btn-block">Đăng ký</button>
                    </form>
                    <div class="mt-3">
                        <a href="#" class="text-primary">Quên mật khẩu</a>
                    </div>
                    <hr>
                    <p>Bạn đã có tài khoản?<a href="?act=login" class="text-primary">Đăng nhập ngay</a></p>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>