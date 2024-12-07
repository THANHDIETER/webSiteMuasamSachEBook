<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookbuy _ Home</title>
    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="../styte/css/styte.css">
    <link rel="stylesheet" href="./styte/styte.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <style>
        
/* Thay đổi màu nền của nút */
.carousel-control-prev,
.carousel-control-next {
    background-color: transparent;
    margin-top: 20%;
    /* Đẩy các nút xuống dưới */
    border: none;
}

/* Thay đổi kích thước của các nút */
.carousel-control-prev-icon,
.carousel-control-next-icon {
    width: 40px;
    height: 40px;
    background-color: darkgrey;
}

/* Tùy chỉnh kích thước của nút điều khiển */
.carousel-control-prev,
.carousel-control-next {
    width: 60px;
    height: 60px;

}

a:hover {
    background-color: gray;
    color: white;
}

.link-hover a {
    transition: color 0.3s ease;
    /* Thêm hiệu ứng chuyển màu mượt mà */
}

.link-hover a:hover {
    color: white !important;
    transition: ease 1s;
}

/* css sản phẩm */
.card-img-top {
    object-fit: cover;
    height: 150px;
    width: 1px;
}

.card-body {
    padding: 10px;
}

.card-title {
    font-size: 1rem;
    color: #333;
}

.card-text {
    font-size: 0.875rem;
    color: #ff8c00;
}
.currently-serving {
display: flex;
justify-content: space-between; /* Căn đều các sản phẩm */
gap: 20px; /* Khoảng cách giữa các sản phẩm */
margin-top: 20px;
}

.product {
flex: 1;
text-align: center;
border: 1px solid #ddd;
padding: 15px;
box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
border-radius: 10px; /* Góc bo tròn cho sản phẩm */
background-color: #fff; /* Màu nền trắng cho sản phẩm */
margin-right: -10px
}

.product img {
width: 100%; /* Đảm bảo ảnh chiếm hết chiều rộng của phần tử */
height: auto; /* Giữ tỉ lệ ảnh */
max-height: 200px; /* Đảm bảo chiều cao ảnh không quá 200px */
object-fit: cover; /* Đảm bảo ảnh không bị méo */
border-radius: 10px; /* Góc bo tròn cho ảnh */
}
.product:hover{
    transform: scale(1.1);
    transition: all ease 1s;
}

.product h3 {
margin-top: 15px;
font-size: 1.2rem;
font-weight: bold;
color: #333;
}

.product button {
margin-top: 10px;
padding: 10px 20px;
background-color: #8B4F41; /* Màu nền của nút */
color: white;
border: none;
border-radius: 25px; /* Bo tròn góc của nút */
cursor: pointer;
transition: background-color 0.3s ease;
}

.product button:hover {
background-color:aquamarine; /* Màu nền khi hover */
border: none;
border-radius: 25px; /* Bo tròn góc của nút */
cursor: pointer;
transition: background-color 0.3s ease;
}
/* Trên là top 3 sản ph */


.rounded-box {
width: 800px;
height: 200px;
background-color:grey;
border-radius: 30px;
display: flex;
justify-content: center;
align-items: center;
text-align: center;
color: white;
border: 2px solid #ddd;
font-weight: bold;
text-transform: uppercase;
letter-spacing: 1px;
padding: 10px;
margin-top: 50px;
opacity: 0;  
transform: translateX(100%);  /* Đặt ô vuông ra ngoài màn hình */
transition: all 3s ease;  /* Hiệu ứng chuyển động */
}

.rounded-box.visible {
opacity: 1;  /* Hiển thị */
transform: translateX(0);  /* Di chuyển ô vuông về vị trí ban đầu */
}
.text{
    padding: 0 100px;
    font-size: 18px;
}

/* tạm */
/* Đảm bảo body và html chiếm toàn bộ chiều cao */
html, body {
    height: 100%;
    margin: 0;
    
}

/* Phần chính của trang */
main {
    display: flex;
    flex-direction: column;
    flex-grow: 1;
}

