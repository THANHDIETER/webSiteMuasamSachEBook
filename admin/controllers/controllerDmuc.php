<?php
require_once 'models/model.php';
class danhmucController
{
    public $danhmucModel;
    function __construct()
    {
        $this->danhmucModel = new danhmucModel();
    }
    function listDmuc()
    {
        $allDmuc = $this->danhmucModel->getAllDmuc();
        require_once 'views/listDmuc.php';
    }
    public function addDmuc()
    {

        require_once 'views/addDmuc.php';
        if (isset($_POST['btn_insert'])) {
            $name = $_POST['name'];

            if ($this->danhmucModel->addDmuc($name)) {

                echo '<script type="text/javascript">
                    window.location.href = "?act=listDmuc";
                    alert("Bạn đã thêm danh mục thành công");
                    </script>';
            } else {
                echo "Lỗi";
            }
        }
    }
    function delete($id)
    {
        if ($this->danhmucModel->deleteDmuc($id)) {
            header("location:?act=listDmuc");
        } else {
            echo "Lỗi";
        }
    }
    function update($id)
    {
        $Product = $this->danhmucModel->print($id);
        require_once 'views/updateDmuc.php';

        if (isset($_POST['btn_update'])) {
            $id = $_POST['id'];
            $name = $_POST['name'];


            if ($this->danhmucModel->updateDmuc($id, $name)) {
                echo '<script type="text/javascript">
               window.location.href = "?act=listDmuc";
               alert("Bạn đã cập nhật thành công");
               </script>';
            } else {
                echo "Lỗi";
            }
        }
    }
}
?>