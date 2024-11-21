<?php
    class cartModel {
        public $conn;
        function __construct() {
            $this->conn = connectDB();
        }
        
            public function getProductById($id) {
                $sql = "SELECT * FROM products WHERE id = :id";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->fetch(PDO::FETCH_ASSOC);
            }
        }
        
        ?>
        