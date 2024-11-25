<?php
require_once 'models/model.php';
class danhmucController
{
    public $danhmucModel;
    function __construct()
    {
        $this->danhmucModel = new danhmucModel();
    }
    function listDanhMuc()
    {
        $listDanhMuc = $this->danhmucModel->getAllDanhmuc();
        require_once './views/danhmuc/listDanhMuc.php';
    }
    public function addDanhMuc()
    {
        if (isset($_POST['btn_insert'])) {
            $name = $_POST['name'];

            // tạo 1 mảng trống để chứa dữ liệu
            $errors = [];
            if (empty($name)) {
                $errors['name'] = 'Tên danh mục không được để trống';
            }
            if (empty($errors)) {
                // nếu ko có lỗi thì tiến hành thêm danh mục
                $this->danhmucModel->insertDanhMuc($name);
                echo '<script type="text/javascript">
                    window.location.href = "?act=listdanhmuc";
                     alert("Bạn đã thêm danh mục thành công");
                </script>';
                exit();

            } else {
                // trả về form và lỗi
                require_once './views/danhmuc/addDanhMuc.php';
            }

        } else {
            require_once './views/danhmuc/addDanhMuc.php';
        }
    }
    function delete($id)
    {
        if ($this->danhmucModel->deleteDmuc($id)) {
            echo '<script type="text/javascript">
            window.location.href = "?act=listdanhmuc";
            alert("Bạn đã xóa thành công");
            </script>';
        } else {
            echo "Lỗi";
        }
    }
    function update($id)
    {
        $Product = $this->danhmucModel->print($id);
        require_once './views/danhmuc/updateDmuc.php';

        if (isset($_POST['btn_update'])) {
            $id = $_POST['id'];
            $name = $_POST['name'];


            if ($this->danhmucModel->updateDmuc($id, $name)) {
                echo '<script type="text/javascript">
               window.location.href = "?act=listdanhmuc";
               alert("Bạn đã cập nhật thành công");
               </script>';
            } else {
                echo "Lỗi";
            }
        }
    }
}
?>