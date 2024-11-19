

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
        if($_SERVER['REQUEST_METHOD']=== 'POST'){
            $email = $_POST['email'] ?? '' ;
            $password = $_POST['password'] ?? '';
            
            $user = $this->homeModel->checkUser($email, $password);
            if ($user) {
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user'] = $user;
                header("Location: index.php?action=/");
                exit();
            }
            else{
                $err = "Email hoặc mặt khẩu không đúng ";
                header("Location: index.php?action=login");
            }
        }
        require 'views/login.php';
    }
    ///anh
        function logout(){
            session_start();
            unset($_SESSION['user_id'] );
        }
        function register(){
        include_once "views/register.php";
        
            //Kiểm tra email đã tồn tại trong database chưa 
            $emailUser =$this->homeModel->checkEmail($email);
           
                //mã hóa mật khẩu 
                $hidePassword = password_hash($password, PASSWORD_DEFAULT);
                $success = $this->homeModel->registerUser($name,$email,$hidePassword);
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