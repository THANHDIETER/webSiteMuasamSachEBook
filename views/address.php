<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shipping Address Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <form action="?act=saveAddress" method="post" class="border p-4 rounded shadow-sm">
            <h2 class="mb-4">ĐỊA CHỈ GIAO HÀNG</h2>
            
            <div class="mb-3">
                <label for="name" class="form-label">Họ tên *</label>
                <input type="text" id="name" name="receiver" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email nhận đơn hàng *</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="district" class="form-label">Địa chỉ nhận hàng</label>
                <input type="text" id="address" name="delivery_address" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Di động *</label>
                <input type="tel" id="phone" name="phone_number" class="form-control" required pattern="[0-9]{10}">
            </div>
            <button type="submit" class="btn btn-warning w-100">Giao đến địa chỉ này</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
   
       
       </body>
       </html>