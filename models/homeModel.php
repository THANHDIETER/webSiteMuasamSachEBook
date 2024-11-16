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
       
            $sql = "SELECT * FROM danh_muc ORDER BY id DESC";
            return $this->conn->query($sql)->fetchAll();
        }
        
    
    function top6Product() {
        $sql = "SELECT * FROM products ORDER BY id DESC LIMIT 6";
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    function findProductById($id) {
        $sql = "SELECT * FROM products WHERE id =$id";
        return $this->conn->query($sql)->fetch();
    }
    }
?>