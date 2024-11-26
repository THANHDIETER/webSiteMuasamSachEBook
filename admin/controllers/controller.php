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
          // Lấy dữ liệu danh mục, nhà xuất bản, tác giả từ Model
          $listDanhMuc = $this->danhmucModel->getAllDanhmuc();
          $listNhaXuatBan = $this->nhaXuatBanModel->getAllNhaXuatBan();
          $listTacGia = $this->tacGiaModel->getAllTacgia();

          // Hiển thị form thêm sản phẩm
          require_once './views/products/addProduct.php';

          // Xử lý form khi được submit
          if (isset($_POST['btn_insert'])) {
               // Lấy dữ liệu từ form
               $name = trim($_POST['name']);
               $category_id = (int) $_POST['category_id'];
               $publishing_house_id = (int) $_POST['publishing_house_id'];
               $author_id = (int) $_POST['author_id'];
               $price = (float) $_POST['price'];
               $quantity = (int) $_POST['quantity'];
               $description = trim($_POST['description']);

               // Xử lý ảnh
               $img = $_FILES['img']['name'];
               $tmp = $_FILES['img']['tmp_name'];

               if (!empty($img)) {
                    $targetDir = '../assets/images/prod/books/';
                    $targetFile = $targetDir . basename($img);

                    // Tạo thư mục nếu chưa tồn tại
                    if (!file_exists($targetDir)) {
                         mkdir($targetDir, 0777, true);
                    }

                    // Di chuyển file upload
                    if (move_uploaded_file($tmp, $targetFile)) {
                         // Đường dẫn ảnh hợp lệ
                    } else {
                         $img = null; // Trường hợp upload thất bại
                    }
               } else {
                    $img = null; // Không có ảnh được upload
               }

               // Gọi Model để thêm sản phẩm
               // Khi gọi model insert, thêm giá trị count_sale
               $result = $this->productModel->insert(
                    $name,
                    $category_id,
                    $publishing_house_id,
                    $author_id,
                    $img,
                    $price,
                    $description,
                    $quantity,
                    0 // Giá trị mặc định của count_sale
               );


               // Kiểm tra kết quả
               if ($result) {
                    echo '<script type="text/javascript">
                alert("Thêm sản phẩm thành công");
                window.location.href = "?act=listproduct";
                </script>';
               } else {
                    echo '<script type="text/javascript">
                alert("Thêm sản phẩm thất bại. Vui lòng thử lại!");
                </script>';
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
          // Lấy thông tin sản phẩm theo ID
          $Product = $this->productModel->print($id);

          // Lấy danh sách danh mục, nhà xuất bản và tác giả
          $listDanhMuc = $this->danhmucModel->getAllDanhmuc();
          $listNhaXuatBan = $this->nhaXuatBanModel->getAllNhaXuatBan();
          $listTacGia = $this->tacGiaModel->getAllTacgia();

          // Kiểm tra nếu dữ liệu được gửi qua POST
          if (isset($_POST['btn_update'])) {
               $name = $_POST['name'];
               $category_id = $_POST['category_id'];
               $publishing_house_id = $_POST['publishing_house_id'];
               $author_id = $_POST['author_id'];
               $price = $_POST['price'];

               // Xử lý upload ảnh nếu có
               if (empty($_FILES['img']['name'])) {
                    $img = $Product['img']; // Sử dụng ảnh cũ nếu không có ảnh mới
               } else {
                    $img = $_FILES['img']['name'];
                    $tmp = $_FILES['img']['tmp_name'];
                    move_uploaded_file($tmp, '../assets/images/prod/books/' . $img);
               }

               // Cập nhật sản phẩm
               $updated = $this->productModel->update($id, $name, $category_id, $publishing_house_id, $author_id, $img, $price);

               if ($updated) {
                    echo '<script>
                    alert("Cập nhật sản phẩm thành công!");
                    window.location.href = "?act=listproduct";
                  </script>';
               } else {
                    echo '<script>alert("Cập nhật thất bại!");</script>';
               }
          }

          // Load view và truyền dữ liệu
          require_once './views/products/updateProduct.php';
     }

}
?>