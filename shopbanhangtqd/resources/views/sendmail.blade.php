<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            width: 80%;
            max-width: 700px;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
            font-size: 24px;
        }

        h3 {
            color: #333;
            margin-top: 30px;
            font-size: 20px;
        }

        p {
            color: #555;
            line-height: 1.6;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            border: 1px solid #ddd;
        }

        th, td {
            text-align: left;
            padding: 10px;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
            text-transform: uppercase;
        }

        img {
            max-width: 100px;
            height: auto;
            margin-right: 10px;
        }

        .order-total {
            display: flex; 
            justify-content: space-between; 
            margin-top: 20px;
        }

        .order-total-item {
            display: flex; 
            align-items: center;
            margin-bottom: 10px;
        }

        .order-total-item label {
            font-weight: bold;
            margin-right: 10px;
        }

        .amount {
            color: #e74c3c; 
            font-size: 18px;
        }

        .order-info {
            margin-bottom: 20px;
        }

        .order-info p {
            margin-bottom: 5px;
        }

        .button-container {
            text-align: center;
            margin-top: 20px;
        }

        .button-container a {
            background-color: #2ecc71;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .button-container a:hover {
            background-color: #16a085; 
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Đơn Hàng Đã Thanh Toán</h2>
        <div class="order-info">
            <h3>Thông Tin Khách Hành</h3>
            <p>Mã đơn hàng: {{ $maDH }}</p>
            <p>Ngày Đặt Hàng: {{ $datHang->NgayDatHang }}</p>
            <p>Địa Chỉ Giao Hàng: {{ $datHang->DiaChi }}</p>
            <p>Tên Người Nhận: {{ $datHang->TenKH }}</p>
            <p>Số Điện Thoại: {{ $datHang->SDT }}</p>
            <p>Ghi Chú: {{ $datHang->GhiChu }}</p>
            <p>Tình Trạng Thanh Toán: {{ $datHang->TinhTrang_TT }}</p>
        </div>

        <h3>Thông Tin Đơn Hàng</h3>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tên Sản Phẩm</th>
                    <th>Image</th>
                    <th>Giá Bán</th>
                    <th>Số Lượng</th>
                    <th>Thành Tiền</th>
                    <th>Thời Gian Bảo Hành</th>
                </tr>
            </thead>
            <tbody>
                @php $stt = 0; $tongTien = 0; @endphp
                @foreach ($orderDetails as $detail)
                    <tr>
                        <td>{{ ++$stt }}</td>
                        <td>{{ $detail->sanPham->TenSP }}</td>
                        <td>
                            <img src="{{ asset($detail->sanPham->HinhAnh) }}" alt="{{ $detail->sanPham->TenSP }}"
                                height="100px;" />
                        </td>
                        <td>{{ number_format($detail->sanPham->GiaBan) }}</td>
                        <td>{{ $detail->SoLuong }}</td>
                        <td>{{ number_format($detail->ThanhTien) }}</td>
                        <td>{{ $detail->TinhTrang_BH }}</td>
                    </tr>
                    @php $tongTien += $detail->ThanhTien; @endphp
                @endforeach
            </tbody>
        </table>
        <div class="order-total">
    <table>
        <tr>
            <th colspan="5">Tổng Tiền:</th>
            <td>
                <strong><span class="amount">{{ number_format($tongTien) }}đ</span></strong>
            </td>
        </tr>
        <tr>
            <th colspan="5">Khuyến Mãi:</th>
            <td>
                <strong><span class="amount">{{ number_format($datHang->TienKM) }}đ</span></strong>
            </td>
        </tr>
        <tr>
            <th colspan="5">Tổng Tiền Thanh Toán:</th>
            <td>
                <strong><span class="amount">{{ number_format($datHang->ThanhTien) }}đ</span></strong>
            </td>
        </tr>
    </table>
</div>
        <h2>CẢM ƠN QUÝ KHÁCH ĐÃ MUA HÀNG!!!</h2>
    </div>
</body>
</html>