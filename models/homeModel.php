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
        function getUserEmail($email)
        {
            $sql = "SELECT email FROM users WHERE email = :email";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                'email' => $email,
            ]);
            $user = $stmt->fetch();
            return $user ? $user : null;
        }
    function top8Product() {
        $sql = "SELECT products.*,authors.name as author 
            FROM products
            JOIN authors ON products.author_id = authors.id ORDER BY id DESC LIMIT 8";
       
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
    public function updateId($id) {
        // Câu lệnh SQL để cập nhật click_count
        $sql = "UPDATE products SET click_count = click_count + 1 WHERE id = :id";
        
        // Chuẩn bị và thực thi câu lệnh SQL
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);  // Liên kết ID sản phẩm
        
        // Thực thi câu lệnh
        $stmt->execute();
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
    
    
    
    
    
    
    function addComment($user_id,$product_id,$comment){
        $sql = "INSERT INTO `comments` (`user_id`, `product_id`, `content`, `created_at`) 
        VALUES ('$user_id', '$product_id', '$comment', NOW())";
         $this->conn->exec($sql);
        $comment = "";
    }
    function allCmt() {
        $sql = "SELECT * FROM `comments`";
        return $this->conn->query($sql)->fetchAll();
    }
    public function Cmt($id) {
        // Lấy bình luận theo product_id và sắp xếp theo thời gian tạo giảm dần
        $sql = "SELECT * FROM `comments` WHERE `product_id` = :id ORDER BY `created_at` DESC LIMIT 3";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function searchModel($key) {
        $sql = "SELECT * FROM `products` WHERE `name` LIKE :keyword";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':keyword', '%' . $key . '%', PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getVariantsByProductId($productId) {
        $sql = "SELECT * FROM book_variants WHERE book_id = :productId";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':productId', $productId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getUserByEmail($email) {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function savePasswordResetToken($userId, $token) {
        $sql = "UPDATE users SET reset_token = :token WHERE id = :userId";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':token', $token);
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();
    }
    public function getUserByToken($token) {
        $sql = "SELECT * FROM users WHERE reset_token = :token";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':token', $token);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function updatePassword($userId, $password) {
        $sql = "UPDATE users SET password = :password WHERE id = :userId";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();
    }
    public function deletePasswordResetToken($userId) {
        $sql = "UPDATE users SET reset_token = NULL WHERE id = :userId";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();
    }
    
    // homeModel.php
    public function getUserById($userId) {
        $sql = "SELECT id, name, email, phone, address, avatar FROM users WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); // Trả về thông tin người dùng
    }

    // homeModel.php
    public function updateUserProfile($userId, $name, $phone, $address) {
        $sql = "UPDATE users SET name = :name, phone = :phone, address = :address WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
        $stmt->bindParam(':address', $address, PDO::PARAM_STR);
        $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
        $stmt->execute();
    }

}
?>