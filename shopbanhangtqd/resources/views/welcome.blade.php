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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
   <!-- Include jQuery UI -->
   <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
   <!-- Include jQuery Validate (if needed) -->
   <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
   <!-- Include jQuery Validate Unobtrusive (if needed) -->
   <script src="https://cdn.jsdelivr.net/npm/jquery-validation-unobtrusive@3.2.11/jquery.validate.unobtrusive.min.js"></script>
    <style>
        .dropdown-item:focus,
        .dropdown-item:hover {
            background-color: #DF042A;
            color: white !important;
        }

        .danh-muc-san-pham .row {
            padding: 5px 0px;
            margin: 10px 0 !important;
        }

        .danh-muc-san-pham>.row>.col-8>a {
            text-decoration: none;
            color: black;
        }

        .danh-muc-san-pham>.row>.col-8>a:hover {
            color: #DF042A;
        }

        .card .card-body h5 {
            min-height: 45px;
            font-size: 15px;
        }

        .card .card-body p {
            font-size: 13px;
        }

        .carousel-item .row .col:hover {
            box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px;
            transition: ease-in 0.1s;
        }

        .carousel-item .row .col {
            border-radius: 10px;
        }



        .card-img-top {
            width: 100%;
            height: 200px;
        }

        .wrapper {
            margin-left: 126px;
            margin-right: 112px;
            border-radius: 10px;
            padding-top: 20px;
        }

        * {
            text-align: left !important;
        }

        .field-validation-error {
            color: red;
        }

      
    </style>

    <style>
        .box-header {
            display: flex;
            align-items: center;
            justify-content: space-around;
            padding: 10px 0;
            background: white;

        }


        .hTitle a {
            font-size: 30px;
            color: black;
            text-decoration: none;

        }


        .shTitle {
            display: flex;
            align-items: center;
            color: black;
        }


        .shTitle svg {
            margin-right: 7px;
            height: 16px;
            width: 22px;
        }


        .button-more {
            color: white;
            background: #FF3C53;
            border-radius: 15px;
            padding: 5px 10px;
            text-decoration: none;
        }
    </style>
    <style>
        .section {
            padding: 50px 0;
            background-color: #f5f5f5;
        }

        .section-heading {
            text-align: center;
            margin-bottom: 35px;
        }

        .box-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .hTitle {
            font-size: 1.6rem;
            color: #333;
            margin: 0;
        }

        .hTitle a {
            color: inherit;
            text-decoration: none;
        }

        .button-more {
            color: #fff;
            background-color: #DF042A;
            padding: 10px 25px;
            border-radius: 20px;
            text-decoration: none;
        }

        .posts-list {
            display: flex;
            justify-content: space-between;
        }

        .post-item {
            width: 24%;
            box-sizing: border-box;
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
        }


        .post-thumb {
            height: 240px;
            width: 100%;
            position: relative;
            overflow: hidden;
        }

        .post-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .post-content {
            padding: 15px;
        }

        .post-title {
            margin: 0;
            font-size: 1.2rem;
            margin-top: 10px;
        }

        .post-title a {
            color: #333;
            text-decoration: none;
        }
        
    </style>

</head>

