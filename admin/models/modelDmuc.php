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
        $sql = "delete from categories where id=$id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute();
    }
    public function print($id)
    {
        $sql = "SELECT * FROM categories WHERE id=$id";
        return $this->conn->query($sql)->fetch();
    }
    function updateDmuc($id, $name)
    {
        $sql = "UPDATE categories SET name='$name' WHERE id=$id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute();
    }



}
?>