<?php
class danhmucModel
{
    public $conn;

    function __construct()
    {
        $this->conn = connectDB();
    }
    function getAllDmuc()
    {
        $sql = "SELECT * FROM danh_muc WHERE 1 ";
        $sql .= " ORDER BY id desc";
        return $this->conn->query($sql);
    }
    public function addDmuc($name)
    {
        $sql = "INSERT INTO danh_muc VALUE (null,'$name')";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute();
    }
    function deleteDmuc($id)
    {
        $sql = "delete from danh_muc where id=$id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute();
    }
    public function print($id)
    {
        $sql = "SELECT * FROM danh_muc WHERE id=$id";
        return $this->conn->query($sql)->fetch();
    }
    function updateDmuc($id, $name)
    {
        $sql = "UPDATE danh_muc SET name='$name' WHERE id=$id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute();
    }



}
?>