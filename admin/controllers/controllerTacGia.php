<?php
require_once 'models/modelTacGia.php';
class tacgiaController
{
    public $tacgiaModel
    ;
    function __construct()
    {
        $this->tacgiaModel = new tacgiaModel();
    }
    function listTacGia()
    {
        $listTacGia = $this->tacgiaModel->getAllTacgia();
        require_once './views/tacgia/listTacGia.php';
    }

}
?>