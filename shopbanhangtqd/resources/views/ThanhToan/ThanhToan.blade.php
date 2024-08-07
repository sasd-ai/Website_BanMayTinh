<!DOCTYPE html>

<html>

<head>
    <meta name="viewport" content="width=device-width" />
    <link rel="icon" href="{{ asset('Image/Icon/logo.jpg') }}" type="image/x-icon">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

    <script src="https://kit.fontawesome.com/e21d90a16d.js" crossorigin="anonymous"></script>
    <script src="~/Scripts//jquery-3.7.1.js"></script>
    <script src="~/Scripts/jquery.validate.js"></script>
    <script src="~/Scripts/jquery.validate.unobtrusive.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Thêm các liên kết CSS và JS cho Select2 -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>


</head>
<style>
    .order-button-payment button {
        text-align: center !important;
        margin-top: 15px;
        font-weight: bold;
    }

    .order-button-payment button {
        background-color: black;
        color: white;
        border: none;
        padding: 10px;
        cursor: pointer;
        transition: background-color 0.3s;
        width: 100%;
    }

    .order-button-payment button:hover {
        background-color: deeppink;
    }
</style>
<style>
    label {
        font-family: Arial, sans-serif;
        font-size: 16px;
        color: #333;
        margin-top: 20px;
    }

    .form-control {
        width: 100%;
        padding: 10px;
        font-size: 14px;
        border-radius: 5px;
        border: 2px solid #ddd;
        margin-top: 10px;
    }

    .form-control:focus {
        border-color: #4CAF50;
        box-shadow: none;
    }

    select.form-control {
        height: 50px;
        color: #555;
    }

    select.form-control option {
        padding: 10px;
    }

    #khuyenMaiSelect {
  position: relative;
  padding-left: 40px; /* Điều chỉnh khoảng cách cho ảnh */
}

#khuyenMaiSelect option {
  display: flex;
  align-items: center; /* Căn chỉnh các phần tử theo chiều dọc */
  padding-left: 40px; /* Điều chỉnh khoảng cách cho ảnh */
}

#khuyenMaiSelect option::before {
  content: '';
  width: 20px; /* Điều chỉnh kích thước ảnh */
  height: 20px;
  background-image: url("{{ asset('Image/Icon/km.webp') }}");
  background-size: cover;
  background-repeat: no-repeat;
  margin-right: 10px; /* Điều chỉnh khoảng cách giữa ảnh và text */
}
</style>

