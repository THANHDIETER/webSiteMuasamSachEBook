

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
            $top8 = $this->homeModel->top6Product();
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
            if(isset($_POST['btn_submit'])){;
                $user = $this->homeModel->checkUser($_POST['email'],$_POST['password']);
                if($user['is_admin']==1){
                    session_start();
                    $_SESSION['id'] = $user['id'] ;
                    echo '<script type="text/javascript">
                        window.location.href = "?act=insert";
                        alert("Bạn đã login thành công");
                    </script>';
                }else if($user){
                    session_start();
                    $_SESSION['id'] = $user['id'] ;
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
        
       
        function register(){
            
            if(isset($_POST['btn_dk'])){
                $add_user=$this->homeModel->add_user($_POST['email'],$_POST['name'],$_POST['password']);
               echo '<script type="text/javascript">
                        window.location.href = "?act=login";
                        alert("Bạn đã dang ky thành công");
                    </script>';
            }else{
                echo "<script>alert('Đăng nhập thất bại');</script>";
            }
            require_once 'views/register.php';
         }
// $hidePassword = password_hash($password, PASSWORD_DEFAULT);
            //     $success = $this->homeModel->registerUser($name,$email,$hidePassword);
            //     if($success){
            //         header("Location:index.php?action=login");
            //         exit();
            //     }else{
            //         $err = "Không thể đăng ký";
            //         require "views/register.php";
            //     }
        function logout(){
            session_unset();
            // unset($_SESSION['user_id'] );
            echo '<script type="text/javascript">
                        window.location.href = "?act=login";
                        alert("Bạn đã login thành công");
                    </script>';
        }        
    }


















?>