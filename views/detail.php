<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết sản phẩm</title>
    <link rel="stylesheet" href="styte/css/styte.css">
     <link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</head>
<body >
    <?php require_once './components/header.php' ?><hr>
    <div class="bg-light">
    <div style="display: grid; gap:40px;"  class="container  ">
    <br><p class="wrapper">Trang chi tiết sản phẩm </p>
    <?php foreach($productOne as $name): ?>
      <form action="?act=addToCart" method="POST">
    <div class="row bg-white">
    <div class="col-4">
    <img style=" max-width:100%;" class="" src="./assets/images/prod/books/<?php echo $name['img'] ?>" class="top-pro-img" alt="">
    </div>
    
    <div class="col-8">
   
    <input type="hidden" name="id" value="<?php echo $name['id']; ?>">
    <h2><?php echo $name['name']; ?></h2>
    <p><?php echo $name['author']; ?> (Tác giả)</p><br>
    
    <h3><del>Giá thị trường: 
        <?php 
        $price = $name['price'];
        $formatted_price = number_format($price, 0, ',', '.'); 
        echo $formatted_price . 'đ';
        ?>
    </del></h3>

    <h3 class="text-danger">Sale còn: 
        <?php  
        $price = $name['price'] - ($name['price']/100) * $name['sale'];
        $formatted_price = number_format($price, 0, ',', '.'); 
        echo $formatted_price . 'đ';
        ?>
    </h3>

    <p class="text-warning">Tiết kiệm: 
        <?php  
        $price = ($name['price']/100) * $name['sale'];
        $formatted_price = number_format($price, 0, ',', '.'); 
        echo $formatted_price . 'đ';
        ?> 
        (<?php echo $name['sale']; ?>%)
    </p>

    <p class="TINHTRANG">
        Tình trạng: 
        <?php 
        if($name['quantity'] > 0) {
            echo 'còn ' . $name['quantity'] . ' sản phẩm';
        } else {
            echo "sắp có hàng";
        } 
        ?>
    </p>

    <p class="tags"><?php echo $name['name']; ?></p>

    <label for="variant-select"><strong>Chọn biến thể:</strong></label>
    <select name="variant_id" id="variant-select" class="form-control" required>
        <?php foreach($variants as $variant): ?>
            <option value="<?php echo $variant['id']; ?>">
                Định dạng: <?php echo $variant['format']; ?> | Ngôn ngữ: <?php echo $variant['language']; ?> | Phiên bản: <?php echo $variant['edition']; ?> | Giá: <?php echo number_format($variant['price'], 0, ',', '.'); ?>đ
            </option>
        <?php endforeach; ?>
    </select><br>

    <button type="submit" class="btn btn-danger" style="width: 200px; height:40px; background-color:red; ">
        Thêm vào giỏ hàng
    </button>
</form>


                
    </div>
   <div class="box">
            <h3>Thông tin & Khuyến mãi </h3>   <p>Gọi đặt hàng: 0972.150.772 hoặc: 0972.150.772</p>
            <p>Đổi trả hàng trong vòng 7 ngày
                Sử dụng mỗi 3.000 BBxu để được giảm 10.000đ. Freeship nội thành Sài Gòn từ 150.000đ*.  Chi tiết tại đây Freeship toàn quốc từ 250.000đ</p>
   </div>
  </div>
    <div class="row">
        <div class="col-9">
        <div class="table ">
        <table class="table table-striped-columns">
        <th>THÔNG TIN CHI TIẾT</th><br>
        <td>Nhà xuất bản: <?php echo $name['name'] ?></td>
        <td>Ngày xuất bản: 16/11/2024</td>
        <td>Nhà phát hành: Nhã Nam</td>
        <td>Kích thước: 15.5 x 24.0 x 2.0 cm</td>
        <td>Số trang: ... trang</td>
        <td>Trọng lượng: 600 gram </td>
        </table><br>
        <div style="padding: 20px; min-height:600px" class="table2 bg-white">
          <br>    
            <h2>Giới thiệu sản phẩm:</h2>
            <h2><?php echo $name['name'] ?></h2>
            <P><?php echo $name['description'] ?></P>
                <p><a href="?act=/">Mua sách online tại EBOok.vn và nhận nhiều ưu đãi.</a></p>
        </div>
        </div>
        <?php  endforeach; ?>
        </div>
        
        <div  class="col-3 bg-white;">
            
        <aside class="bg-white text-center" style=" max-width:100%; display:grid;  padding:20px; ">
        <h3>sản phẩm bán chạy</h3><hr>
        <button class="btn btn-primary w-100" id="scrollUp">▲</button>
        <div class="overflow-hidden" style="height: 540px;" id="bookList">
            <div class="d-flex p-2 border-bottom"></div>
                    <?php foreach($top8 as $key): ?>
                            <div class="text-center" >
                                <a class="bg-white nav-link" href="?act=detail&id=<?php echo $key['id'] ?>"></a>
                                <img style="max-width:100%"  src="./assets/images/prod/books/<?php echo $key['img'] ?>" alt=""></a>
                                <a class="bg-white nav-link" href="?act=detail&id=<?php echo $key['id'] ?>"><?php echo $key['name'] ?></a>
                                <p style="color:red;"><?php 
                                $price=$key['price']-($key['price']/100)*$key['sale'];
                                $formatted_price = number_format($price, 0, ',', '.'); 
                                echo $formatted_price . 'đ';
                                ?>
                            </div>
                    <?php  endforeach; ?>
                
            </div>
            <button class="btn btn-primary w-100" id="scrollDown">▼</button>
            </div>
           
    </aside>
        </div>
       
        </div>
    <div class="container my-4 bg-white ">
        
        <div class="position-relative">
        <h5 class="mb-3">Sản phẩm cùng loại</h5>
            <!-- Danh sách sản phẩm -->
            <div class="d-flex overflow-hidden" id="productContainer" style="scroll-behavior: smooth;">
            <?php foreach($top8 as $key): ?>
                <a class="bg-white nav-link" href="?act=detail&id=<?php echo $key['id'] ?>">
                <div class="card me-3" style="width: 200px;">
                    <img src="./assets/images/prod/books/<?php echo $key['img'] ?>" class="card-img-top" alt="Book 1">
                    <div class="card-body text-center">
                        <p class="card-title fw-bold mb-1"><?php echo $key['name'] ?></p>
                        <p class="text-danger">
                        <?php
                          $price=$key['price']-($key['price']/100)*$key['sale'];
                          $formatted_price = number_format($price, 0, ',', '.'); 
                          echo $formatted_price . 'đ';
                          ?>
                    </div>
                </div>
                </a>
                <?php  endforeach; ?>
                
            </div>
        </div>
    </div>
    <div class="container mt-5">
         <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span id="comment-count">0 bình luận</span>
            <div class="dropdown">
                <button class="btn btn-light btn-sm dropdown-toggle" type="button" id="sortComments" data-bs-toggle="dropdown" aria-expanded="false">
                    Sắp xếp theo
                </button>
                <ul class="dropdown-menu" aria-labelledby="sortComments">
                    <li><a class="dropdown-item" href="?action=sort&order=newest">Mới nhất</a></li>
                    <li><a class="dropdown-item" href="?action=sort&order=oldest">Cũ nhất</a></li>
                </ul>
            </div>
        </div>
