
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookbuy _ Home</title>
    <!-- Bootstrap CSS -->
    
    <link rel="stylesheet" href="../styte/style.js">
    <link rel="stylesheet" href="../style/css/style.css">
    <link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
        
/* Thay đổi màu nền của nút */
.carousel-control-prev,
.carousel-control-next {
    background-color: transparent;
    margin-top: 20%; /* Đẩy các nút xuống dưới */
    border: none;
}

/* Thay đổi kích thước của các nút */
.carousel-control-prev-icon,
.carousel-control-next-icon {
    width: 40px; 
    height: 40px; 
    background-color:darkgrey;
}
/* Tùy chỉnh kích thước của nút điều khiển */
.carousel-control-prev,
.carousel-control-next {
    width: 60px; 
    height: 60px; 
  
}

a:hover{
    background-color:lightgray;
    color: white;
}
.link-hover a {
    transition: color 0.3s ease; /* Thêm hiệu ứng chuyển màu mượt mà */
}

.link-hover a:hover {
    color: white !important; 
    transition: ease 1s ;
}

/* css sản phẩm */
.card-img-top {
    object-fit: cover;
    height: 200px;
    width: 100%;
}
.card-body {
    padding: 15px;
}
.card-title {
    font-size: 1rem;
    color: #333;
}
.card-text {
    font-size: 0.875rem;
    color: #ff8c00;
}



    </style>
</head>
<body>
<?php  require_once 'components/header.php'; ?>
   <div class="container">
   
<!-- Main Content -->
<main class="container my-4">
    <div class="row">
     
<!-- Sách mới -->

<section class="book-list">
<strong><hr></strong>
<h2 class="h5 mb-3">danh sách</h2>
<div class="row">
    <!-- Sách 1 -->
    <?php foreach($allSearch as $key): ?>
                <div class="col-md-3 mb-3">
                    <div class="card">
                        <a href="?act=detail&id=<?php echo $key['id']?>"><img style=" height:280px;  padding: 20px; "  src="./assets/images/prod/books/<?php echo $key['img'] ?>" class="card-img-top" alt="Về Đi Con - Bìa Cứng"></a>
                        <div class="card-body"> 
                            <h6 class="card-title"><?php echo $key['name'] ?></h6>
                            <div class="d-flex justify-content-between">
                                <p class="text-danger font-weight-bold"><?php  $price=$key['price'];
                                $formatted_price = number_format($price, 0, ',', '.'); 
                                echo $formatted_price . 'đ'; ?></p>
                                <p class="text-muted"><del><?php  $price=$key['price']-($key['price']/100)*$key['sale'];
                                $formatted_price = number_format($price, 0, ',', '.'); 
                                echo $formatted_price . 'đ'; ?></del> <span
                                        class="badge text-danger ">-<?php echo $key['sale'] ?>%</span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php  endforeach; ?>
    

</section>
<hr>

                   
                    
                    <!-- Thêm sách khác nếu cần -->
                </div>
            </section>
        </div>
    </div>
</main>

<!-- Footer -->
<?php  require_once 'components/footer.php'; ?>

   </div>
    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
