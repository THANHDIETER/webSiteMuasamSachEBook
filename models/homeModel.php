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
            $sql="SELECT * FROM  products  WHERE category_id=$id";
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
        // Use a prepared statement to prevent SQL injection
        $sql = "SELECT products.*, categories.name AS category_name, publishing_houses.name AS publishing_house_name ,authors.name as author
                FROM products
                JOIN categories ON products.category_id = categories.id
                JOIN publishing_houses ON products.publishing_house_id = publishing_houses.id
                JOIN authors ON products.author_id = authors.id
                WHERE products.id = :id";
    
        $stmt = $this->conn->prepare($sql); // Prepare the query
        $stmt->bindParam(':id', $id, PDO::PARAM_INT); // Bind the parameter
        $stmt->execute(); // Execute the query
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch a single result as an associative array
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