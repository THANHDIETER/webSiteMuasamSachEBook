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

   
   <div class="container">
   <?php  require_once 'components/header.php'; ?>

<!-- Main Content -->
<main class="container my-4">#
    <div class="row">
        <!-- Sidebar for categories -->
        <aside class="col-md-3">
 
            <h1 class="h5 border-bottom pb-2">Danh mục</h1>
            <ul class="list-unstyled">
            <?php foreach ($danhmuc as $value) { ?>
                <li><a href="#" class="text-secondary text-decoration-none d-block py-1"><?php echo $value['name'] ?></a></li>
                <?php } ?>
               
            </ul>
            <h1 class="h5 border-bottom pb-2">Tác giả </h1>
            <ul class="list-unstyled">
            <?php foreach($products as $value): ?>
                <li><a href="#" class="text-secondary text-decoration-none d-block py-1"><?php echo $value['tac_gia'] ?></a></li>
                <?php endforeach ?>
            </ul>
            <h1></h1>

           
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
</div>
<!-- Sách mới -->

<section class="book-list">
<strong><hr></strong>
<h2 class="h5 mb-3">Sách mới</h2>
<div class="row">
    <!-- Sách 1 -->
    <?php foreach($top8 as $key): ?>
                <div class="col-md-3 mb-3">
                    <div class="card">
                        <a href="?act=detail&id=<?php echo $key['id']?>"><img style=" height:280px;  padding: 20px; "  src="./assets/images/prod/books/<?php echo $key['img'] ?>" class="card-img-top" alt="Về Đi Con - Bìa Cứng"></a>
                        <div class="card-body"> 
                            <h6 class="card-title"><?php echo $key['ten'] ?></h6>
                            <p class="text-success"><?php echo $key['tac_gia'] ?></p>
                            <div class="d-flex justify-content-between">
                                <p class="text-danger font-weight-bold"><?php echo $key['gia'] ?></p>
                                <p class="text-muted"><del><?php echo $price=$key['gia']-($key['gia']/100)*$key['sale'] ?></del> <span
                                        class="badge badge-danger">-<?php echo $key['sale'] ?>%</span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php  endforeach; ?>
    

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

   </div>
    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>