<body>

    <!-- Headerd -->
    @include('Shared/Header')

    <div class="checkout-area mt-no-text">
        <div class="container custom-container">
            <div class="row">
                <div class="col-lg-6 col-12 col-custom">
                    <form method="POST" id="payment-form" >
                        @csrf
                        <div class="checkbox-form">
                            <h3 style="text-align:center!important; text-transform:uppercase!important;">
                                Chi tiết thanh toán
                            </h3>

                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name">Tên khách hàng</label>
                                    <input type="text" class="form-control" id="name" name="customerNameReceive"
                                        placeholder="CustomerNameReceive">
                                    <div>{{ $errors->first('customerNameReceive') }}</div>
                                </div>
                                <div class="col-md-6">
                                    <label for="address">Địa chỉ</label>
                                    <input type="text" class="form-control" id="address" name="addressReceive"
                                        placeholder="AddressReceive">
                                    <div>{{ $errors->first('addressReceive') }}</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="phone">Số điện thoại</label>
                                    <input type="text" class="form-control" id="phone" name="phoneReceive"
                                        placeholder="PhoneReceive">
                                    <div>{{ $errors->first('phoneReceive') }}</div>
                                </div>
                                <div class="col-md-6">
                                    <label for="note">Ghi chú</label>
                                    <input type="text" class="form-control" id="note" name="note" placeholder="Note">
                                    <div>{{ $errors->first('note') }}</div>
                                </div>
                            </div>
                        </div>



                        <br>
                        <div style="display: flex; flex-direction: row;" id="payment-info">
                            <div style="width: 200px; height: 200px; flex-shrink: 0;display: flex">
                                <img src="{{ ('Image/Icon/qr.jpg') }}" alt="QR Code"
                                    style="width: 100%; height: 100%; object-fit: cover; border-radius: 5px;">
                            </div>
                            <div style="flex-grow: 1; margin-left: 50px;">
                                <!-- Thông tin thanh toán -->
                                <div style="margin-bottom: 1rem;">
                                    <strong style="display: block; color: #007bff;">
                                        <img src="{{asset('Image/Icon/mb.jpg')}}" width="40" height="40"
                                            style="border-radius: 50%;">
                                        Ngân hàng
                                    </strong>
                                    <span style="font-weight: bold;">Ngân hàng TMCP Quân đội</span>
                                </div>
                                <div style="margin-bottom: 1rem;">
                                    <strong style="display: block; color: #007bff;">Chủ tài khoản</strong>
                                    <span style="font-weight: bold">TRAN NGOC THANH</span>
                                </div>
                                <div style="margin-bottom: 1rem;">
                                    <strong style="display: block; color: #007bff;">Số tài khoản</strong>
                                    <span style="font-weight: bold">0973435715</span>
                                </div>
                                <div style="margin-bottom: 1rem;">
                                    <strong style="display: block; color: #007bff;">Số tiền: </strong>
                                    <span style="font-weight: bold" class="amount"> {{ number_format($tongTien1, 0, ',',
                                        '.') }}</span>
                                </div>
                                <div>
                                    <strong style="display: block; color: #007bff;">Nội dung</strong>
                                    @foreach($chitietgiohang as $item)
                                    <span style="font-weight: bold">ck thanhtoan {{ $item->sanPham->TenSP }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                </div>
                <div class="col-lg-6 col-12 col-custom">
                    <div class="your-order" style="background-color: #f8f8f8;">
                        <h3 style="text-align:center!important; text-transform:uppercase;">Đơn hàng của bạn</h3>
                        <div class="your-order-table table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col" class="cart-product-name">Sản phẩm</th>
                                        <th scope="col" class="cart-product-image">Ảnh</th>
                                        <th scope="col" class="cart-product-details">Chi tiết</th>
                                        <th scope="col" class="cart-product-total">Tổng cộng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($chitietgiohang as $item)
                                    <tr>
                                        <td>{{ $item->sanPham->TenSP }}</td>
                                        <td>
                                            <img src="{{ asset($item->sanPham->HinhAnh) }}" alt="Product Image"
                                                class="img-thumbnail" style="max-height: 100px;" />
                                        </td>
                                        <td>
                                            <div style="width:150px">
                                                <p>Đơn giá: {{$item->sanPham->GiaBan}} đ</p>
                                                <p>Số lượng: {{$item->SoLuong}}</p>
                                            </div>
                                        </td>
                                        <td>{{ number_format($item->ThanhTien, 2) }} đ</td>
                                        <!-- Sửa đổi định dạng số tiền -->
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr class="order-total">
                                        <th scope="col" colspan="3" style="color:red;">Tổng tiền </th>
                                        <td class="text-center">
                                            <strong><span style="color:red;">
                                                    {{ number_format($tongTien, 0, ',', '.') }} đ</span></strong>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>



                            <div class="container">
                            <label for="khuyenMaiSelect">Chọn khuyến mãi:</label>
                            <select class="form-control" id="khuyenMaiSelect" name="khuyenMai">
                                <option value="0" data-giatri="0" data-image="">Không chọn khuyến mãi</option>
                                @foreach($khuyenMais as $khuyenMai)
                                <option value="{{ $khuyenMai->MaKM }}" data-giatri="{{ $khuyenMai->GiaTri }}" >
                                
                                    {{ $khuyenMai->TenKM }} - Giảm {{ number_format($khuyenMai->GiaTri) }} đ
                                </option>
                                @endforeach
                            </select>
                                <label for="paymentSelect">Chọn hình thức thanh toán:</label>
                                <select class="form-control" id="paymentSelect" name="paymentMethod">
                                    <option value="0" data-giatri="0">Không chọn hình thức thanh toán</option>
                                    <option value="Payos">Payos</option>
                                   
                                    <!-- <option value="MoMo">MoMo</option>
    <option value="VNPay">VNPay</option> -->

                                </select>
                            </div>
                            <table class="table table-bordered">
                                <tfoot>
                                    <tr class="order-total">
                                        <th scope="col" colspan="3" style="color:red;">Tổng tiền thanh toán </th>
                                        <td class="text-center">
                                            <strong><span class="amount" style="color:red;">
                                                    {{ number_format($tongTien1, 0, ',', '.') }}đ</span></strong>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>

                            <div id="paymentResult" style="display: none;"></div>

                            <div class="order-button-payment mt-3">

                            <input type="hidden" name="selectedItems" id="selectedItems">
                                <button class="btn btn-primary flosun-button secondary-btn black-color" type="button" id="cash-payment">
                                    Thanh Toán Tiền Mặt
                                </button>
                                <button class="btn btn-primary flosun-button secondary-btn black-color" type="button" id="momo-payment">
                                    Thanh Toán MOMO
                                </button>
                               

                            </div>
                        </div>

                    </div>
                </div>
                </form>
                 
            </div>
        </div>
    </div>
    </div>

    @include('Shared/Footer')
    <!-- #endregion -->
    <!-- #region FOOTER -->



</body>
<script>
 const select = document.getElementById('khuyenMaiSelect');
    select.addEventListener('change', function() {
      const selectedOption = select.options[select.selectedIndex];
      const image = selectedOption.dataset.image;
      const imageStyle = `url("${image}")`;
      selectedOption.style.backgroundImage = imageStyle; 
    });
        $(document).ready(function () {
            $('#khuyenMaiSelect').change(function () {
                var giaTriKhuyenMai = $(this).find(':selected').data('giatri');
                var tongTienThanhToanBanDau = parseFloat('{{ $tongTien1 }}'.replace(/[\.,đ]/, ''));
                var tongTienThanhToanMoi = tongTienThanhToanBanDau - giaTriKhuyenMai;
                if (tongTienThanhToanMoi < 0) tongTienThanhToanMoi = 0;
                $('.amount').text(tongTienThanhToanMoi.toLocaleString('it-IT') + 'đ');
            });

            let selectedItems = [];
            @foreach($chitietgiohang as $item)
            selectedItems.push('{{ $item->sanPham->MaSP }}');
            @endforeach
            $('#selectedItems').val(selectedItems.join(','));

            $('#payment-info').hide();
            $('#paymentSelect').change(function () {
                if ($(this).val() == 'Payos') {
                    $('#payment-info').show();
                } else {
                    $('#payment-info').hide();
                }
            });

            $('#momo-payment').click(function () {
                $('#payment-form').attr('action', '{{ route('thanhtoanmomo') }}').submit();
            });

            $('#cash-payment').click(function () {
                $('#payment-form').attr('action', '{{ route('payment.process') }}').submit();
            });
        });
    </script>

</html>