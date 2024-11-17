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
    // function delete($id)
    // {
    //     $sql = "delete from danh_muc where id=$id";
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