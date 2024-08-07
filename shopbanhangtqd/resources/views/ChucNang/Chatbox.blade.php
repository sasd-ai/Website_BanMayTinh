<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbox</title>
    <style>
        /* Add your CSS here */
        .chatbox {
            width: 350px;
            height: 400px;
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
        }
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
            background-color: red;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            background-image: linear-gradient(to right, #f06292, #ff6f00);
            box-shadow: 0 4px 8px rgba(255, 107, 0, 0.5);
        }
        .chatbox-expand-button {
            background: none;
            border: none;
            font-size: 12px;
            font-weight: bold;
            cursor: pointer;
            color: #fff;
            text-shadow: 0 0 5px rgba(255, 255, 255, 0.5);
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
    </style>
</head>
<body>
<div class="chatbox">
    <div class="chatbox-header">
        <h4>ChatBox</h4>
        <button class="chatbox-toggle close">x</button>
    </div>
    <div class="chatbox-body">
        <div class="messages">
            <!-- Messages will appear here -->
        </div>
    </div>
    <div class="chatbox-footer">
        <input type="text" class="chatbox-input" placeholder="Type a message">
        <button class="chatbox-send">Send</button>
    </div>
    <button class="chatbox-expand-button" id="chatbox-expand-button">Tư vấn</button>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const chatbox = document.querySelector('.chatbox');
    const chatboxToggle = document.querySelector('.chatbox-toggle.close');
    const chatboxInput = document.querySelector('.chatbox-input');
    const chatboxSend = document.querySelector('.chatbox-send');
    const messages = document.querySelector('.messages');
    const chatboxExpandButton = document.getElementById('chatbox-expand-button');

    // Khởi tạo chatbox ở trạng thái mở
    chatbox.classList.remove('collapsed');

    // Sự kiện click cho nút đóng
    chatboxToggle.addEventListener('click', function () {
        chatbox.classList.add('collapsed');
        chatboxToggle.style.display = 'none';
        chatboxExpandButton.style.display = 'block';
    });

    // Sự kiện click cho nút mở
    chatboxExpandButton.addEventListener('click', function() {
        chatbox.classList.remove('collapsed');
        chatboxToggle.style.display = 'block';
        chatboxExpandButton.style.display = 'none';
    });

    chatboxInput.addEventListener('keypress', function (event) {
        if (event.key === 'Enter') {
            sendMessage();
        }
    });

    chatboxSend.addEventListener('click', sendMessage);

    function sendMessage() {
        const messageText = chatboxInput.value.trim();
        if (messageText === '') return;

        // Thêm tin nhắn của người dùng vào chatbox
        const userMessage = document.createElement('div');
        userMessage.classList.add('message', 'user');
        userMessage.textContent = messageText;
        messages.appendChild(userMessage);

        // // Gửi tin nhắn đến Coze API
        // const accessToken = 'pat_HdIRdzyOvonlBFRJ0gPFliB5mPNuYsB6INzvqGHRjbYyjSLH18z7h9PROD2DVZed'; // Thay thế bằng mã thông báo truy cập của bạn
        // const chatId = '7352496714307256327'; // ID cuộc trò chuyện của bạn

        // fetch('https://api.coze.com/v3/chat/message/send', {
        //     method: 'POST',
        //     headers: {
        //         'Authorization': `Bearer ${accessToken}`,
        //         'Content-Type': 'application/json'
        //     },
        //     body: JSON.stringify({
        //         chat_id: chatId,
        //         content: {
        //             type: 'text',
        //             text: messageText
        //         }
        //     })
        // })
        // .then(response => {
        //     if (!response.ok) {
        //         throw new Error('Network response was not ok ' + response.statusText);
        //     }
        //     return response.json();
        // })
        // .then(data => {
        //     console.log('API response:', data);
        //     if (data.code === 0 && data.data) {
        //         const botMessage = document.createElement('div');
        //         botMessage.classList.add('message', 'bot');
        //         botMessage.textContent = data.data.content;
        //         messages.appendChild(botMessage);

        //         // Cuộn xuống cuối chatbox
        //         messages.scrollTop = messages.scrollHeight;
        //     } else {
        //         console.error('Lỗi khi nhận phản hồi từ Coze API:', data.message);
        //     }
        // })
        // .catch(error => {
        //     console.error('Lỗi khi gửi tin nhắn:', error);
        // });

        // // Xóa input sau khi gửi
        // chatboxInput.value = '';
        // Gửi tin nhắn đến Coze API
const accessToken = 'pat_7s3QMkQGjiurqL2W0cplKgooZ0M7FfKlkka6ofWLJaZjfSDDX3BqV0XcOWhv8VeY'; // Thay thế bằng mã thông báo truy cập của bạn
const botId = '7393767415475077128'; // ID của bot của bạn
const userId = '7352496714307256327'; // Xác định người dùng hiện đang tương tác với Bot, có thể là bất kỳ giá trị duy nhất nào

fetch('https://api.coze.com/open_api/v2/chat', {
        method: 'POST',
        headers: {
            'Authorization': `Bearer ${accessToken}`,
            'Content-Type': 'application/json',
            'Accept': '*/*',
            'Host': 'api.coze.com',
            'Connection': 'keep-alive'
        },
        body: JSON.stringify({
            conversation_id: '123', // ID cuộc trò chuyện có thể cần phải thay đổi
            bot_id: botId,
            user: userId,
            query: messageText,
            stream: false
        })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok ' + response.statusText);
        }
        return response.json();
    })
    .then(data => {
        console.log('API response:', data);
        if (data.code === 0 && data.messages) {
            data.messages.forEach(message => {
                if (message.role === 'assistant') {
                    const botMessage = document.createElement('div');
                    botMessage.classList.add('message', 'bot');
                    botMessage.textContent = message.content;
                    document.querySelector('#messages').appendChild(botMessage);
                }
            });


        // Cuộn xuống cuối chatbox
        messages.scrollTop = messages.scrollHeight;
    } else {
        console.error('Lỗi khi nhận phản hồi từ Coze API:', data.message);
    }
})
.catch(error => {
    console.error('Lỗi khi gửi tin nhắn:', error);
});

// Xóa input sau khi gửi
chatboxInput.value = '';

    }
});

</script>
</body>
</html> 

