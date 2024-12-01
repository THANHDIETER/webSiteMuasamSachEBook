<?php
    // controllers/userController.php

require_once 'models/userModel.php';

class userController {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    // Hiển thị danh sách người dùng
    public function listUsers() {
        $users = $this->userModel->getAllUsers();
        require 'views/user/newUser.php'; // Hiển thị view người dùng
    }

    // Xóa người dùng
    public function deleteUser() {
        if (isset($_GET['user_id'])) {
            $user_id = intval($_GET['user_id']);
            $this->userModel->deleteUser($user_id);
            echo "<script>
                    alert('Xóa người dùng thành công!');
                    window.location.href = '?act=listUsers';
                  </script>";
        } else {
            echo "Dữ liệu không hợp lệ.";
        }
    }

    // Sao chép người dùng
    public function copyUser() {
        if (!isset($_GET['user_id'])) {
            echo "Dữ liệu không hợp lệ.";
            return;
        }

        $user_id = $_GET['user_id'];
        $user = $this->userModel->getUserById($user_id);

        if ($user) {
            // Sao chép người dùng với thông tin từ người dùng cũ
            $this->userModel->copyUser($user);
            header('Location: ?act=listUsers');
            exit();
        } else {
            echo "Người dùng không tồn tại.";
        }
    }

    // Chỉnh sửa thông tin người dùng
    public function editUser() {
        if (!isset($_GET['user_id'])) {
            echo "Dữ liệu không hợp lệ.";
            return;
        }

        $user_id = $_GET['user_id'];
        $user = $this->userModel->getUserById($user_id);

        // Kiểm tra xem người dùng có tồn tại không
        if (!$user) {
            echo "Người dùng không tồn tại.";
            return;
        }

        // Xử lý form khi người dùng gửi yêu cầu sửa
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $is_admin = isset($_POST['is_admin']) ? 1 : 0; // Kiểm tra xem có phải admin hay không

            // Cập nhật thông tin người dùng
            $this->userModel->updateUser($user_id, $name, $email, $phone, $address, $is_admin);

            // Điều hướng về trang danh sách người dùng
            header('Location: ?act=listUsers');
            exit();
        }

        require_once 'views/user/editUser.php';  // Tạo view để chỉnh sửa người dùng
    }

    // Thêm người dùng mới
    public function addUser() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy thông tin từ form
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $is_admin = isset($_POST['is_admin']) ? 1 : 0; // Kiểm tra xem có phải admin hay không

            // Kiểm tra thông tin người dùng
            if (empty($name) || empty($email) || empty($password)) {
                echo "Vui lòng điền đầy đủ thông tin.";
                return;
            }

            // Mã hóa mật khẩu
            $password = password_hash($password, PASSWORD_DEFAULT);

            // Thêm người dùng mới vào cơ sở dữ liệu
            $this->userModel->addUser($name, $email, $password, $phone, $address, $is_admin);

            // Điều hướng về trang danh sách người dùng
            header('Location: ?act=listUsers');
            exit();
        }

        require_once 'views/user/addUser.php'; // Tạo view để thêm người dùng
    }
}

?>