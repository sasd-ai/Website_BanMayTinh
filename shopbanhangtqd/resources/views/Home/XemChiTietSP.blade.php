<!DOCTYPE html>

<html>

<head>
    <meta name="viewport" content="width=device-width" />
    <link rel="icon" href="{{ asset('Image/Icon/logo.jpg') }}" type="image/x-icon">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

    <script src="https://kit.fontawesome.com/e21d90a16d.js" crossorigin="anonymous"></script>
    <script src="~/Scripts//jquery-3.7.1.js"></script>
    <script src="~/Scripts/jquery.validate.js"></script>
    <script src="~/Scripts/jquery.validate.unobtrusive.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Bootstrap JS, Popper.js, và jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</head>
<style>
   .recommended-products {
    display: grid;
    grid-template-columns: repeat(2, 1fr); /* 2 cột, mỗi cột chiếm 1 phần bằng nhau */
    gap: 15px;
    justify-content: center;
}

.product {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    padding: 15px;
    display: flex; 
    flex-direction: column; /* Sắp xếp theo cột */
}

.product-image {
    width: 150px;
}

.product-info {
    padding-left: 15px;
}

.product img {
    max-width: 100%;
    height: 150px;
    object-fit: cover;
    margin-bottom: 10px;
    border-radius: 8px;
}

.product h2 {
    font-size: 1.2rem;
    margin-bottom: 5px;
    color: #333;
}

.product p {
    font-size: 0.9rem;
    line-height: 1.4;
    color: #666;
}

.product p:last-child {
    font-weight: bold;
    color: #f05050;
}
</style>
<style>
    .reviews-container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            max-width: 1300px;
            margin: 20px auto;
        }
    .reviews-container .review-form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .reviews-container .form-group {
            margin-bottom: 15px;
        }

        .reviews-container label {
            display: block;
            margin-bottom: 5px;
        }

        .reviews-container input[type="number"],
        .reviews-container textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .reviews-container button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .reviews-container button:hover {
            background-color: #0056b3;
        }

        .reviews-container .btn-reviews--edit,
        .reviews-container .btn-reviews--more {
            color: white;
            background-color: #f44336;
            border: none;
            border-radius: 3px;
            padding: 10px 24px;
            text-transform: uppercase;
            transition: background-color 0.3s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
        }

        .reviews-container .btn-reviews--edit:hover,
        .reviews-container .btn-reviews--more:hover {
            background-color: #ff5722;
        }

        .reviews-container .btn-reviews--edit svg,
        .reviews-container .btn-reviews--more svg {
            fill: white;
            width: 18px;
            height: 18px;
            margin-right: 10px;
        }

        .reviews-container .product-reviews--left,
        .reviews-container .product-reviews--right {
            display: inline-block;
            width: calc(50% - 20px);
            vertical-align: top;
        }

        .reviews-container .product-reviews--left {
            margin-right: 20px;
        }

        .reviews-container .product-group {
            width: 100%;
            text-align: center;
        }

        .reviews-container .product-reviews--total,
        .reviews-container .star-rate,
        .reviews-container .product-reviews--number {
            margin-left: 200px;
        }

        .reviews-container .rating {
            display: flex;
            gap: 10px;
            direction: rtl;
            margin-right: 100px;
        }

        .reviews-container form {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
        }

        .reviews-container form label {
            font-size: 16px;
            font-weight: bold;
        }

        .reviews-container form textarea {
            width: 100%;
            margin-bottom: 10px;
        }

        .reviews-container form .rating {
            overflow: hidden;
            display: flex;
            margin-bottom: 10px;
        }

        .reviews-container form .rating input {
            display: none;
        }

        .reviews-container form .rating label {
            display: inline-block;
            font-size: 40px;
            color: gray;
            cursor: pointer;
            transition: color 0.2s;
        }

        .reviews-container form .rating input:checked~label {
            color: gold;
        }

        .reviews-container form .rating input:checked~label:hover {
            color: gold;
        }

        .reviews-container form .rating label:hover,
        .reviews-container form .rating label:hover~label {
            color: gold;
        }

        .reviews-container form .rating input:checked~label {
            color: gold;
        }

        .reviews-container form input[type="submit"] {
            font-size: 16px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
        }

        .reviews-container .product-rating-average {
            display: flex;
            align-items: center;
            justify-content: start;
            font-family: Arial, sans-serif;
            color: #333;
        }

        .reviews-container .product-rating-average p {
            margin: 0;
            padding: 10px;
            font-size: 18px;
        }

        .reviews-container .card-body {
            border: 1px solid #ddd;
            margin-bottom: 10px;
            border-radius: 6px;
            padding: 20px;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
        }

        .reviews-container .card-text:first-child {
            font-weight: bold;
            font-size: 16px;
        }

        .reviews-container .card-text:nth-child(2) {
            margin: 10px 0;
            color: orange;
        }

        .reviews-container .card-text:last-child {
            font-size: 14px;
            color: #666;
        }

        .reviews-container .fa-star,
        .reviews-container .fa-star-half-alt {
            margin-right: 4px;
        }
    </style>

