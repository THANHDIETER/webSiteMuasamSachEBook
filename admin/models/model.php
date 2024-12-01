<?php
class productModel
{
    public $conn;

    function __construct()
    {
        $this->conn = connectDB();
    }
    function getAllProduct()
    {
        $sql = "SELECT DISTINCT products.id, products.name, products.category_id , products.publishing_house_id,products.author_id, products.img,  products.price, categories.name AS category_name, publishing_houses.name AS publisher_name, authors.name AS author_name 
        FROM products 
        JOIN categories ON categories.id = products.category_id 
        JOIN authors ON authors.id = products.author_id
        JOIN publishing_houses ON publishing_houses.id = products.publishing_house_id WHERE 1";
        $sql .= " ORDER BY products.id DESC";
        return $this->conn->query($sql);
    }

    public function insert($name, $category_id, $publishing_house_id, $author_id, $img, $price, $sale, $description, $quantity)
{
    try {
        $sql = "INSERT INTO products (name, category_id, publishing_house_id, author_id, img, price, sale, description, count_sale, created_at, quantity) 
                VALUES (:name, :category_id, :publishing_house_id, :author_id, :img, :price, :sale, :description, :count_sale, NOW(), :quantity)";
        $stmt = $this->conn->prepare($sql);

        $stmt->execute([
            ':name' => $name,
            ':category_id' => $category_id,
            ':publishing_house_id' => $publishing_house_id,
            ':author_id' => $author_id,
            ':img' => $img,
            ':price' => $price,
            ':sale' => $sale,
            ':description' => $description,
            ':count_sale' => 0, // Giá trị mặc định cho count_sale
            ':quantity' => $quantity,
        ]);

        return true; // Trả về true nếu thành công
    } catch (PDOException $e) {
        // Hiển thị lỗi chi tiết (chỉ bật trong môi trường phát triển)
        echo "Lỗi khi chèn sản phẩm: " . $e->getMessage();
        return false; // Trả về false nếu thất bại
    }
}


    // Lấy thông tin sản phẩm theo ID
    public function getProductById($id)
    {
        try {
            $sql = "SELECT * FROM products WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Lỗi khi lấy thông tin sản phẩm: " . $e->getMessage();
            return false;
        }
    }

    // Hàm cập nhật sản phẩm
    public function update($id, $name, $category_id, $publishing_house_id, $author_id, $img, $price, $sale, $description, $quantity)
{
    try {
        $sql = "UPDATE products 
                SET name = :name, 
                    category_id = :category_id, 
                    publishing_house_id = :publishing_house_id, 
                    author_id = :author_id, 
                    img = :img, 
                    price = :price, 
                    sale = :sale, 
                    description = :description, 
                    quantity = :quantity
                WHERE id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':id' => $id,
            ':name' => $name,
            ':category_id' => $category_id,
            ':publishing_house_id' => $publishing_house_id,
            ':author_id' => $author_id,
            ':img' => $img,
            ':price' => $price,
            ':sale' => $sale,
            ':description' => $description,
            ':quantity' => $quantity,
        ]);

        return true; // Trả về true nếu cập nhật thành công
    } catch (PDOException $e) {
        echo "Lỗi khi cập nhật sản phẩm: " . $e->getMessage();
        return false; // Trả về false nếu có lỗi
    }
}


    // Lấy toàn bộ danh mục (dùng cho dropdown)
    public function getAllDanhmuc()
    {
        try {
            $sql = "SELECT * FROM categories";
            $stmt = $this->conn->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Lỗi khi lấy danh sách danh mục: " . $e->getMessage();
            return false;
        }
    }

    // Lấy toàn bộ nhà xuất bản (dùng cho dropdown)
    public function getAllNhaXuatBan()
    {
        try {
            $sql = "SELECT * FROM publishing_houses";
            $stmt = $this->conn->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Lỗi khi lấy danh sách nhà xuất bản: " . $e->getMessage();
            return false;
        }
    }

    // Lấy toàn bộ tác giả (dùng cho dropdown)
    public function getAllTacgia()
    {
        try {
            $sql = "SELECT * FROM authors";
            $stmt = $this->conn->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Lỗi khi lấy danh sách tác giả: " . $e->getMessage();
            return false;
        }
    }



    



    function delete($id)
    {
        $sql = "delete from products where id=$id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute();
    }
   
    function allCmt (){
        $sql = "SELECT * FROM `comments` ";
        return $this->conn->query($sql)->fetchAll();
    }
    function deleteCmtModel($id)
    {
        $sql = "delete from `comments` where id=$id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute();
    }
    // function checkUser($email,$password) {
    //     $sql = "SELECT * FROM users WHERE email = :email AND password = :password  AND is_admin = :is_admin";
    //     $stmt = $this->conn->prepare($sql);
    //     $stmt->execute([
    //         'email'=>$email,
    //         'password'=>$password,
    //         'is_admin' => 1
    //     ]);
    //     $user = $stmt->fetch();
    //     return $user ? $user : null;
    // }
    
    
    
     // Đếm số lượng đơn hàng mới
     public function getOrderCount() {
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM orders WHERE status = 'Chờ xác nhận'");
        $stmt->execute();
        return $stmt->fetchColumn();
    }
    public function getOrderCountNow() {
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM orders WHERE status = 'đang giao hàng'");
        $stmt->execute();
        return $stmt->fetchColumn();
    }
    public function getOrderCountDelete() {
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM orders WHERE status = 'Đã hủy'");
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    // Đếm số lượng sản phẩm
    public function getProductCount() {
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM products");
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    // Đếm số lượng người dùng
    public function getUserCount() {
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM users");
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    // Tính tổng doanh thu
    public function getTotalRevenue() {
        $stmt = $this->conn->prepare("SELECT SUM(total_amount) FROM orders WHERE status = 'Đã xác nhận'");
        $stmt->execute();
        return $stmt->fetchColumn();
    }
}



?>