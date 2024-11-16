<?php
    class homeModel {
        public $conn;
        function __construct() {
            $this->conn = connectDB();
        }
        
    function allProduct() {
        try {
            $sql = "SELECT * FROM `products`";
            return $this->conn->query($sql)->fetchAll();
           
        } catch (Exception $err) {
            echo "<h1>";
            echo "Lỗi hàm all trong model: " . $err->getMessage();
            echo "</h1>";
        }
    }
    function danhMuc() {
        try {
            $sql = "SELECT * FROM `danh_muc`";
            return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        } catch ( Exception $err) {
            echo "<h1>";
            echo "Lỗi hàm all trong model: " . $err->getMessage();
            echo "</h1>";
        }
    }
    function tac_gia() {
        try {
            $sql = "SELECT * FROM `tac_gia`";
            return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        } catch ( Exception $err) {
            echo "<h1>";
            echo "Lỗi hàm all trong model: " . $err->getMessage();
            echo "</h1>";
        }
    }

    // function top6Product() {
    //     $sql = "SELECT * FROM product ORDER BY pro_id DESC LIMIT 6";
    //     return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    // }

    // function findProductById($id) {
    //     $sql = "SELECT * FROM product WHERE pro_id =$id";
    //     return $this->conn->query($sql)->fetch();
    // }
    }
?>