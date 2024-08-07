<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <script src="https://kit.fontawesome.com/e21d90a16d.js" crossorigin="anonymous"></script>
    <script src="~/Scripts/jquery-3.7.1.js"></script>
    <script src="~/Scripts/jquery.validate.js"></script>
    <script src="~/Scripts/jquery.validate.unobtrusive.js"></script>
</head>

<body>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Tên Sản Phẩm</th>
                <th scope="col">Image</th>
                <th scope="col">Giá Bán</th>
                <th scope="col">Số Lượng </th>
                <th scope="col">Thành Tiền</th>
                <th scope="col">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @php
            $maKH = auth()->user()->khachhang->MaKH;
            $dathang = App\Models\DatHang::where('MaKH', $maKH)->with('chiTietDatHang.sanPham')->get();
            $stt = 0;
            @endphp

            @foreach ($dathang as $order)
            @if ($order->TinhTrang_DH == 'Chờ Xác Nhận Đơn' || $order->TinhTrang_DH=='Chờ Xác Nhận Hủy Đơn Hàng')
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
                <td>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                        data-bs-target="#cancelModal" data-orderid="{{ $order->MaDH }}"
                        {{ $order->TinhTrang_DH == 'Chờ Xác Nhận Hủy Đơn Hàng' ? 'disabled' : '' }}>
                        Hủy đơn hàng
                    </button>
                </td>
            </tr>
            @endforeach
            @endif
            @endforeach

        </tbody>
    </table>

    <!-- Modal -->
    <div class="modal fade" id="cancelModal" tabindex="-1" aria-labelledby="cancelModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cancelModalLabel">Chọn lý do hủy đơn hàng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="cancelForm" action="{{ route('huyDonHang') }}" method="POST">
                        @csrf
                        <input type="hidden" name="mahuy" id="orderID">
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="reason" id="reason1" value="Đặt nhầm sản phẩm">
                                <label class="form-check-label" for="reason1">
                                    Đặt nhầm sản phẩm
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="reason" id="reason2" value="Muốn thay đổi địa chỉ nhận hàng">
                                <label class="form-check-label" for="reason2">
                                   Muốn thay đổi địa chỉ nhận hàng
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="reason" id="reason3" value="Không muốn mua nữa">
                                <label class="form-check-label" for="reason3">
                                   Không muốn mua nữa 
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="reason" id="reason4" value="Muốn thay đổi số lượng">
                                <label class="form-check-label" for="reason4">
                                    Muốn thay đổi số lượng
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="reason" id="reason5" value="Lý do khác">
                                <label class="form-check-label" for="reason5">
                                    Lý do khác
                                </label>
                            </div>
                        </div>
                        <div class="mb-3" id="otherReasonContainer" style="display: none;">
                            <label for="otherReason" class="form-label">Nhập lý do hủy</label>
                            <input type="text" class="form-control" id="otherReason" name="otherReason">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            <button type="submit" class="btn btn-danger">Xác nhận hủy đơn hàng</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var cancelModal = document.getElementById('cancelModal');
            var otherReasonContainer = document.getElementById('otherReasonContainer');
            var reasonInputs = document.querySelectorAll('input[name="reason"]');

            cancelModal.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget;
                var orderID = button.getAttribute('data-orderid');
                var modalOrderIDInput = cancelModal.querySelector('#orderID');
                modalOrderIDInput.value = orderID;
            });

            reasonInputs.forEach(function (input) {
                input.addEventListener('change', function () {
                    if (input.value === 'Lý do khác') {
                        otherReasonContainer.style.display = 'block';
                    } else {
                        otherReasonContainer.style.display = 'none';
                    }
                });
            });
        });
    </script>
</body>

</html>
