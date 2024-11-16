<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Document</title>
     <link rel="stylesheet" href="styte/css/styte.css">
     <link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
     <?php require_once '../components/header.php' ?><hr>
     <div style="padding: 40px;" class="div bg-light">
     <div class="container ">
          <div style="display:flex;gap: 30px;" class="row">
               <div  class="col-9 bg-white">
                    <br><h4> Giỏ hàng</h4><hr>
                    <div class="row">
                         <div class="col-2">
                              <img src="../styte/img/logo.png" style="width: 100px; height:200px;" alt="">
                         </div>
                         <div class="col-6">
                              <a href="#">. Nguyên Tắc Lập Quốc - Những Tư Tưởng Căn Bản Của Các Nhà Lập Quốc Hoa Kỳ</a>
                              <p>Tac Gia : <a href="#">Thomas E. Ricks</a></p>
                              <p>Loại : Sách</p>
                              <p><a href="#" class="btn btn-danger">xoa</a></p>
                         </div>
                         <div class="col-2">193,500đ</div>
                         <div class="col-2">
                              
                         </div>
                    </div>
               </div>
               <div  class="col-2 bg-white text-center">
                    <?php ?> :<p>Sản Phẩm</p>
                    <?php ?> :<p>Sản Phẩm</p>
                    <p>(chưa có cước vận chuyển)</p>
                    <a style=" width:100% ; height: 40px; " class="btn btn-danger" href="3">Tiến Hành Đặt Hàng</a>
               </div>
          </div>

     </div>
     </div>

     <?php require_once '../components/footer.php' ?>
</body>
</html>