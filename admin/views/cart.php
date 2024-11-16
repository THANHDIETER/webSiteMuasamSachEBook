<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nhà sách Thanh Hà</title>
    <!-- link font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <!-- link font roboto -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <!-- link css -->
    <link rel="stylesheet" href="assets/stytes/general.css">
    <link rel="stylesheet" href="assets/stytes/prod.css">
    <link rel="stylesheet" href="assets/stytes/footer.css">
</head>
<body>
<?php require_once 'components/header.php' ?>
    <div class="container" style="background-color: white; margin-bottom:30px">
    <main>
    <section style="min-height:800px ;">
    
    <?php
        foreach ($product as $products):
    ?>
    <?php
        echo $products['order_id'];
    ?>
<?php
        endforeach;
    ?>
</section>
    </main>
    
    </div>
        <?php require_once 'components/footer.php' ?>
        
</body>
</html>