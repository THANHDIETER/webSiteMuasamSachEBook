<?php
    function connectDB(){
        $host = 'localhost';
        $dbname = 'book_store';
        $username = 'root';
        $password = '';
        
        
        try {
            $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION ,);
            return $conn;
        } catch (PDOException $e) {
            echo "Kết nối thất bại: " . $e->getMessage();
            exit;
        }
    }
    define('BASE_URL', 'http://localhost/webSiteMuasamSachEBook-DuAn1');
    function dd($data){
        echo '<pre>';
        print_r($data);
        die;
    }
    
?>