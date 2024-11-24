<?php
class quanlyModel
{
    public $conn;

    function __construct()
    {
        $this->conn = connectDB();
    }
    function getAllQuanLy()
    {
        $sql = "SELECT * FROM users ";
        $sql .= " ORDER BY id desc";
        return $this->conn->query($sql);
    }
    // public function insertTacGia($name)
    // {
    //     $sql = "INSERT INTO authors (name) VALUES (:name)";
    //     $stmt = $this->conn->prepare($sql);
    //     $stmt->bindParam(':name', $name);

    //     return $stmt->execute();
    // }
    // function deleteTacGia($id)
    // {
    //     $sql = "delete from authors where id=$id";
    //     $stmt = $this->conn->prepare($sql);
    //     return $stmt->execute();
    // }

    // public function print($id)
    // {
    //     $sql = "SELECT * FROM authors WHERE id=$id";
    //     return $this->conn->query($sql)->fetch();
    // }

    // function updateTacGia($id, $name)
    // {
    //     $sql = "UPDATE authors SET name='$name' WHERE id=$id";
    //     $stmt = $this->conn->prepare($sql);
    //     return $stmt->execute();
    // }


}
?>