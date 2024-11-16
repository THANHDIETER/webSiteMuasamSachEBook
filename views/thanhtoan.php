<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Page</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .header, .footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px 0;
        }
        .button {
            background-color: #eb5e28;
            color: white;
            border: none;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Bookbuy.vn</h1>
    </div>
    <div class="container my-4">
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header">
                        PHƯƠNG THỨC VẬN CHUYỂN
                    </div>
                    <div class="card-body">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="shipping" id="regular" value="regular">
                            <label class="form-check-label" for="regular">Chuyển thường</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="shipping" id="fast" value="fast">
                            <label class="form-check-label" for="fast">Chuyển nhanh</label>
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">
                        PHƯƠNG THỨC THANH TOÁN
                    </div>
                    <div class="card-body">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="payment" id="atm" value="atm">
                            <label class="form-check-label" for="atm">Thẻ ATM đăng ký Internet Banking (miễn phí thanh toán)</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="payment" id="electronic" value="electronic">
                            <label class="form-check-label" for="electronic">Ví điện tử</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="payment" id="bank" value="bank">
                            <label class="form-check-label" for="bank">Chuyển khoản ngân hàng</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="payment" id="cod" value="cod">
                            <label class="form-check-label" for="cod">Thanh toán tiền mặt khi nhận hàng (COD)</label>
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">
                        THÔNG TIN KHÁC
                    </div>
                    <div class="card-body">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="gift">
                            <label class="form-check-label" for="gift">Gói thành quà</label>
                        </div>
                        <textarea class="form-control my-2" placeholder="Ghi chú cho Bookbuy" rows="4"></textarea>
                        <select class="form-control my-2">
                            <option>Mã giảm giá / ưu đãi BookBuy</option>
                        </select>
                        <input type="text" class="form-control my-2" placeholder="Nhập mã giảm giá">
                        <button class="btn button">Áp dụng</button>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header">
                        Giao hàng đến
                    </div>
                    <div class="card-body">
                        <p>Nguyễn Văn Thành<br>sads, Phúc Thọ, Hà Nội, Việt Nam<br>0972150772 - thanh@gmail.com</p>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">
                        Đơn hàng (1 sản phẩm)
                    </div>
                    <div class="card-body">
                        <p>1 x Nguyễn Tất Lập Quốc - Những Tư Tưởng Căn Bản Của Các Nhà Lập Quốc Hoa Kỳ<br>193,500₫</p>
                        <p>Tiền hàng: 193,500₫</p>
                        <p>Phí vận chuyển: chưa có</p>
                        <h5>Tổng cộng: 193,500₫</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center my-4">
            <button class="btn button btn-lg">Đặt mua</button>
        </div>
    </div>
    <div class="footer">
        <p>Hotline: 0933 109 009</p>
    </div>
</body>
</html>