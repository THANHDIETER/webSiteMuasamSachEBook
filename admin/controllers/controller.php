<?php
require_once 'models/model.php';
class productController{
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

public function dashboard(){
    $orderCount = $this->productModel->getOrderCount();
    $orderCountNow = $this->productModel->getOrderCountNow();
    $orderCountDelete = $this->productModel->getOrderCountDelete();
    $productCount = $this->productModel->getProductCount();
    $userCount = $this->productModel->getUserCount();
    $revenue = $this->productModel->getTotalRevenue();
    require_once './views/dashboard.php';
}
public function insert()
{
    $listDanhMuc = $this->danhmucModel->getAllDanhmuc();
    $listNhaXuatBan = $this->nhaXuatBanModel->getAllNhaXuatBan();
    $listTacGia = $this->tacGiaModel->getAllTacgia();

    require_once './views/products/addProduct.php';

    if (isset($_POST['btn_insert'])) {
        $name = trim($_POST['name']);
        $category_id = $_POST['category_id'];
        $publishing_house_id = $_POST['publishing_house_id'];
        $author_id = $_POST['author_id'];
        $img = $_FILES['img']['name'];
        $tmp = $_FILES['img']['tmp_name'];
        $price = $_POST['price'];
        $sale = $_POST['sale'];
        $description = trim($_POST['description']);
        $quantity = $_POST['quantity'];

        // Kiểm tra dữ liệu
        if (empty($name) || empty($category_id) || empty($publishing_house_id) || empty($author_id) || empty($price) || empty($quantity) || empty($img)) {
            echo '<script>alert("Vui lòng nhập đầy đủ thông tin sản phẩm.");</script>';
            return;
        }

        if (!is_numeric($price) || $price <= 0) {
            echo '<script>alert("Giá sản phẩm phải là số dương.");</script>';
            return;
        }

        if (!is_numeric($sale) || $sale < 0 || $sale > 100) {
            echo '<script>alert("Giảm giá phải nằm trong khoảng 0–100.");</script>';
            return;
        }

        if (!is_numeric($quantity) || $quantity <= 0) {
            echo '<script>alert("Số lượng phải là số nguyên dương.");</script>';
            return;
        }

        // Kiểm tra và tạo thư mục lưu ảnh
        $imgDir = '../assets/images/prod/books/';
        if (!is_dir($imgDir)) {
            mkdir($imgDir, 0777, true);
        }

        // Xử lý upload ảnh
        if (!move_uploaded_file($tmp, $imgDir . $img)) {
            echo '<script>alert("Lỗi khi tải lên ảnh. Vui lòng thử lại.");</script>';
            return;
        }

        // Gọi hàm insert từ model
        if ($this->productModel->insert($name, $category_id, $publishing_house_id, $author_id, $img, $price, $sale, $description, $quantity)) {
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script>
                Swal.fire({
                    title: 'Thành công!',
                    text: 'Bạn đã thêm sản phẩm thành công.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.href = '?act=listproduct';
                });
            </script>";
        } else {
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script>
                Swal.fire({
                    title: 'Thất bại!',
                    text: 'Không thể thêm sản phẩm. Vui lòng thử lại.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            </script>";
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
     public function update(){
    // Lấy danh sách danh mục, nhà xuất bản, và tác giả (dùng cho form)
    $listDanhMuc = $this->danhmucModel->getAllDanhmuc();
    $listNhaXuatBan = $this->nhaXuatBanModel->getAllNhaXuatBan();
    $listTacGia = $this->tacGiaModel->getAllTacgia();

    // Lấy thông tin sản phẩm hiện tại theo ID
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $Product = $this->productModel->getProductById($id);
    }

    // Hiển thị form cập nhật
    require_once './views/products/updateProduct.php';

    // Xử lý khi người dùng bấm nút "Cập nhật"
    if (isset($_POST['btn_update'])) {
        $name = trim($_POST['name']);
        $category_id = $_POST['category_id'];
        $publishing_house_id = $_POST['publishing_house_id'];
        $author_id = $_POST['author_id'];
        $price = $_POST['price'];
        $sale = $_POST['sale'];
        $description = trim($_POST['description']);
        $quantity = $_POST['quantity'];

        // Kiểm tra xem có ảnh mới được tải lên không
        if (!empty($_FILES['img']['name'])) {
            $img = $_FILES['img']['name'];
            $tmp = $_FILES['img']['tmp_name'];

            // Kiểm tra và tạo thư mục lưu ảnh nếu chưa tồn tại
            $imgDir = '../assets/images/prod/books/';
            if (!is_dir($imgDir)) {
                mkdir($imgDir, 0777, true);
            }

            // Xử lý upload ảnh
            if (!move_uploaded_file($tmp, $imgDir . $img)) {
                echo "<script>alert('Lỗi khi tải lên ảnh mới. Vui lòng thử lại.');</script>";
                return;
            }
        } else {
            // Nếu không có ảnh mới, giữ nguyên ảnh cũ
            $img = $Product['img'];
        }

        // Kiểm tra dữ liệu nhập vào
        if (empty($name) || empty($category_id) || empty($publishing_house_id) || empty($author_id) || empty($price) || empty($quantity)) {
            echo "<script>alert('Vui lòng nhập đầy đủ thông tin sản phẩm.');</script>";
            return;
        }

        if (!is_numeric($price) || $price <= 0) {
            echo "<script>alert('Giá sản phẩm phải là số dương.');</script>";
            return;
        }

        if (!is_numeric($sale) || $sale < 0 || $sale > 100) {
            echo "<script>alert('Giảm giá phải nằm trong khoảng 0–100.');</script>";
            return;
        }

        if (!is_numeric($quantity) || $quantity <= 0) {
            echo "<script>alert('Số lượng phải là số nguyên dương.');</script>";
            return;
        }

        // Gọi hàm cập nhật từ model
        if ($this->productModel->update($id, $name, $category_id, $publishing_house_id, $author_id, $img, $price, $sale, $description, $quantity)) {
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script>
                Swal.fire({
                    title: 'Thành công!',
                    text: 'Sản phẩm đã được cập nhật thành công.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.href = '?act=listproduct';
                });
            </script>";
        } else {
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script>
                Swal.fire({
                    title: 'Thất bại!',
                    text: 'Không thể cập nhật sản phẩm. Vui lòng thử lại.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            </script>";
        }
    }
}

     function comment()  {
          $allCmt = $this->productModel->allCmt();
          require_once './views/comment.php';
          if (isset($_GET['id'])){
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
   
    //  function login()
    //  {
    //      if (isset($_SESSION['name'])) {
    //          header('Location: ' . BASE_URL);
    //          exit;
    //      }
    //      if (isset($_POST['btn_submit'])) {
    //          ;
    //          $user = $this->productModel->checkUser($_POST['email'], $_POST['password']);
    //          if ($user) {
    //              $_SESSION['id'] = $user['id'];
    //              $_SESSION['name'] = $user['name'];
    //              $_SESSION['is_admin'] = $user['is_admin'];
    //              if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1) {
    //                  header('Location: ' . BASE_URL . '/admin/index.php?act=dashboard');
    //                  exit;
    //              } else {
    //                  header('Location: ' . BASE_URL);
    //                  exit;
    //              }
    //          } else {
    //              echo "<script>alert('Đăng nhập thất bại');</script>";
    //          }
    //      }
    //      require "views/login.php";
    //  }
     
     function logout()
     {
         session_unset();
         echo '<script type="text/javascript">
                      alert("Bạn đã đăng xuất");
                     window.location.href = "?act=/";
                   </script>';
     }
 }
?>