<section style="background-color: #eee;">
  <div class="container my-5 py-5">
    <div class="row d-flex justify-content-center">
      <div class="col-md-12 col-lg-10 col-xl-8">
        <div class="card">
    </div>            
    </div>
    <?php foreach ($cmt as $key) { ?>
          <div class="card-body">
            <div class="d-flex flex-start align-items-center">
              <img class="rounded-circle shadow-1-strong me-3"
                src="https://lms.languagehub.vn/store/1/default_images/default_profile.jpg" alt="avatar" width="60"
                height="60" />
              <div>
                <h6 class="fw-bold text-primary mb-1"><?php ?></h6>
                <p class="text-muted small mb-0">
                <?php echo $key['created_at'] ?>
                </p>
              </div>
            </div>
            <p class="mt-3 mb-4 pb-2">
                <?php echo $key['content'] ?>
            </p>
           
            <div class="small d-flex justify-content-start">
              <a href="#!" class="d-flex align-items-center me-3">
                <i class="far fa-thumbs-up me-2"></i>
                <p class="mb-0">Like</p>
              </a>
              <a href="#!" class="d-flex align-items-center me-3">
                <i class="far fa-comment-dots me-2"></i>
                <p class="mb-0">Comment</p>
              </a>
              <a href="#!" class="d-flex align-items-center me-3">
                <i class="fas fa-share me-2"></i>
                <p class="mb-0">Share</p>
              </a>
              </div>
              </div>
          <?php } ?>
          <!-- Phần form bình luận -->
           <form method="post">
           <div class="d-flex justify-content-center mt-2 pt-1">
            <button  name="submit" class="btn btn-outline-primary">show all</button>
            </div>
          </form>
          <form method="post">
            <div class="card-footer py-3 border-0" style="background-color: #f8f9fa;">
              <div class="d-flex flex-start w-100">
                <img class="rounded-circle shadow-1-strong me-3"
                  src="https://lms.languagehub.vn/store/1/default_images/default_profile.jpg" alt="avatar" width="40"
                  height="40" />
                <div class="form-outline w-100">
                  <textarea class="form-control" name="comment" rows="4" placeholder="Bình luận..." style="background: #fff;" ></textarea>
                  <label class="form-label" for="textAreaExample">Message</label>
                </div>
              </div>
              <div class="float-end mt-2 pt-1">
                <button type="submit" name="btn_submit" class="btn btn-primary btn-sm">Post comment</button>
                <button type="reset" class="btn btn-outline-primary btn-sm">Cancel</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
    </div>
</div>
          
    <br>
    <script>
        const scrollUpBtn = document.getElementById('scrollUp');
        const scrollDownBtn = document.getElementById('scrollDown');
        const bookList = document.getElementById('bookList');

        scrollUpBtn.addEventListener('click', () => {
            bookList.scrollBy({ top: -100, behavior: 'smooth' });
        });

        scrollDownBtn.addEventListener('click', () => {
            bookList.scrollBy({ top: 100, behavior: 'smooth' });
        });
       
    </script>
    
   
    <?php require_once './components/footer.php' ?>
</body>
</html>
