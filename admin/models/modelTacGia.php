<?php
class tacgiaModel
{
    public $conn;

    function __construct()
    {
        $this->conn = connectDB();
    }
    function getAllTacgia()
    {
        $sql = "SELECT * FROM authors  ";
        $sql .= " ORDER BY id desc";
        return $this->conn->query($sql);
    }


}
?>