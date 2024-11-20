+
.<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</head>

<body>
     <?php require_once './components/header.php' ?>
    <hr>
    
    <div style="padding-top: 30px;" class="div bg-light ">
    <div class="container mt-5 bg-white">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
          <br>
            <ol class="breadcrumb">
               
                <li class="breadcrumb-item active"><a class="nav-link" href="#"> Sách - Truyện tranh</a></li>
                <li class="breadcrumb-item active" aria-current="page">Văn học</li>
            </ol>
        </nav>

        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3">
                <div class="border p-3 mb-4">
                    <h5 class="font-weight-bold text-danger">Danh mục</h5>
                    <ul class="list-unstyled">
                    <?php foreach($danhmucs as $key): ?>
                        <li><a href="?act=dmid&id=<?=$key['id'] ?>" class=" nav-link btn-primary"><?php echo $key['name'] ?></a> </li>
                        <?php  endforeach; ?>
                    </ul>
                </div>

                <!-- <div class="border p-3">
                    <h5 class="font-weight-bold">Tìm theo</h5>
                    <h6 class="text-muted">Chủ đề</h6>
                    <ul class="list-unstyled">
                        <li><a href="#">Bước vào agency Quảng cáo & Truyền thông</a></li>
                        <li><a href="#">Biên cương Việt Nam</a></li>
                        <li><a href="#">Đam mê xê dịch</a></li>
                        <li><a href="#">Giải thưởng Sách Hay</a></li>
                        <li><a href="#">Hạt giống tâm hồn</a></li>
                        <li><a href="#">Ngày của mẹ</a></li>
                        <li><a href="#">Sách Giáng Sinh</a></li>

                    </ul>
                </div> -->
            </div>

            <!-- Product List -->
            <div class="col-md-9">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="font-weight-bold"> SACH</h5>
                    <div>
                        <select class="form-control d-inline-block w-auto mr-2">
                            <option>Sản phẩm bán chạy</option>
                            <option>Sản phẩm mới</option>
                        </select>
                        <select class="form-control d-inline-block w-auto">
                            <option>20 sản phẩm</option>
                            <option>30 sản phẩm</option>
                        </select>
                    </div>
                </div>

                <div class="row">   
                    <!-- Product Item -->
                     <?php foreach($dmuc as $ke): ?>
                    <div class="col-md-3 mb-3">
                        <div class="card">
                            <input type="hidden" name="" value="<?php echo $ke['category_id'] ?>" id="">
                            <img style=" height:280px;  padding: 20px; "  src="./assets/images/prod/books/<?php echo $ke['img'] ?>" class="card-img-top" alt="Về Đi Con - Bìa Cứng">
                            <div class="card-body"> 
                                <h6 class="card-title"><?php echo $ke['name'] ?></h6>
                                <p class="text-success"><?php echo $ke['author'] ?></p>
                                <div class="d-flex justify-content-between">
                                    <p class="text-danger font-weight-bold"><?php $price=$ke['price']-($ke['price']/100)*$ke['sale'];
                                    $formatted_price = number_format($price, 0, ',', '.'); 
                                    echo $formatted_price . 'đ'; ?></p>
                                    <p class="text-muted"><del><?php  $price= $ke['price'];
                                    $formatted_price = number_format($price, 0, ',', '.'); 
                                    echo $formatted_price . 'đ';
                                    ?></del> <span
                                            class="badge badge-danger">-<?php echo $ke['sale'] ?>%</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php  endforeach; ?>
                    

                </div>
            </div>
        </div>
    </div>
    </div>
    <?php require_once './components/footer.php' ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>


</html>