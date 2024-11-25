<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Them NXB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../assets/stytes/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <!-- link font roboto -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>

<body>

    <div class="main-content">
        <div class="container">
            <h1 class="fw-bold text-center mt-5">Thêm nhà xuất bản</h1>
            <br><br>
            <form action="" enctype="multipart/form-data" method="post">
                <div class="form-group">
                    <label>Tên nhà xuất bản</label>
                    <input class="form-control" type="text" name="name" placeholder="Nhập tên nhà xuất bản" ?>
                    <?php if (isset($errors['name'])) { ?>
                        <p class="text-danger"><?= $errors['name'] ?></p>
                    <?php } ?>
                </div><br>

                <input type="submit" name="btn_insert" id="" value="Thêm nhà xuất bản" style="width: 200px; "
                    class="btn btn-primary">
            </form>

        </div>
    </div>

</body>

</html>