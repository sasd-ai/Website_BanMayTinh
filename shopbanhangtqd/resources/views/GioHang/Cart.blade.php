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
<style>
    .nav-pills .nav-link.active,
    .nav-pills .show>.nav-link {
        color: white;
        background-color: #DF042A;
    }

    .nav-link:focus,
    .nav-link:hover {
        color: #DF042A;
    }

    .nav-pills .nav-link {
        border-radius: 0px;
    }

    .nav-link {
        color: black;
    }
</style>

<body>
@include('Shared/Header')
    <!-- hộp thông báo lỗi -->
    <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="errorModalLabel">Thông báo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Vui lòng chọn ít nhất một sản phẩm để thanh toán.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
    @if (auth()->check()) 
    
        @if ($cartItems->isEmpty())
        <p style="text-align:center">Giỏ hàng của bạn đang trống!!!</p>
    
        @else
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">STT</th>
                    <th scope="col">#</th>
                    <th scope="col">Tên Sản Phẩm</th>
                    <th scope="col">Ảnh</th>
                    <th scope="col">Giá Tiền</th>
                    <th scope="col">Số Lượng</th>
                    <th scope="col">Tổng cộng</th>
                    <th scope="col">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cartItems as $index => $item)
                <tr>
                    <th scope="row">{{ $index + 1 }}</th>
                    <td><input type="checkbox" name="selected_items[]" value="{{ $item->sanPham['MaSP'] }}"></td>
                    <td>{{ $item->sanPham->TenSP }}</td>
                    <td><img src="{{ asset($item->sanPham->HinhAnh) }}" alt="{{ $item->sanPham->TenSP }}"
                            height="100px;"></td>
                    <td>{{ number_format($item->sanPham->GiaBan, 0) }} đ</td>
                    <td>
                        <form action="{{ route('cart.update',['MaGH' => $item->MaGH, 'MaSP' => $item->MaSP]) }}"
                            method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="number" name="quantity" value="{{ $item->SoLuong }}" min="1"
                                class="form-control">
                            <button type="submit" class="btn btn-primary mt-2">Cập nhật</button>
                        </form>
                    </td>
                    <td>{{ number_format($item->SoLuong * $item->sanPham->GiaBan, 0) }} đ</td>
                    <td>
                        <form action="{{ route('cart.delete',['MaGH' => $item->MaGH, 'MaSP' => $item->MaSP]) }}"
                            method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Xóa</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" style="font-weight: bold">Tổng Tiền:</td>
                    <td colspan="2" style="color: red; font-size: 16px;">{{ number_format($grandTotal, 0) }} đ</td>
                    <td>
                        <form action="{{route('ThanhToan')}}" method="POST">
                            @csrf
                            <input type="hidden" id="selectedItemsInput" name="selectedItems" value="">
                            <button type="submit" id="buyNowButton" class="btn btn-success">Mua Ngay</button>
                        </form>
                    </td>
                </tr>
            </tfoot>
        </table>
        @endif
        @else
            <p style="text-align:center">Vui lòng đăng nhập để xem giỏ hàng.</p>
        @endif
    </div>
@include('Shared/Footer')
    
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            var checkboxes = $('input[name="selected_items[]"]');

            checkboxes.change(function () {
                var selectedItems = checkboxes.filter(':checked').map(function () {
                    return this.value;
                }).get();

                $('#selectedItemsInput').val(selectedItems.join(','));
            });

            $('#buyNowButton').click(function (event) {
                if ($('#selectedItemsInput').val().length === 0) {
                    event.preventDefault(); 
                    $('#errorModal').modal('show'); 
                }
            });
        });
    </script>
</html>