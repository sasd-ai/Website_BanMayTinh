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
                                $product->GiaBan) }}</span> $</p>
                        <p class="card-text">{{ $product->mota }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="row">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    @if ($products->onFirstPage())
                    <li class="page-item disabled"><span class="page-link">Prev</span></li>
                    @else
                    <li class="page-item"><a class="page-link" href="{{ $products->previousPageUrl() }}"
                            rel="prev">Prev</a></li>
                    @endif

                    @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                    @if ($page == $products->currentPage())
                    <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                    @else
                    <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                    @endforeach

                    @if ($products->hasMorePages())
                    <li class="page-item"><a class="page-link" href="{{ $products->nextPageUrl() }}" rel="next">Next</a>
                    </li>
                    @else
                    <li class="page-item disabled"><span class="page-link">Next</span></li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>
    </div>
  
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.filter-link, .category-link').on('click', function (e) {
                e.preventDefault();
                var url = $(this).data('url');

                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function (response) {
                        $('#productList').html(response);
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                    }
                });
            });
        });
    </script>