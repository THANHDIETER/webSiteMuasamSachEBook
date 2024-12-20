
<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Document</title>
     <link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
     <style>
        body {
            background-color: #e9ecef;
            font-family: 'Arial', sans-serif;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
        }
        h3 {
            color: #343a40;
            font-weight: bold;
        }
        .table {
            border-radius: 8px;
            overflow: hidden;
        }
        .table-bordered {
            border: 1px solid #dee2e6;
        }
        .table thead {
            background-color: #212529;
            color: white;
        }
        .badge {
            padding: 0.5em 1em;
            font-size: 90%;
        }
        .btn {
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }
        .text-danger, .text-success, .text-primary {
            font-weight: bold;
        }
        .alert-info {
            text-align: center;
            font-size: 1.2em;
        }
        header{
          margin-bottom: -20px;  
        }
    </style>
    </head>
<body>
  
    <header>
    <?php
if (isset($_SESSION['message'])) {
    echo '<div class="alert alert-info">' . $_SESSION['message'] . '</div>';
    unset($_SESSION['message']); // Xóa thông báo sau khi hiển thị
}
?>

      <!-- nav 1 -->
     <nav style="background-color: lightgray;" class="navbar navbar-expand-lg  ">
          <div class="container  container-fluid">
           <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
                <li class="nav-item">
                  <a class="nav-link active position-relative" aria-current="page" href="#"> <i class="bi bi-info-circle"></i> - Trợ Giúp </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="#"> <i class="bi bi-newspaper"></i> -  Tin Tức</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="#"> <i class="bi bi-credit-card"></i> -  Khuyễn Mãi</a>
                </li>
              </ul>
              <ul class="d-flex navbar-nav  mb-2 mb-lg-0">
                  <li class="nav-item">
                      <a class="nav-link active" aria-current="page" href="#"><i class="bi bi-gift-fill"></i> - Ưu đãi & Tiện Ích</a>
                    </li>
                  <li class="nav-item">
                      <a class="nav-link active" aria-current="page" href="?act=order"><i class="bi bi-boxes"></i> - Kiểm Tra Đơn Hàng</a>
                    </li>
                    <?php
                        if (isset($_SESSION['id'])) { // Check if the user session exists
                            echo '
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="?act=profile"> <i class="bi bi-person-circle"> ' . $_SESSION['name'] . '</i></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="?act=logout"><i class="bi bi-box-arrow-right"></i> Logout</a>
                            </li>';
                        } else {
                            echo '
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="?act=login"><i class="bi bi-box-arrow-in-left"></i> Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="?act=register"><i class="bi bi-file-earmark-person"></i> Register</a>
                            </li>';
                        }
                        ?>

                   


              </ul>
            </div>
          </div>
        </nav>
        <!-- nav 2 -->
        <nav  class="navbar navbar-expand-lg  bg-body-tertiary ">
          <div class="container-fluid .bg-light p-2  ">
            <div style="display: flex; gap:80px; justify-content: space-between;" class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
              <a class="" href="?act=home "><img style="width:150px;" src="./styte/img/logo.png" alt=""></a>
              <a class="nav-link active" href="?act=product">Tất Cả</a>
              <form class="d-flex" role="search" method="GET" action="index.php">
                  <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="keySearch" required>
                  <button class="btn btn-outline-success" type="submit" name="act" value="search">Search</button>
              </form>

              <a  class="nav-link active" href="#">
              <i style="font-size:40px; color:burlywood;" class="bi bi-headset"> </i> 
              </a>
              <h5 style="color:burlywood;">0972150772 <br>Hot line </h5>
              <a class="nav-link active" href="?act=cart">
                  <i style="font-size:40px; color:burlywood;" class="bi bi-cart-plus"></i> 
                  - Giỏ Hàng (<span id="cart-item-count"><?= (new CartController())->getCartItemCount(); ?></span>)
              </a>



            </div>
          </div>
        </nav>  
        <!-- nav 3 -->
        <nav  class="navbar navbar-expand-lg  bg-body-white ">
          <div class="container-fluid .bg-light p-2  ">
            <div style="display: flex; gap:160px; justify-content: space-between;" class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
              <li class="nav-link"  >
              <a class="nav-link " href="?act=product" role="button" aria-expanded="false">
              <i style="font-size:30px; line-height: 40px;  "class="bi bi-list"></i> DANH MỤC SẢN PHẨM </a>
                </li>
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i style="font-size:20px; color:red;" class="bi bi-2-circle"></i> giảm thêm 2%
                </a>
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i style="font-size:20px; color:red;" class="bi bi-receipt"></i> chương trình khuyến mãi
                </a>
                <span  class="   badge rounded-pill bg-danger">
                 <a style="font-size:30px;" class="nav-link" href="#">sale sốc xả kho</a>
                </span>
            </div>
          </div>
        
    </header>
</body>
</html>
