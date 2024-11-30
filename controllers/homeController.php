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
    
        // Kiểm tra nếu người dùng đã đăng nhập
        if (isset($_SESSION['id'])) {
            if (isset($_POST['btn_submit'])) {
                $comment = htmlspecialchars($_POST['comment']); // Xử lý an toàn dữ liệu
                $this->homeModel->addComment($_SESSION['id'], $id, $comment);
                
                      header("location:index.php?act=detail&id=$id");
            }
            $cmt = $this->homeModel->Cmt($id); // Lấy bình luận theo product_id
        } else {
            echo '<script type="text/javascript">
                    alert("Bạn chưa đăng nhập. Vui lòng đăng nhập để bình luận.");
                    window.location.href = "?act=login";
                  </script>';
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
    function login() {
        if (isset($_SESSION['name'])) {
            header('Location: ' . BASE_URL . '/index.php?act=home');
            exit; // Dừng thực thi script
        }
    
        if (isset($_POST['btn_submit'])) {
            $user = $this->homeModel->checkUser($_POST['email'], $_POST['password']);
            if ($user) {
                $_SESSION['id'] = $user['id'];
                $_SESSION['name'] = $user['name'];
                $_SESSION['is_admin'] = $user['is_admin'];
    
                if ($user['is_admin'] == 1) { // Điều hướng admin
                    header('Location: ' . BASE_URL . '/admin/index.php?act=dashboard');
                } else { // Điều hướng người dùng thường
                    header('Location: ' . BASE_URL . '/index.php?act=home');
                }
                exit; // Dừng script sau redirect
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


    function logout()
    {

        session_unset();
        // unset($_SESSION['user_id'] );
        echo '<script type="text/javascript">
                        window.location.href = "?act=login";
                        alert("Bạn đã đăng xuất thành công");
                    </script>';
    }


    function search($keySearch)
    {
        $allSearch = $this->homeModel->searchModel($keySearch);
        require_once 'views/search.php';
    }
}
