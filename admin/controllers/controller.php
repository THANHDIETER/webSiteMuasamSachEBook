<?php
require_once 'models/model.php';
class productController
{
     public $productModel;
     function __construct()
     {
          $this->productModel = new productModel();
     }
     function listProduct()
     {
          $allProduct = $this->productModel->getAllProduct();
          require_once 'views/listProduct.php';
     }
     public function insert()
     {

          require_once 'views/addProduct.php';
          if (isset($_POST['btn_insert'])) {
               $ten = $_POST['ten'];
               $tac_gia = $_POST['tac_gia'];
               $danh_muc_id = $_POST['danh_muc_id'];
               $nha_xuat_ban_id = $_POST['nha_xuat_ban_id'];
               $gia = $_POST['gia'];
               $img = $_FILES['img']['name'];
               $tmp = $_FILES['img']['tmp_name'];
               move_uploaded_file($tmp, '../assets/images/prod/books/' . $img);
               if ($this->productModel->insert($ten, $tac_gia, $danh_muc_id, $nha_xuat_ban_id, gia: $gia, img: $img)) {

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
     function update($id)
     {
          $Product = $this->productModel->print($id);
          require_once 'views/updateProduct.php';

          if (isset($_POST['btn_update'])) {
               $id = $_POST['id'];
               $ten = $_POST['ten'];
               $tac_gia = $_POST['tac_gia'];
               $gia = $_POST['gia'];
               if (empty($_FILES['img']['name'])) {
                    $img = "";
               } else {
                    $img = $_FILES['img']['name'];
                    $tmp = $_FILES['img']['tmp_name'];
                    move_uploaded_file($tmp, '../assets/images/prod/books/' . $img);
               }

               if ($this->productModel->update($id, $ten, $tac_gia, gia: $gia, img: $img)) {
                    echo '<script type="text/javascript">
               window.location.href = "?act=listproduct";
               alert("Bạn đã cập nhật thành công");
               </script>';
               } else {
                    echo "Lỗi";
               }
          }
     }
}
?>