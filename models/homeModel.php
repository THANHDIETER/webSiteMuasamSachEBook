<?php
    class homeModel {
        public $conn;
        function __construct() {
            $this->conn = connectDB();
        }
        
 function allProduct() {
            $sql = "SELECT * FROM products ORDER BY id DESC";
            return $this->conn->query($sql)->fetchAll();
        }
        function dmshowid($id){
            $sql="SELECT * FROM  products  WHERE danh_muc_id=$id";
            return $this->conn->query($sql)->fetchAll();
        }   
        
        function alldanhmuc() {
            $sql = "SELECT * FROM categories ORDER BY id DESC";
            return $this->conn->query($sql)->fetchAll();
        }
        
    
    function top8Product() {
        $sql = "SELECT * FROM products ORDER BY id DESC LIMIT 8";
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
    function top6Product() {
        $sql = "SELECT * FROM products ORDER BY id DESC LIMIT 6";
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    function findProductById($id) {
        $sql = "SELECT * FROM products 
                JOIN danh_muc ON products.danh_muc_id = danh_muc.dm_id 
                JOIN nha_san_xua on products.nha_san_xuat_id = nha_san_xua.nxb_id
                WHERE id = $id";
        return $this->conn->query($sql)->fetchAll();
    }
    function add_user($email,$name,$password){
        $sql= "INSERT INTO users (email, name, password) VALUES ('$email', '$name', '$password')";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute();
    }
    }
?>