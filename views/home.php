<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookbuy _ Home</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../styte/style.js">
    <link rel="stylesheet" href="../style/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
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
a{
    color: aqua;
}
a:hover{
    background-color:gray;
    color: aliceblue;
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

    <!-- Top Navigation -->
    <div class="bg-light py-2 border-bottom">
    <div class="container d-flex justify-content-between">
        <div class="link-hover">
            <a href="#" class="text-secondary text-decoration-none mr-3 "><i class="bi bi-exclamation-lg"></i> Trợ giúp</a>
            <a href="#" class="text-secondary text-decoration-none mr-3"><i class="bi bi-chat-square-dots-fill"></i> Tin tức</a>
            <a href="#" class="text-secondary text-decoration-none"><i class="bi bi-cash-coin"></i>  Khuyến mãi</a>
        </div>
    
        <div class="link-hover">
            <a href="#" class="text-warning text-decoration-none mr-3"><i class="bi bi-phone-vibrate"></i> 0332371912</a>
            <a href="#" class="text-secondary text-decoration-none  mr-3"><i class="bi bi-box-seam"></i> Kiểm tra đơn hàng</a>
            <a href="?act=log" class="text-secondary text-decoration-none mr-3">
            <i class="bi bi-box-arrow-in-right"> Đăng Nhập</i>
            </a>
            <a href="#" class="text-secondary">Đăng ký</a>
        </div>
    </div>
</div>

    <!-- Header -->
    <header class="bg-white py-3 border-bottom">
        <div class="container d-flex align-items-center justify-content-between">
            <h1 class="text-warning font-weight-bold">Bookbuy.vn</h1>
            <div class="input-group w-50">
                <input type="text" class="form-control" placeholder="Bạn cần tìm gì?">
                <div class="input-group-append">
                    <button class="btn btn-warning" type="button">Tìm kiếm</button>
                </div>
            </div>
            <a href="#" class="text-secondary text-decoration-none"><i class="bi bi-cart4"></i> Giỏ hàng (0)</a>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container my-4">
        <div class="row">
            <!-- Sidebar for categories -->
            <aside class="col-md-3">
     
                <h1 class="h5 border-bottom pb-2">Danh mục</h1>
                <ul class="list-unstyled">
                <?php foreach ($danhmuc as $value) { ?>
                    <li><a href="#" class="text-secondary text-decoration-none d-block py-1"><?php echo $value['name'] ?></a></li>
                    <?php } ?>
                   
                </ul>
                <h1 class="h5 border-bottom pb-2">Tác giả tiêu biểu</h1>
                <ul class="list-unstyled">
                <?php foreach ($tac_gia as $value) { ?>
                    <li><a href="#" class="text-secondary text-decoration-none d-block py-1"><?php echo $value['name'] ?></a></li>
                    <?php } ?>
                </ul>
                <h1></h1>

                <h1 class="h5 border-bottom pb-2">Theo độ tuổi</h1>
                <ul class="list-unstyled">
                <?php foreach ($tac_gia as $value) { ?>
                    <li><a href="#" class="text-secondary text-decoration-none d-block py-1"><?php echo $value['name'] ?></a></li>
                    <?php } ?>

                </ul>
                <h1 class="h5 border-bottom pb-2">Theo giá</h1>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-secondary text-decoration-none d-block py-1">Giá nhỏ hơn 50.000đ</a></li>
                    <li><a href="#" class="text-secondary text-decoration-none d-block py-1">Giá từ 50.000 - 100.000đ</a></li>
                    <li><a href="#" class="text-secondary text-decoration-none d-block py-1">Giá từ 100.000 - 200.000đ</a></li>
                    <li><a href="#" class="text-secondary text-decoration-none d-block py-1">Giá từ 200.000 - 300.000đ</a></li>
                    <li><a href="#" class="text-secondary text-decoration-none d-block py-1">Giá từ 300.000 - 400.000đ</a></li>
                    <li><a href="#" class="text-secondary text-decoration-none d-block py-1">Giá từ 400.000 - 500.000đ</a></li>
                    <li><a href="#" class="text-secondary text-decoration-none d-block py-1">Giá từ 500.000 - 1.000.000đ</a></li>
                    <li><a href="#" class="text-secondary text-decoration-none d-block py-1">Giá lớn hơn 1.000.000đ</a></li>
                </ul>       
            </aside>
 <!-- Banner and Book List -->
 <div class="col-md-9">
                <!-- Banner -->
    <div id="carouselExampleDark" class="carousel carousel-dark slide carousel-fade" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active" data-bs-interval="2000">
            <a href="#"><img src="https://bookbuy.vn/Res/Images/Album/4ef6e847-be96-46b0-8421-e24587989776.png?w=920&h=420&mode=crop" class="d-block w-100" alt="Slide 1"></a>
        </div>
        <div class="carousel-item" data-bs-interval="2000">
            <a href="#"><img src="https://bookbuy.vn/Res/Images/Album/ffd62e0e-02fb-4e7a-96fe-42ed8966c89b.png?w=920&h=420&mode=crop" class="d-block w-100" alt="Slide 2"></a>
        </div>
        <div class="carousel-item" data-bs-interval="2000">
            <a href="#"><img src="https://bookbuy.vn/Res/Images/Album/00456729-e290-44a5-bbe9-da9a261ff77b.png?w=920&h=420&mode=crop" class="d-block w-100" alt="Slide 3"></a>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
    </button>
</div>

<!-- Sách mới -->

 <section class="book-list">
<strong><hr></strong>
    <h2 class="h5 mb-3">Sách mới</h2>
    <div class="row">
        <!-- Sách 1 -->
        <div class="col-6 col-sm-4 col-md-3 mb-4">
            <div class="">
                <img src="https://bookbuy.vn/Res/Images/Product/hieu-bo-nao-ly-giai-ung-ung-tuoi-teen_133341_1.jpg" class="card-img-top" alt="Hiểu Bộ Não - Lý Giải Ứng Xử Tuổi Teen">
                <div class="card-body text-center">
                    <h6 class="card-title font-weight-bold">Hiểu Bộ Não - Lý Giải Ứng Xử Tuổi Teen</h6>
                    <p class="card-text text-warning">Nicola Morgan</p>
                    <!-- Giá -->
                    <div class="price-wrapper d-flex flex-column align-items-center">
                        <div class="d-flex align-items-center">
                            <span class="old-price text-muted" style="text-decoration: line-through; margin-right: 10px;">300,000₫</span>
                            <span class="new-price text-danger font-weight-bold" style="font-size: 1.2rem;">255,000₫</span>
                        </div>
                        <span class="badge badge-danger mt-2" style="font-size: 0.9rem;">Sale 15%</span>
                    </div>
                </div>
            </div>
        </div>
        

</section>
<hr>
<h3>why you keep buying books you don’t read</h3>
<iframe width="800" height="300" src="https://www.youtube.com/embed/Bh3EnIPVwIE?si=8C-SMO0e2bSNp46L" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>

                       
                        
                        <!-- Thêm sách khác nếu cần -->
                    </div>
                </section>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white py-3">
        <div class="container text-center">
            <p>&copy; 2024 Bookbuy.vn. All rights reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>


