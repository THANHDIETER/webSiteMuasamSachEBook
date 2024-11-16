<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>them san pham</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
     <link rel="stylesheet" href="../assets/stytes/footer.css"> 
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <!-- link font roboto -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>
<body>
<?php require_once 'components/header.php' ?>
<div class="container"> 

        <br><br>
    <form action="" enctype="multipart/form-data" method="post">
                <input type="hidden" name="id" value="<?= $Product['book_id'] ?>" id="">
          <div class="form-group">
                  <label>Tiêu đề sách</label>
                  <input class="form-control" value="<?= $Product['title'] ?>" type="text" name="title" ?>
          </div><br>
          <div class="form-group">
                  <label for=>image sach</label>
                  <img src="../assets/images/prod/books/<?php echo $Product['image_book'] ?>" alt="">
                  <input class="form-control" value="<?= $Product['image_book'] ?>" type="file" name="img" ?>
          </div><br>
          <div class="form-group">
                  <label>Tác giả</label>
                  <input class="form-control" value="<?= $Product['author'] ?>" type="text" name="author" ?>
          </div><br>
          <div class="form-group">
                  <label>Mô tả</label><br>
                  <?= htmlspecialchars($Product['description']) ?>
                  <textarea class="form-control" value="<?= $Product['description'] ?>"  name="description" ></textarea>
                  
          </div><br>
          <div class="form-group">
                  <label for="exampleFormControlSelect2">Thể loại</label>
                  <select multiple  class="form-control" value="<?= $Product['genre_id'] ?>"  type="text" id="genre_id" name="genre_id">
                        <option value="1">Novel</option>
                        <option value="2">Short Story</option>
                        <option value="3">Poetry</option>
                        <option value="4">Drama</option>
                        <option value="5">Autobiography </option>
                        <option value="6">Biography</option>
                        <option value="7">History</option>
                        <option value="8">Science</option>
                        <option value="9">Business</option>
                        <option value="10">Psychology</option>
                        <option value="11">Self-help</option>
                        <option value="12">Fairy Tales</option>
                        <option value="13">Educational Stories</option>
                        <option value="14">Fantasy</option>
                        <option value="15">Science Fiction</option>
                        <option value="16">Epic Fantasy</option>
                        <option value="17">Mystery</option>
                        <option value="18">Romance</option>
                        <option value="19">Family Romance</option>
                        <option value="20">Friendship</option>
                        <option value="21">Horror</option>
                        <option value="22">Detective</option>
                        <option value="23">Thriller</option>
                        <option value="24">Music</option>
                        <option value="25">Cinema</option>
                  </select>
          </div><br>
          <div class="form-group">
                  <label>Giá</label>
                  <input class="form-control" placeholder=" <?php echo $formattedPrice = number_format($Product['price'], 0, ',', '.'); ?>" value=" <?php
                      $Product['price']
                  ?>" type="text" name="price" ?>
          </div><br>
          <div class="form-group">
                  <label>Số lượng tồn kho</label>
                  <input  class="form-control" value="<?= $Product['stock_quantity'] ?>" type="text" name="stock_quantity" ?>
          </div><br>
          <div class="form-group">
                  <label>Ngày xuất bản</label>
                  <input class="form-control" value="<?= $Product['published_date'] ?>" type="date" name="published_date" ?>
          </div><br>
          <input type="submit" name="btn_update" id="" value="UPDATE PRODUCT" style="width: 200px; ">
     </form>
     
    </div>
    <?php require_once 'components/footer.php' ?>
</body>
</html>