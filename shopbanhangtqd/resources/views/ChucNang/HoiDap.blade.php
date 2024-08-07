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
    .title {
        font-weight: bold;
        text-align: center !important;
        color: red;
        padding: 20px 0px;
    }

    #IdC {
        color: #DF042A;
    }
    
</style>


    <!-- Headerd -->
    @include('Shared/Header')
    
    <div>
    <h4 class="title">MỘT SỐ CÂU HỎI THƯỜNG GẶP ?</h4>
    <div class="content">
        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button id="IdC" class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Sản Phẩm Nào Được Nhiều Người Mua Nhất Trong Năm 2024 ?
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <strong> Laptop:</strong> Laptop là công cụ thiết yếu cho công việc, học tập và các công việc hàng ngày.Shop cung cấp nhiều mẫu laptop từ các thương hiệu khác nhau, bao gồm Apple, Dell và HP, đảm bảo rằng khách hàng có thể tìm thấy thiết bị hoàn hảo cho nhu cầu cụ thể của họ.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                    <button id="IdC" class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Sản Phẩm Có Được Bảo Hành Và Đổi Trả Không ?
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <strong>Tất nhiên là được:</strong> <br>Thời gian bảo hành: Mỗi sản phẩm sẽ có thời gian bảo hành riêng, được ghi rõ trên phiếu bảo hành hoặc tài liệu đi kèm sản phẩm. Thông thường, thời gian bảo hành dao động từ 6 tháng đến 2 năm, tùy theo loại sản phẩm.<br>Thời gian đổi trả: Một số nhà cung cấp cho phép khách hàng đổi trả sản phẩm trong một khoảng thời gian nhất định sau khi mua hàng, thường là từ 7 ngày đến 30 ngày.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                    <button id="IdC" class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Địa chỉ trụ sở chính của cửa hàng ở đâu ?
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <strong>Địa chỉ:</strong> 140 Đ. Lê Trọng Tấn, Tây Thạnh, Tân Phú, Thành phố Hồ Chí Minh
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingFour">
                    <button id="IdC" class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                        Tôi Muốn Liên Hệ Với Quản Lý Thì Làm Như Thế Nào ?
                    </button>
                </h2>
                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <strong>Có rất nhiều cách:</strong><br> 1.Gọi điện thoại:

Bạn có thể tìm kiếm số điện thoại của quản lý trên website, danh thiếp hoặc qua bộ phận tiếp tân của tổ chức.
Khi gọi điện thoại, hãy trình bày rõ ràng lý do bạn muốn liên hệ với quản lý và lịch sự yêu cầu được gặp họ.
Nếu quản lý không có mặt, bạn có thể để lại lời nhắn hoặc yêu cầu được liên hệ lại.<br>
2. Gửi email:

Bạn có thể tìm kiếm địa chỉ email của quản lý trên website hoặc qua bộ phận tiếp tân của tổ chức.
Khi gửi email, hãy ghi rõ tiêu đề email tóm tắt nội dung liên hệ của bạn.
Trong phần nội dung email, hãy trình bày rõ ràng lý do bạn muốn liên hệ với quản lý và thông tin liên hệ của bạn.
Gửi email một cách lịch sự và chuyên nghiệp.<br>
3. Gặp trực tiếp:

Bạn có thể đến trực tiếp văn phòng của tổ chức và yêu cầu gặp quản lý.
Nên đặt lịch hẹn trước với quản lý để tránh trường hợp họ không có mặt.
Khi gặp trực tiếp, hãy trình bày rõ ràng lý do bạn muốn liên hệ với quản lý và thể hiện thái độ lịch sự, chuyên nghiệp.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingFive">
                    <button id="IdC" class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                        Tôi Mua Nhiều Sản Phẩm Có Được Giá Ưu Đãi Hay Khuyến Mãi Gì Không ?
                    </button>
                </h2>
                <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <strong>Tất nhiên là được rồi:</strong> Một số loại sản phẩm thường được bán với giá ưu đãi khi mua nhiều, ví dụ như:<br>
Sản phẩm đóng gói: Mua nhiều sản phẩm cùng loại sẽ được giảm giá so với mua lẻ từng sản phẩm.<br>
Sản phẩm kết hợp: Mua các sản phẩm khác nhau cùng một thương hiệu hoặc cùng một nhà cung cấp có thể được giảm giá.<br>
Thanh lý hàng tồn kho: Nhà cung cấp có thể bán thanh lý hàng tồn kho với giá rẻ hơn so với giá bán thông thường khi họ muốn giải phóng kho hàng.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingSix">
                    <button id="IdC" class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                        Cửa Hàng Có Địa Chỉ Ở Những Tỉnh Khách Không ?
                    </button>
                </h2>
                <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <strong>Có rất nhiều :</strong> Cửa hàng chúng tôi có tất cả trên các tỉnh trên toàn miền đất nước Việt Nam rồi ạ
                </div>
            </div>
        </div>
    </div>
</div>
<div class="flex h-screen flex-col bg-gray-100">
  <div class="bg-gradient-to-r from-blue-500 to-purple-500 py-4">
    <h1 class="text-center text-2xl font-bold text-white">Chat App - ClueMediator.com</h1>
  </div>
  <div class="flex-grow overflow-y-auto">
    <div class="flex flex-col space-y-2 p-4">
      <!-- Individual chat message -->
      <div class="flex items-center self-end rounded-xl rounded-tr bg-blue-500 py-2 px-3 text-white">
        <p>This is a sender message</p>
      </div>
      <div class="flex items-center self-start rounded-xl rounded-tl bg-gray-300 py-2 px-3">
        <p>This is a receiver message</p>
      </div>
    </div>
  </div>
  <div class="flex items-center p-4">
    <input type="text" placeholder="Type your message..." class="w-full rounded-lg border border-gray-300 px-4 py-2" />
    <button class="ml-2 rounded-lg bg-blue-500 px-4 py-2 text-white">Send</button>
  </div>
</div>

   
    @include('Shared/Footer')
    
