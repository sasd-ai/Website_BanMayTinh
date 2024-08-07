<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

    <script src="https://kit.fontawesome.com/e21d90a16d.js" crossorigin="anonymous"></script>
    <script src="~/Scripts//jquery-3.7.1.js"></script>
    <script src="~/Scripts/jquery.validate.js"></script>
    <script src="~/Scripts/jquery.validate.unobtrusive.js"></script>
</head>

<body>
    <!-- Trong file blade.php -->
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Tên Sản Phẩm</th>
                <th scope="col">Image</th>
                <th scope="col">Giá Bán</th>
                <th scope="col">Số Lượng </th>
                <th scope="col">Thành Tiền</th>
                <th scope="col">Thời Gian Bảo Hành</th>
            </tr>
        </thead>
        <tbody>
            @php
            $maKH = auth()->user()->khachhang->MaKH;
            $dathang = App\Models\DatHang::where('MaKH', $maKH)->with('chiTietDatHang.sanPham')->get();
            $stt = 0;
            @endphp

@foreach ($dathang as $order)
    @if ($order->TinhTrang_TT == 'Đã Thanh Toán' )
        @foreach ($order->chiTietDatHang as $detail)
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
        @endforeach

        <tr class="order-total">
            <th scope="col" colspan="3" style="color:red;">Ngày Đặt Hàng: </th>
            <td>
                <strong><span class="amount" style="color:red;">{{ $order->NgayDatHang }}</span></strong>
            </td>
        </tr>
        <tr>
            <tr class="order-total">
                <th scope="col" colspan="3" style="color:red;">Tổng Tiền: </th>
                <td>
                    <strong><span class="amount" style="color:red;">{{ number_format($order->TongTien) }}đ</span></strong>
                </td>
            </tr>
            <tr class="order-total">
                <th scope="col" colspan="3" style="color:red;">Tiền Khuyến Mãi: </th>
                <td>
                    <strong><span class="amount" style="color:red;">{{ number_format($order->TienKM) }}đ</span></strong>
                </td>
            </tr>
            <tr class="order-total">
                <th scope="col" colspan="3" style="color:red;">Tổng Tiền Thanh Toán : </th>
                <td>
                    <strong><span class="amount" style="color:red;">{{ number_format($order->ThanhTien) }}đ</span></strong>
                </td>
            </tr>
    @endif
@endforeach

        </tbody>
    </table>

</body>

</html>