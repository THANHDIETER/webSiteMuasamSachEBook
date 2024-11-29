<?php
    require_once 'models/homeModel.php';
    class homeController{
        public $homeModel;
        function __construct(){
            $this->homeModel=new homeModel();
        }
        function home(){
            $products = $this->homeModel->allProduct();
            $top4 = $this->homeModel->top8Product();
            $danhmuc = $this->homeModel->alldanhmuc();
            if(isset($_GET['submit'])){
                   echo '<script type="text/javascript">
                       window.location.href = "?act=search";
               </script>';    
            }
           require "views/home.php";
        }
       
        function detail($id) {
            // Lấy thông tin sản phẩm
            $productOne = $this->homeModel->findProductById($id);
            $top8 = $this->homeModel->top6Product();
            
            // Lấy danh sách biến thể cho sản phẩm
            $variants = $this->homeModel->getVariantsByProductId($id);
            
            // Xử lý bình luận
            if(isset($_SESSION['id'])) {  
                if(isset($_POST['submit'])){
                    $cmt = $this->homeModel->allCmt();
                } else {
                    $cmt = $this->homeModel->Cmt();
                }
                if(isset($_POST['btn_submit'])){
                    $this->homeModel->addComment($_SESSION['id'], $id, $_POST['comment']);
                    echo '<script type="text/javascript">
                            if (confirm("Bạn đã gửi comment. Bạn có muốn load lại trang không?")) {
                                window.location.href = "?act=detail&id=' . $id . '";
                            }
                          </script>';
                }
            } else {
                echo '<script type="text/javascript">
                        if (confirm("Bạn chưa đăng nhập. Bạn có muốn chuyển sang trang đăng nhập không?")) {
                            window.location.href = "?act=login";
                        }
                      </script>';
            }
            
            // Gọi view và truyền dữ liệu sản phẩm cùng biến thể vào
            require_once 'views/detail.php';
        }
        function product(){
            $products=$this->homeModel->allProduct();
            $danhmucs=$this->homeModel->alldanhmuc();
            require_once 'views/product.php';
        }
        function dmshow($id){
            $dmuc=$this->homeModel->dmshowid($id);
            $danhmucs=$this->homeModel->alldanhmuc();
            require_once 'views/dMuc_id.php';
        }
       
        function cart($id){
           
        }
        function login(){
            if (isset($_POST['btn_submit'])) {
                $user = $this->homeModel->checkUser($_POST['email'], $_POST['password']);
                if ($user) {
                    $_SESSION['id'] = $user['id'];
                    $_SESSION['name'] = $user['name'];
                    $_SESSION['is_admin'] = $user['is_admin'];
                    echo '<script type="text/javascript">
                            window.location.href = "?act=home";
                            alert("Bạn đã login thành công");
                        </script>';
                } else {
                    echo "<script>alert('Đăng nhập thất bại');</script>";
                }
            }
            require "views/login.php";
        }
       
       
        function register(){
           
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
            require_once 'views/register.php';
        }
    }


        function logout(){
         
            session_unset();
            // unset($_SESSION['user_id'] );
            echo '<script type="text/javascript">
                        window.location.href = "?act=login";
                        alert("Bạn đã đăng xuất thành công");
                    </script>';
        }    


        function search($keySearch){
            $allSearch = $this->homeModel->searchModel($keySearch);
            require_once 'views/search.php';
        }


       
       
    }



?>
