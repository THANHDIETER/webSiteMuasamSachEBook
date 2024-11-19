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



}
?>