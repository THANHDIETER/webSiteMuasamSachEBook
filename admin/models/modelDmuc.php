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
    // public function insert($ten, $tac_gia, $danh_muc_id, $nha_xuat_ban_id, $gia, $img)
    // {
    //     $sql = "INSERT INTO products VALUE (null,'$ten', '$tac_gia','$danh_muc_id', '$nha_xuat_ban_id', '$gia','$img')";
    //     $stmt = $this->conn->prepare($sql);
    //     return $stmt->execute();
    // }
    // function delete($id)
    // {
    //     $sql = "delete from products where id=$id";
    //     $stmt = $this->conn->prepare($sql);
    //     return $stmt->execute();
    // }
    // public function print($id)
    // {
    //     $sql = "SELECT * FROM products WHERE id=$id";
    //     return $this->conn->query($sql)->fetch();
    // }
    // function update($id, $ten, $tac_gia, $gia, $img)
    // {
    //     if (empty($img)) {
    //         $sql = "UPDATE products SET ten='$ten', tac_gia='$tac_gia', gia=$gia' WHERE id=$id";
    //     } else {
    //         $sql = "UPDATE products SET ten='$ten' , tac_gia='$tac_gia', gia=$gia' ,  img ='$img' WHERE id=$id";
    //     }

    //     $stmt = $this->conn->prepare($sql);
    //     return $stmt->execute();
    // }



}
?>