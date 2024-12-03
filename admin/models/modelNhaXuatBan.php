
<?php
class nhaXuatBanModel
{
    public $conn;

    function __construct()
    {
        $this->conn = connectDB();
    }
    function getAllNhaXuatBan()
    {
        $sql = "SELECT * FROM publishing_houses  ";
        $sql .= " ORDER BY id desc";
        return $this->conn->query($sql);
    }
    public function insertNhaXuatBan($name)
    {
        $sql = "INSERT INTO publishing_houses (name) VALUES (:name)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':name', $name);

        return $stmt->execute();
    }
    function deleteNhaXuatBan($id)
    {
        try {
            $sql = "DELETE FROM publishing_houses WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) { // Lỗi ràng buộc khóa ngoại
                throw new Exception("Không thể xóa nhà xuất bản vì có dữ liệu liên quan.");
            }
            throw new Exception("Lỗi khi xóa nhà xuất bản: " . $e->getMessage());
        }
    }


    public function print($id)
    {
        try {
            $sql = "SELECT * FROM publishing_houses WHERE id = :id";
            $stmt = $this->conn->prepare($sql); // Chuẩn bị câu lệnh
            $stmt->execute([':id' => $id]);     // Thực thi với giá trị ràng buộc
            return $stmt->fetch();             // Lấy một dòng dữ liệu
        } catch (PDOException $e) {
            echo "Lỗi khi truy vấn nhà xuất bản: " . $e->getMessage();
            return false; // Trả về false nếu xảy ra lỗi
        }
    }

    public function updateNhaXuatBan($id, $name)
    {
        try {
            $sql = "UPDATE publishing_houses SET name = :name WHERE id = :id";
            $stmt = $this->conn->prepare($sql); // Chuẩn bị câu lệnh
            $stmt->execute([
                ':id' => $id,
                ':name' => $name
            ]); // Thực thi với giá trị ràng buộc
            return true; // Trả về true nếu cập nhật thành công
        } catch (PDOException $e) {
            echo "Lỗi khi cập nhật nhà xuất bản: " . $e->getMessage();
            return false; // Trả về false nếu xảy ra lỗi
        }
    }




}
?>
