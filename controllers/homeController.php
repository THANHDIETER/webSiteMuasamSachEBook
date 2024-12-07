<?php
require_once 'models/homeModel.php';
class homeController
{
    public $homeModel;
    function __construct()
    {
        $this->homeModel = new homeModel();
    }
    function home(){
        $products = $this->homeModel->allProduct();
       
        $top5 = $this->homeModel->top5Product();
        $top4 = $this->homeModel->top4Product();
        $top3 = $this->homeModel->to3Product();
        $danhmuc = $this->homeModel->alldanhmuc();
        if(isset($_GET['submit'])){
               echo '<script type="text/javascript">
                   window.location.href = "?act=search";
           </script>';    
        }
       require "views/home.php";
    }

    public function detail($id) {
        // Lấy thông tin sản phẩm
        $productOne = $this->homeModel->findProductById($id);
        $top8 = $this->homeModel->top6Product();
        $variants = $this->homeModel->getVariantsByProductId($id);
        $updateId = $this->homeModel->updateId($id);
        // Kiểm tra nếu người dùng đã đăng nhập
        if (isset($_SESSION['id'])) {
            if (isset($_POST['btn_submit'])) {
                $comment = htmlspecialchars($_POST['comment']); // Xử lý an toàn dữ liệu
                $this->homeModel->addComment($_SESSION['id'], $id, $comment);
                
                      header("location:index.php?act=detail&id=$id");
            }
            $cmt = $this->homeModel->Cmt($id); // Lấy bình luận theo product_id
        } else {
            $cmt = $this->homeModel->Cmt($id);
        }
    
        // Gọi view và truyền dữ liệu sản phẩm, biến thể, bình luận vào
        require_once 'views/detail.php';
    }
    
    function product()
    {
        $products = $this->homeModel->allProduct();
        $danhmucs = $this->homeModel->alldanhmuc();
        require_once 'views/product.php';
    }
    function dmshow($id)
    {
        $dmuc = $this->homeModel->dmshowid($id);
        $danhmucs = $this->homeModel->alldanhmuc();
        require_once 'views/dMuc_id.php';
    }
    function login()
    {
        if (isset($_SESSION['name'])) {
            header('Location: ' . BASE_URL);
            exit;
        }
        if (isset($_POST['btn_submit'])) {
            $user = $this->homeModel->checkUser($_POST['email'], $_POST['password']);
            if ($user) {
                $_SESSION['id'] = $user['id'];
                $_SESSION['name'] = $user['name'];
                $_SESSION['is_admin'] = $user['is_admin'];
                if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1) {
                    header('Location: ' . BASE_URL . '/admin/index.php?act=dashboard');
                } else {
                    header('Location: ' . BASE_URL);
                }
            } else {
                echo "<script>alert('Đăng nhập thất bại');</script>";
            }
        }
        require "views/login.php";
    }


    function register()
    {
        if (isset($_SESSION['name'])) {
            header('Location: ' . BASE_URL);
            exit;
        }
        if (isset($_POST['btn_dk'])) {
            $email = $this->homeModel->getUserEmail($_POST['email']);
            if ($email) {
                $_SESSION['message'] = 'Email đã tồn tại';
                header("Location: index.php?act=register");
                exit;
            }
            $data = [
                'name' => $_POST['name'] ?? null,
                'email' => $_POST['email'] ?? null,
                'password' => $_POST['password'] ?? null,
            ];
            if ($data) {
                $check = true;
                if (!$data['name']) {
                    $_SESSION['errorsName'] = 'Tên không hợp lệ';
                    $check = false;
                }
                if (!$data['email']) {
                    $_SESSION['errorsEmail'] = 'email không hợp lệ';
                    $check = false;
                }
                if (!$data['password']) {
                    $_SESSION['errorsPassword'] = 'password không hợp lệ';
                }
                if ($check) {
                    $add_user = $this->homeModel->add_user($_POST['email'], $_POST['name'], $_POST['password']);
                    $_SESSION['message'] = 'Đăng ký thành công';
                    header("Location: index.php?act=login");
                    exit;
                }
                header("Location: index.php?act=register");
                exit;
            }
        }
        require_once 'views/register.php';
    }
    
    // homeController.php
    public function profile() {
        if (isset($_SESSION['id'])) {
            $userId = $_SESSION['id'];
            $user = $this->homeModel->getUserById($userId); 
            if ($user) {
                require 'views/profile.php'; // Gọi giao diện Profile
            } else {
                echo "Không tìm thấy thông tin người dùng.";
            }
        } else {
            echo "Bạn cần đăng nhập để truy cập trang này.";
            header("Location: ?act=login");
            exit;
        }
    }
    // homeController.php
