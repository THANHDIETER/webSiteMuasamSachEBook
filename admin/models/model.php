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
        $sql = "SELECT DISTINCT products.id, products.name, products.category_id , products.publishing_house_id,products.author_id, products.img,  products.price, categories.name AS category_name, publisher.name AS publisher_name, authors.name AS author_name 
        FROM products 
        JOIN categories ON categories.id = products.category_id 
        JOIN authors ON authors.id = products.author_id
        JOIN publisher ON publisher.id = products.publishing_house_id WHERE 1";
        $sql .= " ORDER BY products.id DESC";
        return $this->conn->query($sql);
    }

    public function insert($name, $category_id, $publishing_house_id, $author_id, $img, $price, $description)
    {
        $sql = "INSERT INTO products (name, category_id, publishing_house_id, author_id, img, price, description) VALUES (:name, :category_id, :publishing_house_id, :author_id, :img, :price, :description)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':name' => $name,
            ':category_id' => $category_id,
            ':publishing_house_id' => $publishing_house_id,
            ':author_id' => $author_id,
            ':img' => $img,
            ':price' => $price,
            ':description' => $description,
        ]);
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
    function checkUser($email,$password) {
        $sql = "SELECT * FROM users WHERE email = :email AND password = :password  AND is_admin = :is_admin";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'email'=>$email,
            'password'=>$password,
            'is_admin' => 1
        ]);
        $user = $stmt->fetch();
        return $user ? $user : null;
    }


}
?>