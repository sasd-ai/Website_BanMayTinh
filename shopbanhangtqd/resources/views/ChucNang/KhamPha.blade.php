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

</head>
<style>
    .card:hover {
        transition: ease-in 0.1s;
        box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px;
        transform: translateY(-0.25em);
    }

    .soft {
        border-radius: 5px;
    }

    .soft:hover {
        transition: ease-in 0.1s;
        box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px;
        transform: translateY(-0.15em);
    }
    .reviews-container {
           
            justify-content: center;
            align-items: center;
            flex-direction: column;
            max-width: 1300px;
            margin: 20px auto;
        }
</style>

<body>
    <!-- Headerd -->
    @include('Shared/Header')
<div class="reviews-container">
    <div id="productList">
        <h5 style="margin-top: 15px">Sắp xếp theo</h5>
        <div class="row">

            <div class="col-2">

            <a href="#" class="filter-link" data-url="{{ route('products.index', ['sortType' => 'priceIncrease']) }}" style="text-decoration: none; color: black">
                    <div class="soft">
                        <i class="fa-solid fa-arrow-down-wide-short"></i>Giá Thấp - Cao
                    </div>
                </a>
            </div>
            <div class="col-2">
            <a href="#" class="filter-link" data-url="{{ route('products.index', ['sortType' => 'priceDecrease']) }}" style="text-decoration: none; color: black">
                  
                    <div class="soft">
                        <i class="fa-solid fa-arrow-down-wide-short"></i>Giá Cao - Thấp
                    </div>
                </a>
            </div>
            <div class="col-2">
                <a href="{{ route('products.index') }}" style="text-decoration: none; color: black">
                    <div class="soft">
                        <i class="fa-solid fa-arrow-rotate-left"></i>Reset
                    </div>
                </a>
            </div>
        </div>

        <h5 style="margin-top: 15px">Tìm kiếm theo hãng</h5>
            <div class="row">
                @foreach($loaiSanPhams as $loaiSanPham)
                <div class="col">
                    <a href="#" class="category-link" data-url="{{ route('products.filterByCategory', ['TenLoai' => $loaiSanPham->TenLoai]) }}" style="text-decoration: none; color: black">
                        <div class="soft">
                            <i class="fa-solid fa-eye"></i>{{ $loaiSanPham->TenLoai }}
                        </div>
                    </a>
                </div>
                @endforeach
            </div>

        <!-- Product list -->
        <div class="row row-cols-1 row-cols-md-5 g-4" style="margin-top: 20px;">
            @foreach ($products as $product)
            <div class="col">
                <div class="card h-100">
                    <a href="{{ route('XemChiTietSanPham', ['masp' => $product->MaSP]) }}">
                        <img src="{{ $product->HinhAnh }}" class="card-img-top" alt="{{ $product->TenSP }}"
                            style="padding: 5px;">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title" style="min-height: 50px;">{{ $product->TenSP }}</h5>
                        <p class="card-text">Giá: <span style="color: red; font-weight: bold">{{number_format(
                                $product->GiaBan) }}</span> VND</p>
                        <p class="card-text">{{ $product->mota }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="row">
    <nav aria-label="Page navigation example">  <!-- Tạo một phần tử điều hướng (nav) cho phân trang -->
        <ul class="pagination">  <!-- Tạo một danh sách không có dấu đầu dòng (ul) với class "pagination" -->
            @if ($products->onFirstPage())  <!-- Kiểm tra xem có phải là trang đầu tiên không -->
                <li class="page-item disabled"><span class="page-link">Prev</span></li>  <!-- Hiển thị nút "Prev" bị vô hiệu hóa (disabled) nếu đang ở trang đầu tiên -->
            @else
                <li class="page-item"><a class="page-link" href="{{ $products->previousPageUrl() }}" rel="prev">Prev</a></li>  <!-- Hiển thị nút "Prev" hoạt động (active) với đường dẫn đến trang trước -->
            @endif

            @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)  <!-- Duyệt qua các trang trong phạm vi từ trang 1 đến trang cuối cùng -->
                @if ($page == $products->currentPage())  <!-- Kiểm tra xem trang hiện tại có trùng với trang đang duyệt không -->
                    <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>  <!-- Hiển thị số trang hiện tại với class "active" -->
                @else
                    <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>  <!-- Hiển thị số trang khác với class "page-item" và đường dẫn đến trang tương ứng -->
                @endif
            @endforeach

            @if ($products->hasMorePages())  <!-- Kiểm tra xem có còn trang tiếp theo không -->
                <li class="page-item"><a class="page-link" href="{{ $products->nextPageUrl() }}" rel="next">Next</a></li>  <!-- Hiển thị nút "Next" hoạt động với đường dẫn đến trang tiếp theo -->
            @else
                <li class="page-item disabled"><span class="page-link">Next</span></li>  <!-- Hiển thị nút "Next" bị vô hiệu hóa (disabled) nếu đang ở trang cuối cùng -->
            @endif
        </ul>
    </nav>
</div>
    </div>
    </div>

    @include('Shared/Footer')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
       $(document).ready(function () {
    $('.filter-link, .category-link').on('click', function (e) {
        e.preventDefault(); // Ngăn chặn hành vi mặc định của liên kết (chuyển trang)
        var url = $(this).data('url'); // Lấy giá trị của thuộc tính `data-url` từ liên kết được click

        $.ajax({
            url: url, // Đường dẫn đến route cần truy vấn
            type: 'GET', // Phương thức truy vấn là GET
            success: function (response) {
                $('#productList').html(response); // Thay thế nội dung của phần tử có id `productList` với kết quả trả về từ server
            },
            error: function (xhr, status, error) {
                console.error(error); // In lỗi ra console nếu có lỗi xảy ra
            }
        });
    });
});
    </script>

</body>



</html>