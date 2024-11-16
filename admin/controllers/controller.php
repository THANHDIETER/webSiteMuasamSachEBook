<?php
    require_once 'models/model.php';
    class productController {
     public $productModel;
     function __construct() {
          $this->productModel = new productModel();
      }
     function listProduct() {
          $allProduct = $this->productModel->getAllProduct();
          require_once 'views/listProduct.php';
      }
      function update($id){
          $Product = $this->productModel->print($id);
          require_once 'views/update.php';
    
        if (isset($_POST['btn_update'])) {
          $id=$_POST['id'];
          $title= $_POST['title'];
          $author= $_POST['author'];
          $description = $_POST['description'];
          $genre_id = $_POST['genre_id'];
          $price = $_POST['price'];
          $stock_quantity= $_POST['stock_quantity'];
          $published_date= $_POST['published_date'];
            if (empty($_FILES['img']['name'])) {
                $img = "";
            } else {
               $img = $_FILES['img']['name'];
               $tmp = $_FILES['img']['tmp_name'];
               move_uploaded_file($tmp,'../assets/images/prod/books/'.$img);
            }
    
            if ($this->productModel->update($id, $title, $author, $description, $genre_id, $price, $stock_quantity, $published_date,$img)) {
               echo '<script type="text/javascript">
               window.location.href = "?act=listproduct";
               alert("Bạn đã Thêm thành công");
               </script>';
            } else {
                echo "Lỗi";
            }
        }
      }
     public function insert(){
          
          require_once 'views/insert.php';
          if(isset($_POST['btn_insert'])){
               $title= $_POST['title'];
               $author= $_POST['author'];
               $description = $_POST['description'];
               $genre_id = $_POST['genre_id'];
               $price = $_POST['price'];
               $stock_quantity= $_POST['stock_quantity'];
               $published_date= $_POST['published_date'];

               $img = $_FILES['img']['name'];
               $tmp = $_FILES['img']['tmp_name'];
               move_uploaded_file($tmp,'../assets/images/prod/books/'.$img);
               if($this->productModel->insert($title, $author, $description, $genre_id, $price, $stock_quantity, $published_date,$img)){
                 
                    echo '<script type="text/javascript">
                    window.location.href = "?act=listproduct";
                    alert("Bạn đã Thêm thành công");
                    </script>';
               }else{
                    echo "ADD PRODUCT KHONGO THANH CONG";
               }
          }
     }
     
     function login(){
          require_once 'views/dashboard.php';
          if(isset($_POST['btn_login'])){
               $user=$_POST['user'];
               $pass=$_POST['pass'];
               if($this->productModel->checkAcc($user,$pass)>0){
                   
                    echo '<script type="text/javascript">
                     window.location.href = "?act=listproduct";
                     alert("Bạn đã login thành công");
                     </script>';
               }else{
                    echo " <script>alert('dang nhap khong thanh cong!')</script>";
               }
          }
     }
     function cart(){
          $Product = $this->productModel->order();
          require_once 'views/cart.php';
     }
     function delete($id){  
          if($this->productModel->delete($id)){
              header("location:?act=listproduct");
          }else{
              echo "Lỗi";
          }
      }
    }
?>