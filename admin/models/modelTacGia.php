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
        $sql = "delete from authors where id=$id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute();
    }


}
?>