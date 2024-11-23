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
     //           $price = $_POST['price'];
     //           if (empty($_FILES['img']['name'])) {
     //                $img = "";
     //           } else {
     //                $img = $_FILES['img']['name'];
     //                $tmp = $_FILES['img']['tmp_name'];
     //                move_uploaded_file($tmp, '../assets/images/prod/books/' . $img);
     //           }

     //           if ($this->productModel->update($id, $name, $author_id, $category_id, $publishing_house_id, $price, $img)) {
     //                echo '<script type="text/javascript">
     //           window.location.href = "?act=listproduct";
     //           alert("Bạn đã cập nhật thành công");
     //           </script>';
     //           } else {
     //                echo "Lỗi";
     //           }
     //      }
     // }
}
?>