public function editProfile() {
    if (isset($_SESSION['id'])) {
        $userId = $_SESSION['id'];
        $user = $this->homeModel->getUserById($userId);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? $user['name'];
            $phone = $_POST['phone'] ?? $user['phone'];
            $address = $_POST['address'] ?? $user['address'];

            $this->homeModel->updateUserProfile($userId, $name, $phone, $address); // Cập nhật thông tin
            echo "Cập nhật thành công!";
            header("Location: ?act=profile");
            exit;
        }

        require 'views/edit_profile.php'; // Hiển thị form chỉnh sửa
    } else {
        echo "Bạn cần đăng nhập để truy cập trang này.";
        header("Location: ?act=login");
        exit;
    }
}


    function logout()
    {
        session_start(); // Đảm bảo session đã khởi tạo
        session_unset(); // Xóa tất cả các biến session
        session_destroy(); // Hủy toàn bộ session
        setcookie(session_name(), '', time() - 3600, '/'); // Xóa session cookie
        header('Location: ?act=login');
        echo '<script>alert("Bạn đã đăng xuất thành công");</script>';
        exit();
    }
    
    // homeController.php
public function forgotPassword() {
    if (isset($_POST['email'])) {
        $email = $_POST['email'];

        // Kiểm tra email trong cơ sở dữ liệu
        $user = $this->homeModel->getUserByEmail($email);
        if ($user) {
            // Tạo token để gửi qua email
            $token = bin2hex(random_bytes(5));
            $this->homeModel->savePasswordResetToken($user['id'], $token);

            // Gửi email với đường dẫn reset
            $resetLink = "http://localhost/webSiteMuasamSachEBook-DuAn1/index.php?act=resetPassword&token=$token";
            mail($email, "Reset Mật khẩu", "Click vào liên kết để thay đổi mật khẩu: $resetLink");

            echo "Chúng tôi đã gửi một email đến bạn với hướng dẫn thay đổi mật khẩu.";
        } else {
            echo "Email không tồn tại.";
        }
    }
    require 'views/forgot_password.php'; // Form quên mật khẩu
}

public function resetPassword() {
    if (isset($_GET['token'])) {
        $token = $_GET['token'];
        $user = $this->homeModel->getUserByToken($token);

        if ($user) {
            // Kiểm tra xem người dùng đã gửi form hay chưa
            if (isset($_POST['password'])) {
                $password = $_POST['password'];

                // Cập nhật mật khẩu mới và xóa token
                $this->homeModel->updatePassword($user['id'], $password);
                $this->homeModel->deletePasswordResetToken($user['id']);

                echo "Mật khẩu của bạn đã được thay đổi thành công.";
                header('Location: ?act=login'); // Quay lại trang đăng nhập
            } else {
                // Nếu chưa gửi form, hiển thị form đổi mật khẩu
                require 'views/reset_password.php'; // Form đổi mật khẩu
            }
        } else {
            echo "Token không hợp lệ hoặc đã hết hạn.";
        }
    } else {
        echo "Không có token được cung cấp.";
    }
}


    

    function search($keySearch)
    {
        $allSearch = $this->homeModel->searchModel($keySearch);
        require_once 'views/search.php';
    }
}
