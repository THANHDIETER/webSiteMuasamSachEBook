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

    public function addTacGia()
    {
        if (isset($_POST['btn_insert'])) {
            $name = $_POST['name'];

            // tạo 1 mảng trống để chứa dữ liệu
            $errors = [];
            if (empty($name)) {
                $errors['name'] = 'Tên tác giả không được để trống';
            }
            if (empty($errors)) {
                // nếu ko có lỗi thì tiến hành thêm danh mục
                $this->tacgiaModel->insertTacGia($name);
                echo '<script type="text/javascript">
                    window.location.href = "?act=listtacgia";
                     alert("Bạn đã thêm tác giả thành công");
                </script>';
                exit();

            } else {
                // trả về form và lỗi
                require_once './views/tacgia/addTacGia.php';
            }

        } else {
            require_once './views/tacgia/addTacGia.php';
        }
    }
    function deleteTacGia($id)
    {
        if ($this->tacgiaModel->deleteTacGia($id)) {
            echo '<script type="text/javascript">
            window.location.href = "?act=listtacgia";
            alert("Bạn đã xóa thành công");
            </script>';
        } else {
            echo "Lỗi";
        }
    }
    function updateTacGia($id)
    {
        $Tacgia = $this->tacgiaModel->print($id);
        require_once './views/tacgia/updateTacGia.php';

        if (isset($_POST['btn_update'])) {
            $id = $_POST['id'];
            $name = $_POST['name'];


            if ($this->tacgiaModel->updateTacGia($id, $name)) {
                echo '<script type="text/javascript">
               window.location.href = "?act=listtacgia";
               alert("Bạn đã cập nhật thành công");
               </script>';
            } else {
                echo "Lỗi";
            }
        }
    }

}
?>