/* Đảm bảo carousel hiển thị đúng */
.product-carousel-container {
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden;
    margin-top: 30px;
    margin-bottom: 20px;
}

.product-carousel {
    display: flex;
    overflow-x: auto;
    scroll-snap-type: x mandatory;
    width: 100%;
}

.carousel-wrapper {
    display: flex;
    gap: 15px;
}

.product-card {
    width: 200px;
    height: 350px;
    position: relative;
    overflow: hidden;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: box-shadow 0.3s ease, transform 0.3s ease;
}

/* Hiệu ứng hover cho sản phẩm */
.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

.product-img-container {
    position: relative;
    height: 200px;
    overflow: hidden;
}

.product-img-top {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.product-card-body {
    padding: 15px;
    background-color: #fff;
}

.product-card-title {
    font-size: 1rem;
    font-weight: bold;
    margin-bottom: 10px;
}

.product-author {
    font-size: 0.875rem;
    color: #28a745;
    margin-bottom: 10px;
}

.product-price {
    font-size: 1rem;
    font-weight: bold;
    color: #dc3545;
    margin-bottom: 5px;
}

.product-sale {
    font-size: 0.875rem;
    color: #6c757d;
}

.badge {
    font-size: 0.75rem;
    font-weight: bold;
    padding: 3px 6px;
    background-color: #dc3545;
    color: #fff;
}

.product-card:hover .product-img-top {
    transform: scale(1.1);
}

/* Các nút điều hướng carousel */
.carousel-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background-color: rgba(0, 0, 0, 0.5);
    color: #fff;
    border: none;
    padding: 10px;
    font-size: 20px;
    cursor: pointer;
    z-index: 10;
}

.left-btn {
    left: 10px;
}

.right-btn {
    right: 10px;
}

.carousel-btn:hover {
    background-color: rgba(0, 0, 0, 0.7);
}

/* Footer */
footer {
    background-color: #f8f9fa;
    padding: 20px 0;
    text-align: center;
    width: 100%;
    margin-top: auto;  /* Đảm bảo footer luôn ở dưới */
}

    </style>
</head>


<?php require_once 'components/header.php'; ?>

<body style="background-color:#f2f2f2;">
    
    <div class="container" style="background-color: white;">

        <!-- Main Content -->
        <main class="container my-4">
            <div class="row">
                <!-- Sidebar for categories -->
                <aside class="col-md-3">

                    <h1 class="h5 border-bottom pb-2">Danh mục</h1>
                    <ul class="list-unstyled ">
                        <?php foreach ($danhmuc as $key): ?>
                            <li><a href="?act=dmid&id=<?= $key['id'] ?>"
                                    class=" nav-link btn-primary"><?php echo $key['name'] ?></a> </li>
                        <?php endforeach; ?>

                    </ul>
                    <h1 class="h5 border-bottom pb-2">Tác giả </h1>
                    <ul class="list-unstyled">
                        <?php foreach ($products as $value): ?>
                            <li><a href="#"
                                    class="text-secondary text-decoration-none d-block py-1"><?php echo $value['author'] ?></a>
                            </li>
                        <?php endforeach ?>
                    </ul>
                    <h1></h1>


                    </ul>
                </aside>
                <!-- Banner and Book List -->

                <div class="col-md-9">
                    <div id="carouselExampleDark" class="carousel carousel-dark slide carousel-fade"
                        data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active" data-bs-interval="2000">
                                <a href="#"><img
                                        src="https://bookbuy.vn/Res/Images/Album/4ef6e847-be96-46b0-8421-e24587989776.png?w=920&h=420&mode=crop"
                                        class="d-block w-100" alt="Slide 1"></a>
                            </div>
                            <div class="carousel-item" data-bs-interval="2000">
                                <a href="#"><img
                                        src="https://bookbuy.vn/Res/Images/Album/ffd62e0e-02fb-4e7a-96fe-42ed8966c89b.png?w=920&h=420&mode=crop"
                                        class="d-block w-100" alt="Slide 2"></a>
                            </div>
                            <div class="carousel-item" data-bs-interval="2000">
                                <a href="#"><img
                                        src="https://bookbuy.vn/Res/Images/Album/00456729-e290-44a5-bbe9-da9a261ff77b.png?w=920&h=420&mode=crop"
                                        class="d-block w-100" alt="Slide 3"></a>
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        </button>
                    </div>
                    <hr>
                    <br>
                    <h2 class="h5 mb-3">Top 3 Sản Phẩm hot của Web</h2>
                    <hr>
                    <div class="currently-serving">
                        <!-- Product 1 -->
                        <?php foreach ($top3 as $key): ?>
                            <div class="product col-md-4">
                                <img src="./assets/images/prod/books/<?php echo $key['img'] ?>" alt="No url">
                                <h3><?php echo $key['name'] ?></h3>
                                <a href="?act=detail&id=<?php echo $key['id'] ?>"> <button>Order now</button></a>
                            </div>
                        <?php endforeach ?>

                        <!-- Product 2 -->

                    </div>
                    <div style="margin-left:70px ;" class="rounded-box">
                        <h3 class="text ">Khám Phá Thế Giới Sách Mới
                            Chào mừng bạn đến với Ebook! Chúng tôi tự hào mang đến cho bạn những cuốn sách hay nhất từ
                            các tác giả nổi tiếng, giúp bạn mở rộng kiến thức, nâng cao tư duy và thư giãn sau những giờ
                            làm việc căng thẳng.</h3>
                    </div>
                    <br>