<body>
    <!-- Headerd -->
    @include('Shared/Header')
   
    <!-- #region MAIN BODY -->

    <div class="container-fluid text-center mt-2" style="min-height: 250px;">
        <div class="row">
            <div class="col-1"></div>
            <!--CHỌN THEO DANH MỤC-->
            <div class="col-2" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                <!--bg-info-->

                <div class="col danh-muc-san-pham">
                    <div class="row" style="padding: 5px 12px; color: #DF042A;">Danh mục sản phẩm</div>
                    <div class="row">
                        @foreach($loaiSanPhams as $loaiSanPham)
                        <div class="row-md-3 mb-3"> 
                            <a href="{{ route('products.filterByCategory', ['TenLoai' => $loaiSanPham->TenLoai]) }}" class="category-link"  style="text-decoration: none; color: black">
                            <div style="display: flex; align-items: center;"> 
                                <div style="flex-grow: 1;"> 
                                    {{ $loaiSanPham->TenLoai }}
                                </div>
                                <div> 
                                    <i class="fas fa-chevron-right"></i>
                                </div>
                            </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                  
                  
                  
                </div>
            </div>
            <!-- CAROUSEL -->
            <div class="col-6"
                style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);  margin: 0px 10px;">
                <!--bg-secondary-->
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel"
                    style="min-height: 270px;">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                            class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                            aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                            aria-label="Slide 3"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3"
                            aria-label="Slide 4"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4"
                            aria-label="Slide 5"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active w-100" style="" data-bs-interval="5000">
                            <img src="https://file.hstatic.net/200000722513/file/web_slider_800x400_nang_cap_ram_374b4f778d694ad995c4dc40c6f59e9e.png"
                                class="d-block w-100" alt="carousel 1">
                        </div>
                        <div class="carousel-item w-100 active" style="" data-bs-interval="5000">
                            <img src="https://file.hstatic.net/200000722513/file/asus_vivobook_16_-_m1605ya_mb303w_-_slider_daa7069486214947aa007719d51bf7d8.png"
                                class="d-block w-100" alt="carousel 2">
                        </div>
                        <div class="carousel-item w-100" style="" data-bs-interval="5000">
                            <img src="https://file.hstatic.net/200000722513/file/man_hinh_slider_295b45dfd3ee4f3cb6a2632ab018e588.png"
                                class="d-block w-100" alt="carousel 3">
                        </div>
                        <div class="carousel-item w-100" style="" data-bs-interval="5000">
                            <img src="https://file.hstatic.net/200000722513/file/loa_xin_slider_55571db8742146cd85eef265cf950b35.png"
                                class="d-block w-100" alt="carousel 4">
                        </div>

                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <!--BANNER QUẢNG CÁO-->
            <div class="col-2" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                <!--bg-success-->
                <!--để banner quảng cáo-->
                <div class="col">
                    <div class="row pb-2">
                        <img width="100%;"
                            src="https://file.hstatic.net/200000722513/file/right_3_-_pc_gaming_4a55a103e23c4647bdf826831750e2d2.png"
                            alt="Alternate Text" height="90px" />
                    </div>
                    <div class="row pb-2">
                        <img width="100%;"
                            src="https://file.hstatic.net/200000722513/file/sub_banner_4_-_pc_van_phong_2865fd86b8b24dfc90be4bfa33733f91.png"
                            alt="Alternate Text" height="90px" />

                    </div>
                    <div class="row pb-2">
                        <img width="100%;"
                            src="https://file.hstatic.net/200000722513/file/right_1_-_linh_kien_may_tinh_82f376ea72ab484cbdfdfb841a843939.png"
                            alt="Alternate Text" height="90px" />
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- #endregion -->



    <!--BANNER KHUYẾN MÃI-->
    <div class="wrapper">
        <div style="padding: 0px">
            <img src="https://file.hstatic.net/200000722513/file/khuyen_mai_topbar_28deb390f0a149e4980bc59cd107d75f.png"
                alt="Alternate Text" width="100%" />
        </div>
    </div>
    <!--GPU NỔI BẬT-->

    <div class="wrapper">
        <div class="box-header">
            <h2 class="hTitle"><a href="/collections/pc-gvn">GPU bán chạy</a></h2>
            <div class="box-subHeader">
                <h3 class="shTitle">
                    <svg viewBox="0 0 22 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M18.5 4H16V2C16 0.9 15.1 0 14 0H2C0.9 0 0 0.9 0 2V11C0 12.1 0.9 13 2 13C2 14.66 3.34 16 5 16C6.66 16 8 14.66 8 13H14C14 14.66 15.34 16 17 16C18.66 16 20 14.66 20 13H21C21.55 13 22 12.55 22 12V8.67C22 8.24 21.86 7.82 21.6 7.47L19.3 4.4C19.11 4.15 18.81 4 18.5 4ZM5 14C4.45 14 4 13.55 4 13C4 12.45 4.45 12 5 12C5.55 12 6 12.45 6 13C6 13.55 5.55 14 5 14ZM18.5 5.5L20.46 8H16V5.5H18.5ZM17 14C16.45 14 16 13.55 16 13C16 12.45 16.45 12 17 12C17.55 12 18 12.45 18 13C18 13.55 17.55 14 17 14Z"
                            fill="#FF3C53" />
                    </svg>
                    Trả góp 0%
                </h3>
            </div>
            <div class="box-link">
                <a href="/collections/pc-gvn" class="button-more">Xem tất cả</a>
            </div>
        </div>

        <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @php
                $itemsPerSlide = 5;
                $slideCount = ceil($sanPham1->count() / $itemsPerSlide);
                @endphp
                @foreach ($sanPham1->chunk($itemsPerSlide) as $index => $productsChunk)
                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}" data-bs-interval="10000">
                    <div class="row row-cols-1 row-cols-md-5 g-4">
                        @foreach ($productsChunk as $product)
                        <div class="col">
                            <div class="card h-100">
                                <a href="{{ route('XemChiTietSanPham', ['masp' => $product->MaSP]) }}">
                                    <img src="{{ $product->HinhAnh }}" class="card-img-top" alt="{{ $product->HinhAnh }}">
                                </a>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $product->TenSP }}</h5>
                                    <p class="card-text">Giá: <span style="color: #DF042A;">{{ number_format($product->GiaBan)
                                            }}</span> $</p>
                                </div>
                                <div class="card-footer">
                                    <div class="card-footer">
                                        <small class="text-body-secondary">
                                            <i class="fa-regular fa-star"></i>
                                            <i class="fa-regular fa-star"></i>
                                            <i class="fa-regular fa-star"></i>
                                            <i class="fa-regular fa-star"></i>
                                            <i class="fa-regular fa-star"></i>
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <!--CPU NỔI BẬT-->
    <div class="wrapper">
        <div class="box-header">
            <h2 class="hTitle"><a href="/collections/pc-gvn">CPU bán chạy</a></h2>
            <div class="box-subHeader">
                <h3 class="shTitle">
                    <svg viewBox="0 0 22 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M18.5 4H16V2C16 0.9 15.1 0 14 0H2C0.9 0 0 0.9 0 2V11C0 12.1 0.9 13 2 13C2 14.66 3.34 16 5 16C6.66 16 8 14.66 8 13H14C14 14.66 15.34 16 17 16C18.66 16 20 14.66 20 13H21C21.55 13 22 12.55 22 12V8.67C22 8.24 21.86 7.82 21.6 7.47L19.3 4.4C19.11 4.15 18.81 4 18.5 4ZM5 14C4.45 14 4 13.55 4 13C4 12.45 4.45 12 5 12C5.55 12 6 12.45 6 13C6 13.55 5.55 14 5 14ZM18.5 5.5L20.46 8H16V5.5H18.5ZM17 14C16.45 14 16 13.55 16 13C16 12.45 16.45 12 17 12C17.55 12 18 12.45 18 13C18 13.55 17.55 14 17 14Z"
                            fill="#FF3C53" />
                    </svg>
                    Miễn phí giao hàng
                </h3>
            </div>


            <div class="box-link">
                <a href="/collections/pc-gvn" class="button-more">Xem tất cả</a>
            </div>
        </div>

        <div id="carouselExample1" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @php
                $itemsPerSlide = 5;
                $slideCount = ceil($sanPham->count() / $itemsPerSlide);
                @endphp
                @foreach ($sanPham->chunk($itemsPerSlide) as $index => $productsChunk)
                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}" data-bs-interval="10000">
                    <div class="row row-cols-1 row-cols-md-5 g-4">
                        @foreach ($productsChunk as $product)
                        <div class="col">
                            <div class="card h-100">
                            <a href="{{ route('XemChiTietSanPham', ['masp' => $product->MaSP]) }}">
                                    <img src="{{ $product->HinhAnh }}" class="card-img-top"
                                        alt="{{ $product->HinhAnh }}">
                                </a>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $product->TenSP }}</h5>
                                    <p class="card-text">Giá: <span style="color: #DF042A;">{{number_format( $product->GiaBan)
                                            }}</span> $</p>
                                </div>
                                <div class="card-footer">
                                    <div class="card-footer">
                                        <small class="text-body-secondary">
                                            <i class="fa-regular fa-star"></i>
                                            <i class="fa-regular fa-star"></i>
                                            <i class="fa-regular fa-star"></i>
                                            <i class="fa-regular fa-star"></i>
                                            <i class="fa-regular fa-star"></i>
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample1" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample1" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    </div>
    </div>
    </div>
    </div>

    <!--KEYBOARD NỔI BẬT-->
    <div class="wrapper">
        <div class="box-header">
            <h2 class="hTitle"><a href="/collections/pc-gvn">Bàn Phím bán chạy</a></h2>
            <div class="box-subHeader">
                <h3 class="shTitle">
                    <svg viewBox="0 0 22 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M18.5 4H16V2C16 0.9 15.1 0 14 0H2C0.9 0 0 0.9 0 2V11C0 12.1 0.9 13 2 13C2 14.66 3.34 16 5 16C6.66 16 8 14.66 8 13H14C14 14.66 15.34 16 17 16C18.66 16 20 14.66 20 13H21C21.55 13 22 12.55 22 12V8.67C22 8.24 21.86 7.82 21.6 7.47L19.3 4.4C19.11 4.15 18.81 4 18.5 4ZM5 14C4.45 14 4 13.55 4 13C4 12.45 4.45 12 5 12C5.55 12 6 12.45 6 13C6 13.55 5.55 14 5 14ZM18.5 5.5L20.46 8H16V5.5H18.5ZM17 14C16.45 14 16 13.55 16 13C16 12.45 16.45 12 17 12C17.55 12 18 12.45 18 13C18 13.55 17.55 14 17 14Z"
                            fill="#FF3C53" />
                    </svg>
                    Miễn phí giao hàng
                </h3>
            </div>


            <div class="box-link">
                <a href="/collections/pc-gvn" class="button-more">Xem tất cả</a>
            </div>
        </div>

        <div id="carouselExample2" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @php
                $itemsPerSlide = 5;
                $slideCount = ceil($sanPham2->count() / $itemsPerSlide);
                @endphp
                @foreach ($sanPham2->chunk($itemsPerSlide) as $index => $productsChunk)
                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}" data-bs-interval="10000">
                    <div class="row row-cols-1 row-cols-md-5 g-4">
                        @foreach ($productsChunk as $product)
                        <div class="col">
                            <div class="card h-100">
                            <a href="{{ route('XemChiTietSanPham', ['masp' => $product->MaSP]) }}">
                                    <img src="{{ $product->HinhAnh }}" class="card-img-top"
                                        alt="{{ $product->HinhAnh }}">
                                </a>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $product->TenSP }}</h5>
                                    <p class="card-text">Giá: <span style="color: #DF042A;">{{number_format( $product->GiaBan)
                                            }}</span> $</p>
                                </div>
                                <div class="card-footer">
                                    <div class="card-footer">
                                        <small class="text-body-secondary">
                                            <i class="fa-regular fa-star"></i>
                                            <i class="fa-regular fa-star"></i>
                                            <i class="fa-regular fa-star"></i>
                                            <i class="fa-regular fa-star"></i>
                                            <i class="fa-regular fa-star"></i>
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample2" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample2" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <!--MONITOR NỔI BẬT-->
    <div class="wrapper">

        <div class="box-header">
            <h2 class="hTitle"><a href="/collections/pc-gvn">Màn Hình bán chạy</a></h2>
            <div class="box-subHeader">
                <h3 class="shTitle">
                    <svg viewBox="0 0 22 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M18.5 4H16V2C16 0.9 15.1 0 14 0H2C0.9 0 0 0.9 0 2V11C0 12.1 0.9 13 2 13C2 14.66 3.34 16 5 16C6.66 16 8 14.66 8 13H14C14 14.66 15.34 16 17 16C18.66 16 20 14.66 20 13H21C21.55 13 22 12.55 22 12V8.67C22 8.24 21.86 7.82 21.6 7.47L19.3 4.4C19.11 4.15 18.81 4 18.5 4ZM5 14C4.45 14 4 13.55 4 13C4 12.45 4.45 12 5 12C5.55 12 6 12.45 6 13C6 13.55 5.55 14 5 14ZM18.5 5.5L20.46 8H16V5.5H18.5ZM17 14C16.45 14 16 13.55 16 13C16 12.45 16.45 12 17 12C17.55 12 18 12.45 18 13C18 13.55 17.55 14 17 14Z"
                            fill="#FF3C53" />
                    </svg>
                    Giao Hàng Toàn Quốc
                </h3>
            </div>


            <div class="box-link">
                <a href="/collections/pc-gvn" class="button-more">Xem tất cả</a>
            </div>
        </div>

        <div id="carouselExample3" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @php
                $itemsPerSlide = 5;
                $slideCount = ceil($sanPham3->count() / $itemsPerSlide);
                @endphp
                @foreach ($sanPham3->chunk($itemsPerSlide) as $index => $productsChunk)
                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}" data-bs-interval="10000">
                    <div class="row row-cols-1 row-cols-md-5 g-4">
                        @foreach ($productsChunk as $product)
                        <div class="col">
                            <div class="card h-100">
                            <a href="{{ route('XemChiTietSanPham', ['masp' => $product->MaSP]) }}">
                                    <img src="{{ $product->HinhAnh }}" class="card-img-top"
                                        alt="{{ $product->HinhAnh }}">
                                </a>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $product->TenSP }}</h5>
                                    <p class="card-text">Giá: <span style="color: #DF042A;">{{number_format( $product->GiaBan)
                                            }}</span> $</p>
                                </div>
                                <div class="card-footer">
                                    <div class="card-footer">
                                        <small class="text-body-secondary">
                                            <i class="fa-regular fa-star"></i>
                                            <i class="fa-regular fa-star"></i>
                                            <i class="fa-regular fa-star"></i>
                                            <i class="fa-regular fa-star"></i>
                                            <i class="fa-regular fa-star"></i>
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample3" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample3  "
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <!--ĐIỂM TIN CÔNG NGHỆ-->
    <div class="wrapper">
        <section class="section section-blogslist">
            <div class="container-fluid">
                <div class="wrapper-content">
                    <div class="section-heading">
                        <div class="box-header">
                            <h2 class="hTitle"><a href="/collections/pc-gvn">Điểm Tin Công Nghệ</a></h2>

                            <div class="box-link">
                                <a href="/collections/pc-gvn" class="button-more">Xem tất cả</a>
                            </div>
                        </div>
                    </div>
                    <div class="section-content">
                        <div class="posts-list">
                            <div class="post-item">
                                <div class="post-thumb  fade-box">
                                    <a class="aspect-ratio" href="/blogs/thu-thuat-giai-dap/may-tinh-bi-do-giat-lag"
                                        title="Hướng dẫn xử lý máy tính bị đơ, không thao tác và tắt màn hình được">
                                        <img
                                            src="https://file.hstatic.net/200000722513/article/gearvn-may-tinh-bi-do-giat-lag-banner_61146ff3cb2545af827f37d3ec3d27c5_large.jpg">
                                    </a>
                                </div>
                                <div class="post-content">
                                    <div class="post-info d-none">
                                        <span class="post-info_item">Thứ Năm 25,04,2024</span>
                                    </div>
                                    <h3 class="post-title">
                                        <a href="/blogs/thu-thuat-giai-dap/may-tinh-bi-do-giat-lag">Hướng dẫn xử lý máy
                                            tính
                                            bị đơ, không thao tác và tắt màn hình được</a>
                                    </h3>
                                    <div class="post-descr d-none">
                                        <p>Máy tính bạn có thường xuyên bị đơ, bị giật lag vô cớ và điều đó khiến cho
                                            bạn
                                            không thể thao tác được với thiết bị bao gồm cả...</p>
                                    </div>
                                </div>

                            </div>



                            <div class="post-item">
                                <div class="post-thumb  fade-box">
                                    <a class="aspect-ratio"
                                        href="/blogs/thu-thuat-giai-dap/cach-lay-nhac-tiktok-khong-ban-quyen-lam-nhac-chuong-iphone"
                                        title="Cách lấy nhạc Tiktok không bản quyền làm nhạc chuông iphone">
                                        <img
                                            src="https://file.hstatic.net/200000722513/article/15_6552f3c0e4bc43b8a8641d2191833d05_large.jpg">
                                    </a>
                                </div>
                                <div class="post-content">
                                    <div class="post-info d-none">
                                        <span class="post-info_item">Thứ Năm 11,04,2024</span>
                                    </div>
                                    <h3 class="post-title">
                                        <a
                                            href="/blogs/thu-thuat-giai-dap/cach-lay-nhac-tiktok-khong-ban-quyen-lam-nhac-chuong-iphone">Cách
                                            lấy nhạc Tiktok không bản quyền làm nhạc chuông iphone</a>
                                    </h3>
                                    <div class="post-descr d-none">
                                        <p>Bạn muốn sử dụng nhạc Tiktok làm nhạc chuông iphone mà không bị dính bản
                                            quyền?
                                            Hãy cùng GREARVN tìm hiểu cách tải nhạc Tiktok không bản quyền làm nhạc...
                                        </p>
                                    </div>
                                </div>

                            </div>


                            <div class="post-item">
                                <div class="post-thumb  fade-box">
                                    <a class="aspect-ratio"
                                        href="/blogs/thu-thuat-giai-dap/huong-dan-dat-mat-khau-tren-windows-11"
                                        title="Cách thay đổi mật khẩu trên máy tính Windows 11 nhanh chóng, đơn giản.">
                                        <img
                                            src="https://file.hstatic.net/200000722513/article/standard-quality-control-concept-m_10a3dda95fdd42b1b33b9c635ab6a3ed_large.jpg">
                                    </a>
                                </div>
                                <div class="post-content">
                                    <div class="post-info d-none">
                                        <span class="post-info_item">Thứ Năm 11,04,2024</span>
                                    </div>
                                    <h3 class="post-title">
                                        <a href="/blogs/thu-thuat-giai-dap/huong-dan-dat-mat-khau-tren-windows-11">Cách
                                            thay
                                            đổi mật khẩu trên máy tính Windows 11 nhanh chóng, đơn giản.</a>
                                    </h3>
                                    <div class="post-descr d-none">
                                        <p>Mật khẩu đóng vai trò quan trọng trong việc bảo vệ dữ liệu và quyền truy cập
                                            vào
                                            máy tính của bạn. Do đó, việc thay đổi mật khẩu thường...</p>
                                    </div>
                                </div>

                            </div>


                            <div class="post-item">
                                <div class="post-thumb  fade-box">
                                    <a class="aspect-ratio"
                                        href="/blogs/thu-thuat-giai-dap/top-4-cach-don-gian-va-hieu-qua-tai-phim-ve-may-tinh"
                                        title="Top 4 cách đơn giản và hiệu quả tải phim về máy tính">
                                        <img
                                            src="https://file.hstatic.net/200000722513/article/9_77ea2c8c1e304df3aaeb9f893c26f583_large.png">
                                    </a>
                                </div>
                                <div class="post-content">
                                    <div class="post-info d-none">
                                        <span class="post-info_item">Thứ Năm 11,04,2024</span>
                                    </div>
                                    <h3 class="post-title">
                                        <a
                                            href="/blogs/thu-thuat-giai-dap/top-4-cach-don-gian-va-hieu-qua-tai-phim-ve-may-tinh">Top
                                            4 cách đơn giản và hiệu quả tải phim về máy tính</a>
                                    </h3>
                                    <div class="post-descr d-none">
                                        <p>Bạn muốn tận hưởng những bộ phim yêu thích mà không cần kết nối internet?
                                            GEARVN
                                            sẽ hướng dẫn bạn&nbsp;top 4 cách đơn giản và hiệu quả giúp bạn tải...</p>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- #endregion -->
    <!-- #region FOOTER -->
    @include('Shared/Footer')
 
</body>
<!-- Tại view trang chính, thêm đoạn script này vào cuối file trước thẻ closing body (</body>) -->
<script>
    // Khi tài liệu đã sẵn sàng
    document.addEventListener('DOMContentLoaded', function () {
        // Kiểm tra session flash 'success'
        @if(session('success'))
            // Thông báo hộp thoại
            alert('{{ session('success') }}');
        @endif
    });
</script>

</html>