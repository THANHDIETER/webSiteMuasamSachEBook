<?php
class danhmucModel
{
    public $conn;

    function __construct()
    {
        $this->conn = connectDB();
    }
    function getAllDanhmuc()
    {
        $sql = "SELECT * FROM categories";
        $sql .= " ORDER BY id desc";
        return $this->conn->query($sql);
    }

    public function insertDanhMuc($name)
    {
        $sql = "INSERT INTO categories (name) VALUES (:name)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':name', $name);

        return $stmt->execute();
    }
    function deleteDmuc($id)
    {
        try {
            $sql = "DELETE FROM categories WHERE id = :id";
            $stmt = $this->conn->prepare($sql); // Chuẩn bị câu lệnh SQL
            $stmt->execute([':id' => $id]);     // Thực thi với giá trị an toàn
            return true; // Trả về true nếu xóa thành công
        } catch (PDOException $e) {
            echo "Lỗi khi xóa danh mục: " . $e->getMessage();
            return false; // Trả về false nếu xảy ra lỗi
        }
    }

    public function print($id)
    {
        try {
            $sql = "SELECT * FROM categories WHERE id = :id";
            $stmt = $this->conn->prepare($sql); // Chuẩn bị câu lệnh
            $stmt->execute([':id' => $id]);     // Thực thi với giá trị được ràng buộc
            return $stmt->fetch();             // Lấy một dòng dữ liệu
        } catch (PDOException $e) {
            echo "Lỗi: " . $e->getMessage();
            return false; // Trả về false nếu xảy ra lỗi
        }
    }
    function updateDmuc($id, $name)
    {
        try {
            // Câu lệnh SQL với placeholders cho các tham số
            $sql = "UPDATE categories SET name = :name WHERE id = :id";

            // Chuẩn bị câu lệnh SQL
            $stmt = $this->conn->prepare($sql);

            // Thực thi câu lệnh với các tham số an toàn
            $stmt->execute([
                ':name' => $name,
                ':id' => $id
            ]);

            return true; // Trả về true nếu cập nhật thành công
        } catch (PDOException $e) {
            echo "Lỗi khi cập nhật danh mục: " . $e->getMessage();
            return false; // Trả về false nếu có lỗi
        }
    }



}
?>