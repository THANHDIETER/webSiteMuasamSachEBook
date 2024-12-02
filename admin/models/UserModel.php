<?php

class UserModel {
     public $conn;
 
     function __construct() {
         $this->conn = connectDB(); // Kết nối cơ sở dữ liệu
     }
 
     // Lấy tất cả người dùng
     public function getAllUsers() {
         $query = "SELECT * FROM users";
         $stmt = $this->conn->prepare($query);
         $stmt->execute();
         return $stmt->fetchAll(PDO::FETCH_ASSOC);
     }
 
     // Lấy người dùng theo ID
     public function getUserById($user_id) {
         $query = "SELECT * FROM users WHERE id = :user_id";
         $stmt = $this->conn->prepare($query);
         $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
         $stmt->execute();
         return $stmt->fetch(PDO::FETCH_ASSOC);
     }
 
     // Xóa người dùng
     public function deleteUser($user_id) {
         $query = "DELETE FROM users WHERE id = :user_id";
         $stmt = $this->conn->prepare($query);
         $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
         $stmt->execute();
     }
     // Cập nhật thông tin người dùng
     public function updateUser($user_id, $name, $email, $phone, $address, $is_admin) {
         $query = "UPDATE users SET name = :name, email = :email, phone = :phone, 
                   address = :address, is_admin = :is_admin WHERE id = :user_id";
         $stmt = $this->conn->prepare($query);
         $stmt->bindParam(':name', $name);
         $stmt->bindParam(':email', $email);
         $stmt->bindParam(':phone', $phone);
         $stmt->bindParam(':address', $address);
         $stmt->bindParam(':is_admin', $is_admin, PDO::PARAM_INT);
         $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
         $stmt->execute();
     }
 
     // Thêm người dùng mới
     public function addUser($name, $email, $password, $phone = NULL, $address = NULL, $is_admin = 0) {
         $query = "INSERT INTO users (name, email, password, phone, address, is_admin) 
                   VALUES (:name, :email, :password, :phone, :address, :is_admin)";
         
         $stmt = $this->conn->prepare($query);
 
         // Bind các tham số vào câu lệnh
         $stmt->bindParam(':name', $name);
         $stmt->bindParam(':email', $email);
         $stmt->bindParam(':password', $password);
         $stmt->bindParam(':phone', $phone);
         $stmt->bindParam(':address', $address);
         $stmt->bindParam(':is_admin', $is_admin, PDO::PARAM_INT);
 
         // Kiểm tra nếu câu lệnh thực thi thành công
         if (!$stmt->execute()) {
             die('Lỗi thực thi câu lệnh: ' . $stmt->errorInfo()[2]);
         }
     }
 }
 ?>
