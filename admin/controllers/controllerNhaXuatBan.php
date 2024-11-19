<?php
require_once 'models/modelNhaXuatBan.php';
class nhaXuatBanController
{
    public $nhaXuatBanModel
    ;
    function __construct()
    {
        $this->nhaXuatBanModel = new nhaXuatBanModel();
    }
    function listNhaXuatBan()
    {
        $listNhaXuatBan = $this->nhaXuatBanModel->getAllNhaXuatBan();
        require_once './views/NXB/listNXB.php';
    }



}
?>