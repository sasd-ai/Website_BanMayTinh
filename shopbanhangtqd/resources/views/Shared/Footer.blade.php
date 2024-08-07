<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbox</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqk1wYanYv2ctjPSG/LpqZRx1zhhV11i8moo04i2lL+hzwpgvA+oTPP7yy+Y3j/DsWA+rJL/u8=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="csrf-token" content="{{ csrf_token() }}">  <!-- Thêm meta tag CSRF token -->
</head>

<body>
    <style>
        /* ... styles ... */
        .list-ship {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .list-ship li {
            flex-basis: calc(25% - 10px);
            margin: 5px;
            list-style-type: none;
        }

        .list-pay {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .list-pay li {
            flex-basis: calc(25% - 10px);
            margin: 5px;
            list-style-type: none;
        }

        #back-to-top {
            display: none;
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 99999;
        }

        .Chat {
            position: fixed;
            bottom: 20px;
            left: 20px;
            z-index: 99999;
        }

        .chat-zalo,
        .chat-facebook,
        .call-hotline {
            display: block;
            margin-bottom: 6px;
            line-height: 0;
        }

   
    .chatbox {
  width: 350px;
  background-color: #fff;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
  border-radius: 10px;
  overflow: hidden;
  display: flex;
  flex-direction: column;
  position: fixed;
  bottom: 20px;
  right: 20px;
  z-index: 100000; 
  display: none; /* Ẩn chatbox mặc định */
}

.chatbox-header {
  background-color: red;
  color: #fff;
  padding: 15px 20px;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.chatbox-header h4 {
  margin: 0;
}

.chatbox-body {
  flex: 1;
  padding: 15px 20px;
  overflow-y: auto;
}

.messages {
  display: flex;
  flex-direction: column;
}

.message {
  margin-bottom: 10px;
  padding: 10px;
  border-radius: 10px;
  width: 200px; /* Giới hạn chiều rộng của tin nhắn */
  word-break: break-word; /* Cho phép bẻ dòng */
}

/* Style cho tin nhắn của user (bên phải) */
.message.user {
  align-self: flex-end;
  background-color: #007bff;
  color: #fff;
}

.message.bot {
  align-self: flex-start;
  background-color: #f1f1f1;
}

.chatbox-footer {
  display: flex;
  border-top: 1px solid #ddd;
  padding: 10px 20px;
  align-items: flex-end; /* Căn chỉnh các phần tử con về phía dưới cùng */
}

.chatbox-input {
  flex: 1;
  border: none;
  outline: none;
  padding: 10px;
  border-radius: 5px;
  margin-right: 10px;
}

.chatbox-send {
  background-color: red;
  color: #fff;
  border: none;
  padding: 10px 15px;
  border-radius: 5px;
  cursor: pointer;
  /* Loại bỏ margin-top */
}

.chatbox-send:hover {
  background-color: #0056b3;
}

.chatbox.collapsed {
  width: 60px;
  height: 60px;
  border-radius: 50%;
  padding: 0;
  animation: chatbox-pulse 1s infinite;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  background-color: red; /* Màu nền đỏ */
  display: flex;
  justify-content: center;
  align-items: center;
  color: white; /* Màu chữ trắng */
  /* Thêm style cho hình tròn */
  background-image: linear-gradient(to right, red, #ff6f00); /* Gradient màu hồng sang cam */
  box-shadow: 0 4px 8px rgba(255, 107, 0, 0.5); /* Bóng màu cam mờ */
}

/* Style cho nút "Tư vấn" */
.chatbox-expand-button {
  width: 70px;
  height: 70px;
  border-radius: 50%;
  background-color: red;
  color: white;
  display: flex;
  justify-content: center;
  align-items: center;
  font-weight: bold;
  cursor: pointer;
  position: fixed;
  bottom: 20px;
  right: 20px;
  z-index: 100000; /* Đảm bảo nút button ở trên chatbox */
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Thêm bóng cho nút */
  animation: chatbox-pulse 1s infinite;
  background-image: linear-gradient(to right, red, #ff6f00); /* Gradient màu hồng sang cam */
  box-shadow: 0 4px 8px rgba(255, 107, 0, 0.5); /* Bóng màu cam mờ */
}

.chatbox-expand-button:hover {
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.4); /* Tăng bóng khi hover */
}

@keyframes chatbox-pulse {
  0% {
    transform: scale(1);
    box-shadow: 0 4px 8px rgba(255, 107, 0, 0.5);
  }

  50% {
    transform: scale(1.1);
    box-shadow: 0 8px 16px rgba(255, 107, 0, 0.8);
  }

  100% {
    transform: scale(1);
    box-shadow: 0 4px 8px rgba(255, 107, 0, 0.5);
  }
}

.chatbox.collapsed .chatbox-toggle {
  display: block;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background-color: #007bff;
  color: #fff;
  border-radius: 50%;
  padding: 10px;
  font-size: 16px;
  cursor: pointer;
}

.chatbox-toggle.close {
  position: absolute;
  top: 10px;
  right: 10px;
  background: none;
  border: none;
  font-size: 20px;
  color: #fff;
  cursor: pointer;
  z-index: 1000000;
}

.chatbox-toggle {
  background: none;
  border: none;
  font-size: 20px;
  color: #fff;
  cursor: pointer;
}
.chatbox-body {
            flex: 1; /* Cho phép khung chat co giãn */
            padding: 15px 20px;
            overflow-y: auto; /* Thêm thanh cuộn dọc */
            height: 300px; /* Điều chỉnh chiều cao của khung chat */
        }
        
    </style>

    <div class="container-fluid mt-2" style="min-height: 100px; background-color: #F8F8F8; padding: 20px 0px; ">
        <div class="row">
            <div class="col-1"></div>
            <div class="col-3">
                <h5>Tổng đài hỗ trợ miễn phí</h5>
                <p style="font-size: 12px;">
                    Gọi mua hàng 1800.2097 (7h30 - 22h00) <br />
                    Gọi khiếu nại 1800.2063 (8h00 - 21h30) <br />
                    Gọi bảo hành 1800.2064 (8h00 - 21h00) <br />
                </p>

            </div>
            <div class="col-3">
                <h5>Đơn vị vận chuyển</h5>
                <ul class="list-ship">
                    <li>
                        <img src="https://theme.hstatic.net/200000722513/1001090675/14/ship_1.png?v=5117">
                    </li>
                    <li>
                        <img src="https://theme.hstatic.net/200000722513/1001090675/14/ship_2.png?v=5117">
                    </li>
                    <li>
                        <img src="https://theme.hstatic.net/200000722513/1001090675/14/ship_3.png?v=5117">
                    </li>
                    <li>
                        <img src="https://theme.hstatic.net/200000722513/1001090675/14/ship_4.png?v=5117">
                    </li>
                </ul>
                <h5>Cách thức thanh toán</h5>
                <ul class="list-pay">
                    <li>
                        <img src="https://theme.hstatic.net/200000722513/1001090675/14/pay_1.png?v=5117">
                    </li>
                    <li>
                        <img src="https://theme.hstatic.net/200000722513/1001090675/14/pay_2.png?v=5117">
                    </li>
                    <li>
                        <img src="https://theme.hstatic.net/200000722513/1001090675/14/pay_3.png?v=5117">
                    </li>
                    <li>
                        <img src="https://theme.hstatic.net/200000722513/1001090675/14/pay_4.png?v=5117">
                    </li>

                </ul>
            </div>
            <div class="col-2">
                <h5>Thông tin dịch vụ khác</h5>
                <p style="font-size: 12px;">
                    Khách hàng doanh nghiệp (B2B) <br />
                    Ưu đãi thanh toán <br />
                    Quy chế hoạt động <br />
                    Chính sách Bảo hành <br />
                    Liên hệ hợp tác kinh doanh <br />
                    Tuyển dụng <br />
                    Dịch vụ bảo hành điện thoại <br />
                    Dịch vụ bảo hành mở rộng <br />
                </p>
            </div>
            <div class="col-2">
                <h5>Kết nối với TQD</h5>
                <p style="font-size: 25px; display: flex; justify-content: space-between; width: 200px;">
                    <i class="fa-brands fa-facebook"></i>
                    <i class="fa-brands fa-square-instagram"></i>
                    <i class="fa-brands fa-youtube"></i>
                    <i class="fa-brands fa-tiktok"></i>
                    <i class="fa-brands fa-twitter"></i>
                </p>
                <div id="map">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.056848429508!2d106.62643781411664!3d10.80695806158611!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752be27d8b4f4d%3A0x92dcba2950430867!2zVHLGsOG7nW5nIMSQYcyjaSBob8yjYyBDw7RuZyBuZ2hp4buHcCBUaOG7sWMgcGjhuqltIFRow6BuaCBwaOG7kSBI4buTIENow60gTWluaA!5e0!3m2!1svi!2s!4v1569207231123!5m2!1svi!2s"
                        width="300" height="200"></iframe>
                </div>
            </div>
            <div class="col-1"></div>
        </div>

        <!-- <button class="chatbox-expand-button" id="chatbox-expand-button">Tư vấn</button> 

        <div class="chatbox">
    <div class="chatbox-header">
        <h4>ChatBox</h4>
        <button class="chatbox-toggle close">x</button> 
    </div>
    <div class="chatbox-body">
        <div class="messages">
         
        </div>
    </div>
    <div class="chatbox-footer">
        <input type="text" class="chatbox-input" placeholder="Type a message">
        <button class="chatbox-send">Send</button>
    </div>
</div>  -->

        <div class="Chat">
            <div class="chat-zalo">
                <a href="https://zalo.me/g/uqzcus824"> <img title="Chat Zalo"
                        src="{{asset ('Image/Icon/zalo-icon.png')}}" alt="zalo-icon" width="40" height="40" /></a>
            </div>
            <div class="chat-facebook">
                <a href="">
                    <img title="Chat Facebook" src="{{asset('Image/Icon/facebook-icon.png')}}" alt="facebook-icon"
                        width="40" height="40" />
                </a>
            </div>
            <div class="call-hotline">
                <a href="#"><img title="Call Hotline" src="{{asset('Image/Icon/call-icon.png')}}" alt="phone-icon"
                        width="40" height="40" /></a>
            </div>
        </div>
    </div>

    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    $(document).ready(function() {
            const chatbox = $('.chatbox');
            const chatboxToggle = $('.chatbox-toggle.close');
            const chatboxInput = $('.chatbox-input');
            const chatboxSend = $('.chatbox-send');
            const messages = $('.messages');
            const chatboxExpandButton = $('#chatbox-expand-button');
            let firstOpen = true; 

            // Open the chatbox
            chatboxExpandButton.click(function() {
                chatbox.show();
                chatboxExpandButton.hide();
                if (firstOpen) {
                    firstOpen = false;
                    addWelcomeMessage();
                }
            });

            // Close the chatbox
            chatboxToggle.click(function() {
                chatbox.hide();
                chatboxExpandButton.show();
            });

            // Send message
            chatboxSend.click(sendMessage);
            chatboxInput.keypress(function(event) {
                if (event.key === 'Enter') {
                    sendMessage();
                }
            });

            function sendMessage() {
                const messageText = chatboxInput.val().trim();
                if (messageText === '') return;

                // Add user's message to the chatbox
                const userMessage = $('<div>').addClass('message user').text(messageText);
                messages.append(userMessage);

                // Send the message to the server using AJAX
                $.ajax({
    url: "{{ route('chatbox') }}", 
    method: 'POST',
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
    },
    data: { question: messageText }, 
    success: function(response) {
    console.log('Response from API:', response); 
    console.log('Response.products:', response.products); 

    const botMessage = $('<div>').addClass('message bot');

    if (response.products.products && Array.isArray(response.products.products) && response.products.products.length > 0) { 
        response.products.products.forEach(product => {
            console.log('Product:', product); 
            if (product.hasOwnProperty('GiaBan') && product.hasOwnProperty('TenSP')) { 
                botMessage.append(`<p><b>${product.TenSP}</b></p>`);
                botMessage.append(`<p>Giá: ${product.GiaBan}</p><br>`); 
            } else {
                console.error('Missing fields in product object: ', product);
                botMessage.append(`<p>Lỗi: Dữ liệu sản phẩm không hợp lệ.</p>`);
            }
        });
    }else if(response.products.products && Array.isArray(response.products.products) && response.products.products.length ==0)
    {
         botMessage.text('Không tìm thấy dữ liệu');
    } 
    else if (response.error) {
        botMessage.text('Lỗi: ' + response.error);
    } else {
        botMessage.text('Lỗi: Không thể xử lý dữ liệu.');
    }

    messages.append(botMessage);
    messages.scrollTop(messages[0].scrollHeight);
},
    error: function(error) {
        console.error('Error sending message:', error);
        const botMessage = $('<div>').addClass('message bot').text('Lỗi kết nối.');
        messages.append(botMessage);
    }
});
                // Clear the input field
                chatboxInput.val('');
            }

            function addWelcomeMessage() {
                const botMessage1 = $('<div>').addClass('message bot').text('Xin chào quý khách!');
                messages.append(botMessage1);

                const botMessage2 = $('<div>').addClass('message bot').text('Quý khách cần tư vấn gì?');
                messages.append(botMessage2);
            }
        });
    </script> -->
    
    <!-- <script src="https://sf-cdn.coze.com/obj/unpkg-va/flow-platform/chat-app-sdk/0.1.0-beta.5/libs/oversea/index.js"></script>
      <script>
          new CozeWebSDK.WebChatClient({
            config: {
              bot_id: '7393767415475077128',
            },
            componentProps: {
              title: 'Coze',
            },
          });
      </script> -->
    
    
      <script src="https://sf-cdn.coze.com/obj/unpkg-va/flow-platform/chat-app-sdk/0.1.0-beta.5/libs/oversea/index.js"></script>
      <script>
          new CozeWebSDK.WebChatClient({
            config: {
              bot_id: '7393900196486643720',
            },
            componentProps: {
              title: 'Coze',
            },
          });
      </script>
    
    
</body>

</html>