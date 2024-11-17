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
    //     function update($id)
//     {
//         $Product = $this->productModel->print($id);
//         require_once 'views/updateProduct.php';

    //         if (isset($_POST['btn_update'])) {
//             $id = $_POST['id'];
//             $ten = $_POST['ten'];
//             $tac_gia = $_POST['tac_gia'];
//             $gia = $_POST['gia'];
//             if (empty($_FILES['img']['name'])) {
//                 $img = "";
//             } else {
//                 $img = $_FILES['img']['name'];
//                 $tmp = $_FILES['img']['tmp_name'];
//                 move_uploaded_file($tmp, '../assets/images/prod/books/' . $img);
//             }

    //             if ($this->productModel->update($id, $ten, $tac_gia, gia: $gia, img: $img)) {
//                 echo '<script type="text/javascript">
//                window.location.href = "?act=listproduct";
//                alert("Bạn đã cập nhật thành công");
//                </script>';
//             } else {
//                 echo "Lỗi";
//             }
//         }
//     }
}
?>