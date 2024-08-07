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

    <!-- Headerd -->
    @include('Shared/Header')
    <div class="d-flex align-items-start">
        <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home"
                type="button" role="tab" aria-controls="v-pills-home" aria-selected="true"><i
                    class="fa-solid fa-user"></i> Thông tin cá nhân</button>
            <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile"
                type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false"><i
                    class="fa-solid fa-user-pen"></i> Cập nhật thông tin</button>
            <button class="nav-link" id="v-pills-disabled-tab" data-bs-toggle="pill" data-bs-target="#v-pills-disabled"
                type="button" role="tab" aria-controls="v-pills-disabled" aria-selected="false"><i
                    class="fa-solid fa-bag-shopping"></i> Sản phẩm đã mua</button>
                    <button class="nav-link" id="v-pills-cancelled-tab" data-bs-toggle="pill" data-bs-target="#v-pills-cancelled"
        type="button" role="tab" aria-controls="v-pills-cancelled" aria-selected="false"><i
            class="fa-solid fa-times"></i> Sản phẩm đã hủy</button>
    <button class="nav-link" id="v-pills-pending-tab" data-bs-toggle="pill" data-bs-target="#v-pills-pending"
        type="button" role="tab" aria-controls="v-pills-pending" aria-selected="false"><i
            class="fa-solid fa-clock"></i> Chờ xác nhận đơn</button>
            <button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages"
                type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false"><i
                    class="fa-solid fa-cart-shopping"></i> Giỏ hàng</button>
            <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings"
                type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false"><i
                    class="fa-solid fa-headset"></i> Hỗ trợ</button>
        </div>
        <div class="tab-content flex-grow-1">
            <!--Thông tin chi tiết-->
            <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab"
                tabindex="0">
                <div class="row" style="min-height: 277px;">
                    <div class="col-4 mb-3">
                        <div class="card" style="border-radius: 0px;">
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center">
                                    @if ($user->gender == 'Nam')
                                    <img src="https://www.gametoria.com/wp-content/uploads/2019/03/tonda.png"
                                        alt="Admin" class="rounded-circle" width="120">
                                    @elseif ($user->gender == 'Nữ')
                                    <img src="https://th.bing.com/th/id/OIP.IV50IjP-y6ZCbidscAM0qgHaHa?pid=ImgDet&w=200&h=200&c=7&dpr=1.3"
                                        alt="Admin" class="rounded-circle" width="120">
                                    @else
                                    <img src="https://c4ads.org/wp-content/uploads/2022/04/placeholder-headshot.png"
                                        alt="Admin" class="rounded-circle" width="120">
                                    @endif

                                    <div class="mt-3">
                                        <h4 style="text-align: center!important">{{ $user->TaiKhoan }}</h4>
                                        <p class="text-muted font-size-sm" style="text-align: center!important">{{
                                            $user->email }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-8">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th scope="row">Name</th>
                                    <td>{{ $user->khachhang->TenKH }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Email</th>
                                    <td>{{ $user->TaiKhoan }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Số Điện Thoại</th>
                                    <td>{{ $user->khachhang->SDT }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>



            <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab"
                tabindex="0">
                @include('UserInformation.UpdateUserInformation')
            </div>

            <div class="tab-pane fade" id="v-pills-disabled" role="tabpanel" aria-labelledby="v-pills-disabled-tab"
                tabindex="0">
                @include('ThanhToan.SanPhamDaMua')
            </div>

            <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab"
                tabindex="0">
                @include('GioHang.GioHang')
            </div>

            <div class="tab-pane fade" id="v-pills-cancelled" role="tabpanel" aria-labelledby="v-pills-cancelled-tab"
                tabindex="0">
                 @include('ThanhToan.SanPhamDaHuy')
            </div>

            <div class="tab-pane fade" id="v-pills-pending" role="tabpanel" aria-labelledby="v-pills-pending-tab"
                tabindex="0">
                @include('ThanhToan.ChoXacNhanDon')
            </div>



        </div>
    </div>

    @include('Shared/Footer')
    <!-- #endregion -->
    <!-- #region FOOTER -->



</body>


</html>