<body>
    <!-- Headerd -->
    @include('Shared/Header')
  
<!-- Modal cho thông báo -->
<div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="messageModalLabel">Thông báo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="messageContent"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>

@if (session('success'))
    <script>
        // Hiển thị modal khi có thông báo thành công
        $(document).ready(function() {
            $('#messageContent').text("{{ session('success') }}");
            $('#messageModal').modal('show');
        });
    </script>
@endif

@if ($errors->any())
    <script>
        // Hiển thị modal khi có lỗi
        $(document).ready(function() {
            var errorMessage = "<ul>";
            @foreach ($errors->all() as $error)
                errorMessage += "<li>{{ $error }}</li>";
            @endforeach
            errorMessage += "</ul>";

            $('#messageContent').html(errorMessage);
            $('#messageModal').modal('show');
        });
    </script>
@endif



<div class="reviews-container">
    <div class="row">
        <div class="col-7">

            <!--TỔNG QUAN SẢN PHẨM-->
            <div class="row" style=" padding: 0 12px;">
                <h5>Tổng quan sản phẩm</h5>
                @if($sanpham != null)
                <div class="card mb-3 position-relative" style=" border-radius: 0px; min-height: 200px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="{{ $sanpham->HinhAnh }}" class="card-img-top" alt="{{ $sanpham->HinhAnh }}">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{ $sanpham->TenSP }}</h5>
                                <p class="card-text" style="text-align: justify!important">{{ $sanpham->MoTa }}</p>
                                <p class="card-text"><small class="text-body-secondary" style="font-size :20px;">Giá: <span
                                            style="color: red; font-weight: bold;font-size:20px">{{number_format( $sanpham->GiaBan) }}</span> VND</small>
                                </p>
                            </div>
                            <p class="card-text placeholder-glow" style="padding-bottom: 10px;">
                                <span class="placeholder col-7"></span>
                                <span class="placeholder col-4"></span>
                                <span class="placeholder col-4"></span>
                                <span class="placeholder col-6"></span>
                                <span class="placeholder col-8"></span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!--REVIEW SẢN PHẨM-->
            <div class="row" style=" padding: 0 12px;">
                <h5>Review</h5>
                <p style="text-align: justify!important">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                    et dolore magna aliqua. Egestas fringilla phasellus faucibus scelerisque eleifend donec pretium
                    vulputate. Purus semper eget duis at. Rhoncus mattis rhoncus urna neque viverra. Cras adipiscing
                    enim eu turpis egestas pretium aenean. Facilisi cras fermentum odio eu feugiat. <br /> <br />
                    Vulputate eu scelerisque felis imperdiet. Cursus vitae congue mauris rhoncus aenean vel. Habitasse
                    platea dictumst vestibulum rhoncus est pellentesque elit. Nulla pharetra diam sit amet. Mauris a
                    diam maecenas sed enim ut sem viverra aliquet. Aliquet porttitor lacus luctus accumsan tortor.
                    <br /> <br />
                    <img src="https://file.hstatic.net/1000026716/file/gearvn-amd-ryzen-threadripper-pro-3995wx-3_ec15f922399e4767a0e5b81ef2ea2412_1024x1024.jpg"
                        alt="Alternate Text" width="100%" />
                    <br /> <br />
                    Pulvinar neque laoreet suspendisse interdum consectetur libero id faucibus. Facilisis sed odio morbi
                    quis commodo odio. Leo duis ut diam quam nulla porttitor massa id neque. Tincidunt augue interdum
                    velit euismod in pellentesque massa placerat. Urna molestie at elementum eu. Nec dui nunc mattis
                    enim ut tellus elementum sagittis vitae. <br /> <br />
                    Nunc faucibus a pellentesque sit amet. Massa sapien faucibus et molestie ac feugiat sed lectus. Nibh
                    cras pulvinar mattis nunc. Scelerisque fermentum dui faucibus in. Arcu bibendum at varius vel
                    pharetra vel turpis. Facilisis mauris sit amet massa vitae tortor condimentum lacinia. Faucibus
                    turpis in eu mi bibendum neque egestas congue. <br /> <br />
                    <img src="https://file.hstatic.net/200000722513/file/gearvn-bo-mach-chu-msi-pro-h610m-g-wifi-ddr4-4_6f12f6ee0ced4e2bab75d95c0b54612d.png"
                        alt="Alternate Text" width="100%" />
                    <br /><br />
                    Ultricies tristique nulla aliquet enim tortor at auctor. Quisque non tellus orci ac auctor augue.
                    Mattis enim ut tellus elementum sagittis vitae et leo duis. <br /> <br />
                    Dignissim diam quis enim lobortis scelerisque fermentum dui faucibus in. Scelerisque varius morbi
                    enim nunc faucibus a pellentesque sit. Elementum eu facilisis sed odio morbi quis. In vitae turpis
                    massa sed elementum tempus egestas sed sed. Aliquam sem fringilla ut morbi tincidunt augue. Sit amet
                    nisl purus in mollis nunc. <br /> <br />
                </p>
            </div>

        </div>
        <div class="col-5">

            <!--CHI TIẾT CẤU HÌNH SẢN PHẨM-->
            <div class="row" style=" padding: 0 12px;">
                <table class="table">
                    <tbody>
                        <tr>
                            <th scope="row" style="">Thông số kĩ thuật</th>
                        </tr>
                        <tr>
                            <th scope="row">Origin</th>
                            <td>United States</td>
                        </tr>
                        <tr>
                            <th scope="row">Product Name</th>
                            <td>{{ $sanpham->TenSP }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Socket</th>
                            <td>FCLGA 1700</td>
                        </tr>
                        <tr>
                            <th scope="row">Multiplier</th>
                            <td>4</td>
                        </tr>
                        <tr>
                            <th scope="row">Threads</th>
                            <td>8</td>
                        </tr>
                        <tr>
                            <th scope="row">Speed</th>
                            <td>4.30GHz</td>
                        </tr>

                    </tbody>
                </table>
            </div>


            <!--FORM THÊM VÀO GIỎ HÀNG-->
            <div class="row" style="padding: 0 12px;">
                <!--form thêm vào giỏ hàng-->
                <div class="" style="max-width: 500px; margin: 10px auto;">

                    <form action="{{ route('giohang.addToCart') }}" method="POST" style="text-align: left">
                        @csrf
                        <div class="row">
                            <div class="card mb-3 position-relative"
                                style="border-radius: 0px; min-height: 200px; border: none">
                                <div class="row g-0">
                                    <div class="col-md-4">

                                        <img src="{{ $sanpham->HinhAnh }}" class="img-fluid rounded-start"
                                            alt="{{ $sanpham->TenSP }}">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $sanpham->TenSP }}</h5>

                                            <p class="card-text">{{ $sanpham->MoTa }}</p>
                                            <p class="card-text"><small class="text-body-secondary" style="font-size :20px;">Giá: <span
                                                        style="color: red; font-weight: bold;font-size :20px">{{number_format(
                                                        $sanpham->GiaBan) }}</span> VND</small></p>

                                            <input type="hidden" name="product_id" value="{{ $sanpham->MaSP }}">

                                            <div class="mb-1">
                                                <label for="quantity" class="form-label">Quantity</label>
                                                <input type="number" class="form-control" id="quantity" name="Quantity"
                                                    required>
                                                <div id="quantityHelp" class="form-text" style="color: orange">Please
                                                    enter a valid number!</div>
                                            </div>

                                            <button type="submit" class="btn btn-success">Thêm Vào Giỏ Hàng</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <h1>Sản phẩm tương tự </h1>
