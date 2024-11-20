

<?php
    require_once 'models/homeModel.php';
    class homeController{
        public $homeModel;
        function __construct(){
            $this->homeModel=new homeModel();
        }
        function home(){
            $products = $this->homeModel->allProduct();
            $top8 = $this->homeModel->top8Product();
            $danhmuc = $this->homeModel->alldanhmuc();
           require "views/home.php";
        }
        
        function detail($id){
            $productOne=$this->homeModel->findProductById($id);
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
        
        function cart(){
        
        }
        function login(){
            if(isset($_POST['btn_submit'])){;
                $user = $this->homeModel->checkUser($_POST['email'],$_POST['password']);
                if($user){
                    session_start();
                    $_SESSION['id'] = $user['id'];
                    echo '<script type="text/javascript">
                        window.location.href = "?act=home";
                        alert("Bạn đã login thành công");
                    </script>';
                }else{
                    echo "<script>alert('Đăng nhập thất bại');</script>";
                }
            }
            require "views/login.php";
        }
        
         header("Location:views/login.php");
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $email = $_POST['email']  ;
            $password = $_POST['password'] ;
            
            $user = $this->homeModel->checkUser();
            if ($user =! null ) {
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user'] = $user['email'];
                header("Location: ?act=/");
                exit();
            }
            else{
                $err = "Email hoặc mặt khẩu không đúng ";
                header("Location:views/home.php");
            }
        }
     
    }
    ///anh
        function logout(){
            session_start();
            session_unset();
        }
        function register(){
        include_once "views/register.php";
        
            //Kiểm tra email đã tồn tại trong database chưa 
            $emailUser =$this->homeModel->checkEmail($email);
           
                //mã hóa mật khẩu 
                $hidePassword = password_hash($password, PASSWORD_DEFAULT);
                $user = $this->homeModel->allUser();
                if($success){
                    header("Location:index.php?action=login");
                    exit();
                }else{
                    $err = "Không thể đăng ký";
                    require "views/register.php";
                }
            }
            ////day laogin
        
    }


















?>