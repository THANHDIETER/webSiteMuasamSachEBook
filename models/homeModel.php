<?php
    class homeModel {
        public $conn;
        function __construct() {
            $this->conn = connectDB();
        }


      
        
    function allProduct() {
            $sql = "SELECT products.*,authors.name as author 
            FROM products
            JOIN authors ON products.author_id = authors.id
             ORDER BY id DESC";
            return $this->conn->query($sql)->fetchAll();
        }
        function dmshowid($id){
            $sql = "SELECT products.*,authors.name as author 
            FROM products
            JOIN authors ON products.author_id = authors.id WHERE category_id=$id";
            return $this->conn->query($sql)->fetchAll();
        }   
        
        function alldanhmuc() {
       
            $sql = "SELECT * FROM categories ORDER BY id ";
            return $this->conn->query($sql)->fetchAll();
        }
        
    function cart(){
        
    }
    function top4Product() {
        $sql = "SELECT products.*,authors.name as author 
            FROM products
            JOIN authors ON products.author_id = authors.id ORDER BY id DESC LIMIT 8";
       
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
    function top5Product() {
        $sql = "SELECT products.*,authors.name as author 
            FROM products
            JOIN authors ON products.author_id = authors.id ORDER BY id ASC LIMIT 5";
       
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
    function to3Product(){
        $sql = "SELECT * FROM products ORDER BY click_count DESC LIMIT 3"; // Lọc sản phẩm theo click_count giảm dần và giới hạn kết quả là 3
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
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
    function addComment($user_id,$product_id,$comment){
        $sql = "INSERT INTO `comments` (`user_id`, `product_id`, `content`, `created_at`) 
        VALUES ('$user_id', '$product_id', '$comment', NOW())";
         $this->conn->exec($sql);
        $comment = "";
    }
    function allCmt() {
        $sql = "SELECT 
                comments.id AS comment_id, 
                comments.user_id, 
                comments.product_id, 
                comments.content, 
                comments.created_at, 
                users.name, 
                users.avatar 
            FROM comments JOIN  users ON comments.user_id = users.id ORDER BY comments.created_at DESC";
     return $this->conn->query($sql)->fetchAll();
    }
    function Cmt(){
            $sql = "SELECT comments.id AS comment_id, comments.user_id, comments.product_id, comments.content, comments.created_at, users.name, users.avatar FROM comments JOIN users ON comments.user_id = users.id ORDER BY comments.created_at DESC LIMIT 2";
            return $this->conn->query($sql)->fetchAll();
    }
    public function searchModel($key) {
        $sql = "SELECT * FROM `products` WHERE `name` LIKE :keyword";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':keyword', '%' . $key . '%', PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function updateId($id) {
        // SQL để tăng số lượt click
        $sql = "UPDATE products SET click_count = click_count + 1 WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);  // Liên kết ID sản phẩm
        $stmt->execute();
    }



}
?>