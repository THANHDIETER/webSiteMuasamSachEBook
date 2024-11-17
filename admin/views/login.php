<?php
session_start();
$thongBao = "";

if (isset($_POST["submitFormDangNhap"])) {
    $username = htmlspecialchars(trim($_POST["username"])); // Xử lý ký tự đặc biệt
    $password = htmlspecialchars($_POST["password"]);       // Bảo mật đầu vào

    // Kiểm tra người dùng có nhập cả 2 thông tin
    if (!empty($username) && !empty($password)) {
        // Validate độ dài username và password
        if (strlen($username) >= 4 && strlen($password) >= 5) {
            if ($username == "admin" && $password == "12345") {
                $_SESSION["username"] = $username;

                // Hiển thị thông tin đăng nhập thành công
                echo '<script>alert("Đăng nhập thành công")</script>';

                // Điều hướng về trang danh sách
                echo '<script>window.location="listproduct.php"</script>';
            } else {
                $thongBao = "Username hoặc Password không đúng";
            }
        } else {
            $thongBao = "Username phải ít nhất 4 ký tự và Password phải ít nhất 5 ký tự";
        }
    } else {
        $thongBao = "Vui lòng nhập đầy đủ Username và Password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f4f6;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-container {
            background-color: #ffffff;
            padding: 20px 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }
        h3 {
            color: #333333;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }
        .form-group span {
            display: block;
            font-weight: bold;
            color: #555555;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #dddddd;
            border-radius: 5px;
            font-size: 14px;
        }
        .form-group input:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .message {
            color: red;
            margin-top: 10px;
            font-size: 14px;
        }
    </style>
    <script>
        function validateForm() {
            const username = document.forms["loginForm"]["username"].value.trim();
            const password = document.forms["loginForm"]["password"].value.trim();

            if (username === "" || password === "") {
                alert("Vui lòng nhập đầy đủ Username và Password");
                return false;
            }

            if (username.length < 4) {
                alert("Username phải ít nhất 4 ký tự");
                return false;
            }

            if (password.length < 5) {
                alert("Password phải ít nhất 5 ký tự");
                return false;
            }

            return true;
        }
    </script>
</head>
<body>
    <div class="login-container">
        <h1 style="text-align: center; color: red">Đăng nhập vào trang listproduct</h1>
        <form name="loginForm" action="" method="POST" onsubmit="return validateForm()">
            <div>
                <span>Username:</span>
                <?php
                if (isset($_POST["submitFormDangNhap"])) {
                    echo '<input type="text" name="username" value="' . $_POST["username"] . '">';
                } else {
                    echo '<input type="text" name="username">';
                }
                ?>
            </div>
            <br>
            <div>
                <span>Password:</span>
                <input type="password" name="password">
            </div>
            <br>
            <div>
                <button type="submit" name="submitFormDangNhap">Đăng nhập</button>
            </div>
            <p class="message">
                <?php echo $thongBao; ?>
            </p>
        </form>
    </div>
</body>
</html>