<div class="recommended-products">
    @foreach ($sanPhamGoiY as $product)
        <div class="product">
            <div class="product-image">
                <a href="{{ route('XemChiTietSanPham', ['masp' => $product->MaSP]) }}">
                    <img src="{{ $product->HinhAnh }}" class="card-img-top" alt="{{ $product->HinhAnh }}">
                </a>
            </div>
            <div class="product-info">
                <h2>{{ $product->TenSP }}</h2>
                <p>{{ $product->MoTa }}</p>
                <p>Giá: {{ number_format($product->GiaBan, 0, ',', '.') }} VND</p>
            </div>
        </div>
    @endforeach
</div>
            </div>
            @endif


        </div>
        
    </div>

   


    <div class="product-rating-average">
        <p>Đánh giá trung bình: {{ round($sosao_trungbinh, 2) }}/5
            @for ($i = 0; $i < floor($sosao_trungbinh); $i++) <i class="fa fa-star" style="color: orange;"></i>
                @endfor
                @if ($sosao_trungbinh - floor($sosao_trungbinh) > 0)
                <i class="fa fa-star-half-alt" style="color: orange;"></i>
                @endif
        </p>
    </div>

    <div class="col-md-8">
        @foreach ($danhgia as $dg)
        <div class="card-body">
            <p class="card-text">{{ $dg->khachhang->TenKH }} {{ $dg->ngaygiodanhgia }}</p>
            <p class="card-text">
                @for ($i = 0; $i < floor($dg->sosao); $i++)
                    <i class="fa fa-star" style="color: orange;"></i>
                    @endfor
                    @if ($dg->sosao - floor($dg->sosao) > 0)
                    <i class="fa fa-star-half-alt" style="color: orange;"></i>
                    @endif
            </p>
            <p class="card-text">{{ $dg->noidungdanhgia }}</p>
            @if (!empty($dg->hinhanh))
            <div>
                <img src="{{ Storage::url($dg->hinhanh) }}" alt="Hình ảnh đánh giá"
                    style="max-width: 100%; height: auto;">
            </div>
            @endif
        </div>
        @endforeach
    </div>
   


    <div class="product-reviews--btn">
    @if(auth()->check()) 
        <button type="button" class="btn-reviews--edit button" data-toggle="modal" data-target="#reviewModal">
            <svg viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M9 1L11.2142 2.53226H13.9459L14.7858 5L17 6.53226L16.1601 9L17 11.4677L14.7858 13L13.9459 15.4677H11.2142L9 17L6.78579 15.4677H4.05408L3.21421 13L1 11.4677L1.83987 9L1 6.53226L3.21421 5L4.05408 2.53226H6.78579L9 1Z"
                    fill="white" stroke="white" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"
                    stroke-linejoin="round" />
                <path
                    d="M5.96393 12.3153L6.53255 9.63125L4.54238 7.79219C4.54238 7.79219 4.25806 7.54367 4.35284 7.19574C4.44762 6.84781 4.82669 6.84781 4.82669 6.84781L7.48025 6.59929L8.52272 4.06438C8.52272 4.06438 8.66487 3.66675 8.99657 3.66675C9.32827 3.66675 9.47042 4.06438 9.47042 4.06438L10.5129 6.59929L13.2612 6.84781C13.2612 6.84781 13.5455 6.89752 13.6403 7.19574C13.7351 7.49397 13.5455 7.69278 13.5455 7.69278L11.4606 9.63125L12.0292 12.4147C12.0292 12.4147 12.124 12.7129 11.887 12.9117C11.6501 13.1105 11.271 12.9117 11.271 12.9117L8.99657 11.4703L6.76947 12.9117C6.76947 12.9117 6.43778 13.1105 6.15347 12.9117C5.86915 12.7129 5.96393 12.3153 5.96393 12.3153Z"
                    fill="#1982F9" />
            </svg>
            <span>Gửi đánh giá của bạn</span>
        </button>
    @else
        <a href="{{ route('DangNhap') }}" class="btn-reviews--edit button">
            <span>Đăng nhập để đánh giá</span>
        </a>
    @endif
