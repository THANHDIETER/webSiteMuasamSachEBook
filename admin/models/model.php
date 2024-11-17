<?php
class productModel
{
    public $conn;

    function __construct()
    {
        $this->conn = connectDB();
    }
    function getAllProduct()
    {
        $sql = "SELECT * FROM products ORDER BY id DESC";
        return $this->conn->query($sql);
    }

}
?>