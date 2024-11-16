<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        body{
            margin: auto;
            text-align:center;
            justify-content: center;
            justify-items: center;
        }
        /* form{
            width: 500px;
            height: 300px;
            border: 2px solid rgba(0, 0, 0, 0.201);
            text-align:center;
            justify-content: center;
            justify-items: center;
        } */
        input{
            width: 400px;
            height: 30px;
        }
    </style>
</head>

<body>

    <form action="" enctype="multipart/form-data" method="post">
    <h2>Đăng nhập vào tài khoản</h2>
         <input type="text" name="user" placeholder="Tên đăng nhập"><br> <br>
         <input type="password" name="pass" placeholder="Mật khẩu"><br><br>
        <input type="submit" value="Đăng nhập" name="btn_login">
    </form>
    
</body>
</html>
