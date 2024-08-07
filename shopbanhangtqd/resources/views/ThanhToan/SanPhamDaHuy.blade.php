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
             
            </tr>
        </thead>
        <tbody>
            @php
            $maKH = auth()->user()->khachhang->MaKH;
            $dathang = App\Models\DatHang::where('MaKH', $maKH)->with('chiTietDatHang.sanPham')->get();
            $stt = 0;
            @endphp

@foreach ($dathang as $order)
    @if ($order->TinhTrang_DH == 'Đã Hủy Đơn Hàng')
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
              
            </tr>
        @endforeach

        
    @endif
@endforeach

        </tbody>
    </table>

</body>

</html>