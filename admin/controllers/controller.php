<?php
require_once 'models/model.php';
class productController
{
     public $productModel;
     public $danhmucModel;
     public $nhaXuatBanModel;
     public $tacGiaModel;
     function __construct()
     {
          $this->productModel = new productModel();
          $this->danhmucModel = new danhmucModel();
          $this->nhaXuatBanModel = new nhaXuatBanModel();
          $this->tacGiaModel = new tacGiaModel();
     }
     function listProduct()
     {

          $allProduct = $this->productModel->getAllProduct();
          require_once './views/products/listProduct.php';
     }

     public function insert()
     {

          $listDanhMuc = $this->danhmucModel->getAllDanhmuc();
          $listNhaXuatBan = $this->nhaXuatBanModel->getAllNhaXuatBan();
          $listTacGia = $this->tacGiaModel->getAllTacgia();


          require_once './views/products/addProduct.php';
          if (isset($_POST['btn_insert'])) {
               $name = $_POST['name'];
               $category_id = $_POST['category_id'];
               $publishing_house_id = $_POST['publishing_house_id'];
               $author_id = $_POST['author_id'];
               $img = $_FILES['img']['name'];
               $tmp = $_FILES['img']['tmp_name'];
               move_uploaded_file($tmp, '../assets/images/prod/books/' . $img);
               $price = $_POST['price'];
               $description = $_POST['description'];

               if ($this->productModel->insert($name, $category_id, $publishing_house_id, $author_id, $img, $price, $description)) {

                    echo '<script type="text/javascript">
                    window.location.href = "?act=listproduct";
                    alert("Bạn đã thêm sản phẩm thành công");
                    </script>';
               } else {
                    echo "ADD PRODUCT KHÔNG THÀNH CÔNG";
               }
          }
     }
     function delete($id)
     {
          if ($this->productModel->delete($id)) {
               header("location:?act=listproduct");
          } else {
               echo "Lỗi";
          }
     }
     // function update($id)
     // {
     //      $Product = $this->productModel->print($id);
     //      require_once './views/products/updateProduct.php';

     //      if (isset($_POST['btn_update'])) {
     //           $id = $_POST['id'];
     //           $name = $_POST['name'];
     //           $author_id = $_POST['author_id'];
     //           $category_id = $_POST['category_id'];
     //           $publishing_house_id = $_POST['publishing_house_id'];

     
     function comment()  {
          $allCmt = $this->productModel->allCmt();
          require_once './views/comment.php';
          if (isset($_GET['id']))
          {
              
         if ($this->productModel->deleteCmtModel($_GET['id'])) {
          echo '<script type="text/javascript">
          window.location.href = "?act=comment";
          alert("Bạn đã xóa thành công");
          </script>';
      } else {
          echo "Lỗi";
      }
          }
     }
   
     function login(){
          if(isset($_POST['btn_submit'])){;
              $user = $this->productModel->checkUser($_POST['email'],$_POST['password']);
              if($user){
                  $_SESSION['name'] = $user['name'] ;
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
      function home(){
          require "views/home.php";
      }
      function logout(){
          session_unset();
          echo '<script type="text/javascript">
                     alert("Bạn đã đăng xuất");
                    window.location.href = "?act=/"; 
                  </script>';
      }
}
?>