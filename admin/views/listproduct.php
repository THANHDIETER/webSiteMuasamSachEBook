<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nhà sách DIETE</title>
    
     
     <link rel="stylesheet" href="../assets/stytes/footer.css"> 
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <!-- link font roboto -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>
<body>
<?php require_once 'components/header.php' ?>
    <div class="container">
    <div id="wrapper">
    

    <section>
    <table border="1px">
    
    
    <?php foreach($allProduct as $key): ?>
    <div class="box">
        <div class="anh1"><img src="../assets/images/prod/books/<?php echo $key['image_book'] ?>" alt="Book Image"></div>
        <div class="box1">
        <div class="id"><h2><?php echo $key['book_id'] ?></h2></div>
        <div class="name"><h1><?php echo $key['title'] ?></h1></div>
        <div class="col-2"><h3>Tac giả: <?php echo $key['author'] ?></h3></div>
        <div class="dox"> <h3 style="font-size:30px;"><?php echo $key['description'] ?></h3> </div>
        <div class="col-2"> <h3>Thể loại: <?php echo $key['theloai'] ?></h3></div>
        <div class="detail">
        
        <h3> Số lượng:  <?php echo $key['stock_quantity'] ?></h3>
        <del id="number" cla="number"> Giá:<?php echo $formattedPrice = number_format($key['price'], 0, ',', '.'); ?></del><br>
        
        </div>
        <div class="col-2"><a href="?act=update&id=<?=$key['book_id'] ?>"><button>Sửa</button></a><a href="?act=delete&id=<?php echo urlencode($key['book_id']) ?>" onclick="return confirmDelete()">
        <button style="background-color: red;">Xóa</button></a></div>
        

        
    </div>
    </div>
      
        
    <script>
function confirmDelete() {
    return confirm('bạn xác nhận xóa sản phẩm này!');
}
</script>
    <?php endforeach; ?>
</table>
        


    </section>
        
       
       
    </div>

    
    </div>
    <?php require_once 'components/footer.php' ?>
</body>
</html>