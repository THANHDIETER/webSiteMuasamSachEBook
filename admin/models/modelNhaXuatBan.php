
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
        $sql = "SELECT * FROM publishing_houses WHERE id=$id";
        return $this->conn->query($sql)->fetch();
    }
    function updateNhaXuatBan($id, $name)
    {
        $sql = "UPDATE publishing_houses SET name='$name' WHERE id=$id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute();
    }




}
?>
