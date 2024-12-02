<?php
    require_once 'models/VariantModel.php';
    
    class VariantController {
        private $variantModel;

    
        public function __construct() {
            $this->variantModel = new VariantModel();
            $this->variantModel = new VariantModel(); // Khởi tạo BookModel
        }
        public function listVariants() {
          // Kiểm tra nếu có tìm kiếm
          $search = $_GET['search'] ?? ''; 
          if ($search) {
              // Nếu có tìm kiếm, lấy danh sách biến thể theo từ khóa
              $variants = $this->variantModel->getVariantsBySearch($search);
          } else {
              // Nếu không có tìm kiếm, lấy tất cả biến thể
              $variants = $this->variantModel->getAllVariants();
          }
      
          // Lấy danh sách sách để chọn khi tạo biến thể mới
          $books = $this->variantModel->getAllBooks(); 
      
          // Gửi dữ liệu đến view
          require 'views/variant/listVariant.php';
      }
      
        // Hiển thị trang thêm mới biến thể
        public function newVariant() {
            $books = $this->variantModel->getAllBooks(); // Lấy danh sách sách
            require 'views/variant/newVariant.php'; // Truyền danh sách sách vào view
        }
    
        // Tạo biến thể mới
        public function createVariant() {
            $data = [
                'book_id' => $_POST['book_id'],
                'format' => $_POST['format'],
                'language' => $_POST['language'],
                'edition' => $_POST['edition'],
                'price' => $_POST['price'],
                'stock' => $_POST['stock']
            ];
            $this->variantModel->createVariant($data);
            header('Location: ?act=listVariants');
        }
    
        // Hiển thị trang chỉnh sửa biến thể
        public function editVariant() {
            $id = $_GET['variant_id'];
            $variant = $this->variantModel->getVariantById($id);
            $books = $this->variantModel->getAllBooks(); // Lấy danh sách sách
            require 'views/variant/editVariant.php'; // Truyền dữ liệu sách vào view
        }
    
        // Cập nhật biến thể
        public function updateVariant() {
            $id = $_POST['variant_id'];
            $data = [
                'book_id' => $_POST['book_id'],
                'format' => $_POST['format'],
                'language' => $_POST['language'],
                'edition' => $_POST['edition'],
                'price' => $_POST['price'],
                'stock' => $_POST['stock']
            ];
            $this->variantModel->updateVariant($id, $data);
            header('Location: ?act=listVariants');
        }
    
        // Xóa biến thể
        public function deleteVariant() {
            $id = $_GET['variant_id'];
            $this->variantModel->deleteVariant($id);
            header('Location: ?act=listVariants');
        }
    }
    
?>