<!-- Sách mới -->
<section class="product-list">
    <h2 class="h5 mb-3">Sách bán chạy</h2>
    <div class="product-carousel-container">
        <!-- <button class="carousel-btn left-btn">&#8249;</button> -->
        <div class="product-carousel">
            <div class="carousel-wrapper">
                <!-- Sách 1 -->
                <?php foreach ($top5 as $key): ?>
                    <div class="product-card">
                        <a href="?act=detail&id=<?php echo $key['id'] ?>" class="product-card-link">
                            <div class="product-img-container">
                                <img
                                    src="./assets/images/prod/books/<?php echo $key['img'] ?>"
                                    class="product-img-top"
                                    alt="<?php echo $key['name'] ?>"
                                >
                            </div>
                        </a>
                        <div class="product-card-body">
                            <h6 class="product-card-title"><?php echo $key['name'] ?></h6>
                            <p class="product-author text-success"><?php echo $key['author'] ?></p>
                            <div class="d-flex justify-content-between my-4 gap-4">
                                <p class="product-price text-danger font-weight-bold ">
                                    
                                    <?php 
                                            $sale_price = $key['price'] - ($key['price'] * $key['sale'] / 100);
                                            $formatted_sale_price = number_format($sale_price, 0, ',', '.');
                                            echo $formatted_sale_price . 'đ'; 
                                        ?>
                                </p>
                                <p class="product-sale text-muted ">
                                    <del>
                                    <?php 
                                        $price = $key['price'];
                                        $formatted_price = number_format($price, 0, ',', '.');
                                        echo $formatted_price . 'đ'; 
                                    ?>
                                    </del>
                                    <span class="badge " style="color: white;"></style> >-<?php echo $key['sale'] ?>%</span>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <!-- <button class="carousel-btn right-btn">&#8250;</button> -->
    </div>
