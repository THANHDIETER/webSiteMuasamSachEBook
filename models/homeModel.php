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

    function findProductById($id) {
        $sql = "SELECT * FROM products WHERE id =$id";
        return $this->conn->query($sql)->fetch();
    }
      function add_user($email,$name,$password){
        $sql= "INSERT INTO users (email, name, password) VALUES ('$email', '$name', '$password')";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute();
    }
    function checkUser($email,$password) {
        $sql = "SELECT * FROM users WHERE email = :email AND password = :password";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'email'=>$email,
            'password'=>$password
        ]);
        $user = $stmt->fetch();
        return $user ? $user : null;
    }
    
    function checkEmail($email)  {
        $sql = "SELECT * FROM users WHERE email = :email ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email'=> $email]);
        return $stmt->fetch();
    }














}
?>