</div>




    <!-- Modal Structure -->
    <div class="modal fade" id="reviewModal" tabindex="-1" role="dialog" aria-labelledby="reviewModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reviewModalLongTitle">Đánh giá & Nhận xét</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('submit.danhgia') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="masp" value="{{ $sanpham->MaSP }}">
                        <label>Mức độ đánh giá:</label><br>
                        <div class="rating">
                            <input type="radio" id="star1" name="sosao" value="5" required>
                            <label for="star1"><i class="fas fa-star"></i></label>
                            <input type="radio" id="star2" name="sosao" value="4">
                            <label for="star2"><i class="fas fa-star"></i></label>
                            <input type="radio" id="star3" name="sosao" value="3">
                            <label for="star3"><i class="fas fa-star"></i></label>
                            <input type="radio" id="star4" name="sosao" value="2">
                            <label for="star4"><i class="fas fa-star"></i></label>
                            <input type="radio" id="star5" name="sosao" value="1">
                            <label for="star5"><i class="fas fa-star"></i></label>
                        </div>
                        <label for="noidungdanhgia">Đánh giá:</label><br>
                        <textarea id="noidungdanhgia" name="noidungdanhgia" rows="5" cols="50" required></textarea>
                        <div class="form-group">
                            <label for="hinhanh">Hình ảnh đánh giá:</label>
                            <input type="file" class="form-control" name="hinhanh">
                        </div>
                        <div class="modal-footer">

                            <button type="submit" class="btn btn-primary">Gửi đánh giá</button>
                        </div>
                    </form>
                </div>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
 
            </div>
        </div>
    </div>
    </div>

    <!-- #endregion -->
    <!-- #region FOOTER -->
    @include('Shared/Footer')


</body>


<script>
    $(document).ready(function () {
        $('#show-review-modal').click(function () {
            $('#reviewModal').modal('show');
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var reviewModalTrigger = document.getElementById('show-review-modal');
        var reviewModal = new bootstrap.Modal(document.getElementById('reviewModal'));

        reviewModalTrigger.addEventListener('click', function () {
            reviewModal.show();
        });
    });
</script>

</html>