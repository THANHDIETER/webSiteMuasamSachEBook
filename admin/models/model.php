<?php
    class productModel {
      public $conn;
  
      function __construct() {
          $this->conn = connectDB();
      }
      function getAllProduct() {
         $sql = "SELECT * FROM books JOIN genre ON books.genre_id = genre.genre_id ORDER BY book_id DESC";
         return $this->conn->query($sql);
     }
     public function print($id){
        $sql="SELECT * FROM books JOIN genre ON books.genre_id = genre.genre_id WHERE book_id=$id";
        return $this->conn->query($sql)->fetch();
     }
     public function insert($title, $author, $description, $genre_id, $price, $stock_quantity, $published_date,$img){
        $sql = "INSERT INTO books VALUE (null,'$title', '$author', '$description', $genre_id, $price, $stock_quantity, '$published_date','$img')";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute();
     }
     function delete($id){
        $sql="delete from books where book_id=$id";
        $stmt=$this->conn->prepare($sql);
        return $stmt->execute();
    }
    function update($id, $title, $author, $description, $genre_id, $price, $stock_quantity, $published_date,$img){
        if (empty($img)) {
            $sql = "UPDATE books SET title='$title', author='$author',description='$description', genre_id=$genre_id,price=$price, stock_quantity=$stock_quantity, published_date='$published_date' WHERE book_id=$id";
        } else {
            $sql = "UPDATE books SET title='$title' , author='$author',description='$description', genre_id=$genre_id,price=$price,stock_quantity=$stock_quantity, published_date='$published_date' ,  image_book='$img' WHERE book_id=$id";
        }
        
        $stmt = $this->conn->prepare($sql); 
        return $stmt->execute();
    }
    function order(){
        $sql="SELECT * FROM orders JOIN order_details ON orders.order_id = order_details.order_id JOIN books ON order_details.book_id= books.book_id DESC order_id";
            return $this->conn->query($sql)->fetch();
    }
    function checkAcc($user,$pass) {
        $sql="select * from users where username='$user' and password='$pass'";
        return  $this->conn->query($sql)->rowCount();
   }
}
?>