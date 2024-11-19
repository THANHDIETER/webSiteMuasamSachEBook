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
        $sql = "SELECT * FROM publisher  ";
        $sql .= " ORDER BY id desc";
        return $this->conn->query($sql);
    }
    public function insertNhaXuatBan($name)
    {
        $sql = "INSERT INTO publisher (name) VALUES (:name)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':name', $name);

        return $stmt->execute();
    }



}
?>