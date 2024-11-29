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
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" class="form-control" placeholder="Email">
                            <span><?php if (isset($_SESSION['errorsName'])): ?>
                                    <div class="text-danger">
                                        <?php echo htmlspecialchars($_SESSION['errorsName']);
                                        unset($_SESSION['errorsEmail']) ?>
                                    </div>
                                <?php endif; ?>
                            </span>
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control" placeholder="Password">
                            <span><?php if (isset($_SESSION['errorsPassword'])): ?>
                                    <div class="text-danger">
                                        <?php echo htmlspecialchars($_SESSION['errorsName']);
                                        unset($_SESSION['errorsName']) ?>
                                    </div>
                                <?php endif; ?>
                            </span>
                        </div>
                        <button type="submit" name="btn_dk" class="btn btn-primary btn-block">Đăng ký</button>
                    </form>
                    <div class="mt-3">
                        <a href="#" class="text-primary">Quên mật khẩu</a>
                    </div>
                    <hr>
                    <p>Bạn đã có tài khoản?<a href="#" class="text-primary">Đăng nhập ngay</a></p>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>