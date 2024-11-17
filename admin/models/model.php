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
        $sql = "SELECT DISTINCT products.id, products.ten, products.img, products.gia,products.tac_gia, products.danh_muc_id,  products.mo_ta, danh_muc.name AS danh_muc_name, nha_san_xua.name AS nha_san_xua_name 
        FROM products 
        JOIN danh_muc ON danh_muc.id = products.danh_muc_id 
        JOIN nha_san_xua ON nha_san_xua.id = products.nha_san_xuat_id WHERE 1";
        $sql .= " ORDER BY products.id DESC";
        return $this->conn->query($sql);
    }
    public function insert($ten, $tac_gia, $danh_muc_id, $nha_xuat_ban_id, $gia, $img)
    {
        $sql = "INSERT INTO products VALUE (null,'$ten', '$tac_gia','$danh_muc_id', '$nha_xuat_ban_id', '$gia','$img')";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute();
    }


}
?>