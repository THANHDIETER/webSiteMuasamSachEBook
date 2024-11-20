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
    public function addNhaXuatBan()
    {
        if (isset($_POST['btn_insert'])) {
            $name = $_POST['name'];

            // tạo 1 mảng trống để chứa dữ liệu
            $errors = [];
            if (empty($name)) {
                $errors['name'] = 'Tên nhà xuất bản không được để trống';
            }
            if (empty($errors)) {
                // nếu ko có lỗi thì tiến hành thêm danh mục
                $this->nhaXuatBanModel->insertNhaXuatBan($name);
                echo '<script type="text/javascript">
                    window.location.href = "?act=listNhaXuatBan";
                     alert("Bạn đã thêm nhà xuất bản thành công");
                </script>';
                exit();

            } else {
                // trả về form và lỗi
                require_once './views/NXB/addNXB.php';
            }

        } else {
            require_once './views/NXB/addNXB.php';
        }
    }
    function deleteNhaXuatBan($id)
    {
        if ($this->nhaXuatBanModel->deleteNhaXuatBan($id)) {
            echo '<script type="text/javascript">
            window.location.href = "?act=listNhaXuatBan";
            alert("Bạn đã xóa thành công");
            </script>';
        } else {
            echo "Lỗi";
        }
    }



}
?>