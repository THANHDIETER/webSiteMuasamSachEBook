<?php
class tacgiaModel
{
    public $conn;

    function __construct()
    {
        $this->conn = connectDB();
    }
    function getAllTacgia()
    {
        $sql = "SELECT * FROM authors  ";
        $sql .= " ORDER BY id desc";
        return $this->conn->query($sql);
    }
    public function insertTacGia($name)
    {
        $sql = "INSERT INTO authors (name) VALUES (:name)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':name', $name);

        return $stmt->execute();
    }
    function deleteTacGia($id)
    {
        try {
            // Sử dụng Prepared Statement để tránh SQL Injection
            $sql = "DELETE FROM authors WHERE id = :id";
            $stmt = $this->conn->prepare($sql);

            // Thực thi câu lệnh với giá trị tham số an toàn
            $stmt->execute([':id' => $id]);

            return true; // Trả về true nếu xóa thành công
        } catch (PDOException $e) {
            echo "Lỗi khi xóa tác giả: " . $e->getMessage();
            return false; // Trả về false nếu có lỗi
        }
    }

    public function print($id)
    {
        try {
            // Sử dụng Prepared Statement để tránh SQL Injection
            $sql = "SELECT * FROM authors WHERE id = :id";
            $stmt = $this->conn->prepare($sql);

            // Thực thi câu lệnh với giá trị tham số an toàn
            $stmt->execute([':id' => $id]);

            return $stmt->fetch(); // Trả về kết quả nếu tìm thấy tác giả
        } catch (PDOException $e) {
            echo "Lỗi khi lấy thông tin tác giả: " . $e->getMessage();
            return false; // Trả về false nếu có lỗi
        }
    }

    function updateTacGia($id, $name)
    {
        try {
            // Sử dụng Prepared Statement để tránh SQL Injection
            $sql = "UPDATE authors SET name = :name WHERE id = :id";
            $stmt = $this->conn->prepare($sql);

            // Thực thi câu lệnh với các tham số an toàn
            $stmt->execute([
                ':id' => $id,
                ':name' => $name
            ]);

            return true; // Trả về true nếu cập nhật thành công
        } catch (PDOException $e) {
            echo "Lỗi khi cập nhật tác giả: " . $e->getMessage();
            return false; // Trả về false nếu có lỗi
        }
    }


}
?>