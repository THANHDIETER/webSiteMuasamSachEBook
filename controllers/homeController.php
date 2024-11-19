

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
        
        function cart(){
           
        }
        function login(){
           require_once 'views/login.php';
        }
       
        function register(){
            if(isset($_POST['name'])){
                $add_user=$this->homeModel->add_user($_POST['email'],$_POST['name'],$_POST['password']);
                $message = 'đang ký thành công';
            }else{
                $message = 'đang ký Không thành công';
            }
            require_once 'views/register.php';
         }

        function logout(){
            
        }
        
    }
?>