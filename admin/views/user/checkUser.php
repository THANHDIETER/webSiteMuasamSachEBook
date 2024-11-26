<?php if(!isset($_SESSION['name'])){
     echo '<script type="text/javascript">
     window.location.href = "?act=/";
     alert("chưa đăng nhập thì không vô được nha :)");
 </script>';
    exit();
} ?>