</section>
<section class="product-list">
    <h2 class="h5 mb-3">Sách Mới</h2>
    <div class="product-carousel-container">
        <!-- <button class="carousel-btn left-btn">&#8249;</button> -->
        <div class="product-carousel">
            <div class="carousel-wrapper">
                <!-- Sách 1 -->
                <?php foreach ($top4 as $key): ?>
                    <div class="product-card">
                        <a href="?act=detail&id=<?php echo $key['id'] ?>" class="product-card-link">
                            <div class="product-img-container">
                                <img
                                    src="./assets/images/prod/books/<?php echo $key['img'] ?>"
                                    class="product-img-top"
                                    alt="<?php echo $key['name'] ?>"
                                >
                            </div>
                        </a>
                        <div class="product-card-body">
                            <h6 class="product-card-title"><?php echo $key['name'] ?></h6>
                            <p class="product-author text-success"><?php echo $key['author'] ?></p>
                            <div class="d-flex justify-content-between gap-4">
                                <p class="product-price text-danger font-weight-bold ">
                                <?php 
                                            $sale_price = $key['price'] - ($key['price'] * $key['sale'] / 100);
                                            $formatted_sale_price = number_format($sale_price, 0, ',', '.');
                                            echo $formatted_sale_price . 'đ'; 
                                        ?>
                                </p>
                                <p class="product-sale text-muted ">
                                    <del>
                                    <?php 
                                        $price = $key['price'];
                                        $formatted_price = number_format($price, 0, ',', '.');
                                        echo $formatted_price . 'đ'; 
                                    ?>
                                       
                                    </del>
                                    <span class="badge " style="color: white;"></style> >-<?php echo $key['sale'] ?>%</span>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <!-- <button class="carousel-btn right-btn">&#8250;</button> -->
    </div>
</section>






                    <hr>
                </div>
                </section>
            </div>
    </div>
    


   
    </main>

    <!-- Footer -->
    <?php require_once 'components/footer.php'; ?>

    </div>
    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Lấy phần tử ô vuông
        const box = document.querySelector('.rounded-box');

        // Hàm kiểm tra khi phần tử ô vuông xuất hiện trong khung nhìn
        function checkVisibility() {
            const rect = box.getBoundingClientRect();  // Lấy vị trí của phần tử
            const windowHeight = window.innerHeight;  // Chiều cao của cửa sổ trình duyệt

            // Kiểm tra nếu phần tử nằm trong vùng nhìn thấy
            if (rect.top >= 0 && rect.top <= windowHeight) {
                box.classList.add('visible');  // Thêm class để kích hoạt hiệu ứng
            }
        }

        // Gọi hàm khi cuộn trang
        window.addEventListener('scroll', checkVisibility);
        
        // Số lượng sản phẩm di chuyển mỗi lần
const itemsToMove = 4;

const leftBtn = document.querySelector('.left-btn');
const rightBtn = document.querySelector('.right-btn');
const carouselWrapper = document.querySelector('.carousel-wrapper');
const cards = document.querySelectorAll('.card');
const totalCards = cards.length;

let currentOffset = 0; // Theo dõi vị trí hiện tại của carousel

// Hàm cập nhật trạng thái của nút điều hướng
function updateButtonVisibility() {
    if (currentOffset === 0) {
        leftBtn.style.display = 'none'; // Ẩn nút trái khi đang ở đầu danh sách
    } else {
        leftBtn.style.display = 'block';
    }

    if (currentOffset >= totalCards - itemsToMove) {
        rightBtn.style.display = 'none'; // Ẩn nút phải khi đang ở cuối danh sách
    } else {
        rightBtn.style.display = 'block';
    }
}

// Hàm cuộn sang trái
leftBtn.addEventListener('click', function() {
    if (currentOffset > 0) {
        currentOffset -= itemsToMove;
        carouselWrapper.style.transform = `translateX(-${currentOffset * 220}px)`;  // 220px = chiều rộng của mỗi thẻ sản phẩm + margin
        updateButtonVisibility();
    }
});

// Hàm cuộn sang phải
rightBtn.addEventListener('click', function() {
    if (currentOffset < totalCards - itemsToMove) {
        currentOffset += itemsToMove;
        carouselWrapper.style.transform = `translateX(-${currentOffset * 150}px)`;  // 220px = chiều rộng của mỗi thẻ sản phẩm + margin
        updateButtonVisibility();
    }
});

// Khởi tạo trạng thái ban đầu của các nút điều hướng
updateButtonVisibility();


    </script>

</body>

</html>