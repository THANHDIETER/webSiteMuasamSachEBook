<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý đơn hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <h1 class="text-center mb-4">Quản lý đơn hàng</h1>

        <!-- Table for Orders -->
        <h3 class="mb-3">Danh sách đơn hàng</h3>
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Tên khách hàng</th>
                    <th>Số điện thoại</th>
                    <th>Địa chỉ</th>
                    <th>Email</th>
                    <th>Thanh toán</th>
                    <th>Trạng thái</th>
                    <th>Chi tiết</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Nguyễn Văn A</td>
                    <td>0123456789</td>
                    <td>123 Đường ABC, Quận X, TP.HCM</td>
                    <td>nguyenvana@gmail.com</td>
                    <td>COD</td>
                    <td>Đang xử lý</td>
                    <td><button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#orderDetailsModal">Xem</button></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Trần Thị B</td>
                    <td>0987654321</td>
                    <td>456 Đường XYZ, Quận Y, Hà Nội</td>
                    <td>tranthib@gmail.com</td>
                    <td>Chuyển khoản</td>
                    <td>Hoàn thành</td>
                    <td><button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#orderDetailsModal">Xem</button></td>
                </tr>
            </tbody>
        </table>

        <!-- Modal for Order Details -->
        <div class="modal fade" id="orderDetailsModal" tabindex="-1" aria-labelledby="orderDetailsModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="orderDetailsModalLabel">Chi tiết đơn hàng</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Order Details -->
                        <h6>Thông tin khách hàng</h6>
                        <p><strong>Tên:</strong> Nguyễn Văn A</p>
                        <p><strong>Số điện thoại:</strong> 0123456789</p>
                        <p><strong>Địa chỉ:</strong> 123 Đường ABC, Quận X, TP.HCM</p>

                        <!-- Table for Products -->
                        <h6 class="mt-4">Danh sách sản phẩm</h6>
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Giá</th>
                                    <th>Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Sản phẩm 1</td>
                                    <td>2</td>
                                    <td>100,000 VND</td>
                                    <td>200,000 VND</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Sản phẩm 2</td>
                                    <td>1</td>
                                    <td>300,000 VND</td>
                                    <td>300,000 VND</td>
                                </tr>
                            </tbody>
                        </table>

                        <h6 class="text-end">Tổng cộng: <strong>500,000 VND</strong></h6>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
