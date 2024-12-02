<?php

class VariantModel {
    public $conn;
 
     function __construct() {
         $this->conn = connectDB(); // Kết nối cơ sở dữ liệu
     }


    // Lấy danh sách tất cả sách
    public function getAllBooks() {
        $query = "SELECT id, name FROM products"; // Câu lệnh SQL để lấy danh sách sách
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Trả về danh sách sách
    }

    // Lấy toàn bộ biến thể sách
    public function getAllVariants() {
        $stmt = $this->conn->prepare("SELECT * FROM book_variants");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy biến thể theo ID
    public function getVariantById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM book_variants WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Tạo biến thể mới
    public function createVariant($data) {
        $stmt = $this->conn->prepare("INSERT INTO book_variants (book_id, format, language, edition, price, stock) 
                                      VALUES (:book_id, :format, :language, :edition, :price, :stock)");
        $stmt->execute($data);
    }
    public function getVariantsBySearch($search) {
     $sql = "SELECT * FROM book_variants WHERE format LIKE :search OR language LIKE :search OR edition LIKE :search";
     $stmt = $this->conn->prepare($sql);
     $stmt->execute(['search' => '%' . $search . '%']);
     return $stmt->fetchAll(PDO::FETCH_ASSOC);
 }
    // Cập nhật biến thể
    public function updateVariant($id, $data) {
        $stmt = $this->conn->prepare("UPDATE book_variants 
                                      SET book_id = :book_id, format = :format, language = :language, edition = :edition, price = :price, stock = :stock 
                                      WHERE id = :id");
        $data['id'] = $id;
        $stmt->execute($data);
    }

    // Xóa biến thể
    public function deleteVariant($id) {
        $stmt = $this->conn->prepare("DELETE FROM book_variants WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}
?>
