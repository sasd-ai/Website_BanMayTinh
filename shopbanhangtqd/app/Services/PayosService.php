<?php

// App\Services\PayosService.php

namespace App\Services;

use GuzzleHttp\Client;

class PayosService
{
    private $client;

    public function __construct()
    {
        $this->client = new Client([
            // Base URL của PayOS API
            'base_uri' => 'https://api.payos.me/v1',
        ]);
    }

    public function createPayment($amount, $description)
    {
        $client = new Client();

        // Thiết lập và gửi yêu cầu POST
        try {
            $response = $client->request('POST', 'https://api.example.com/endpoint', [
                'headers' => [
                    'Client-ID' => 'f96c5d0e-d3ef-4308-94fc-cccd790ae6b9',
                    'API-Key' => '1e7dfc10-b1f4-47c0-aa18-556412261990',
                    // Thêm bất kì tiêu đề nào khác cần thiết
                ],
                'json' => [
                    'data' => 'value',
                    // Tạo và thêm checksum/signature tại đây nếu cần
                ],
            ]);
            
            // Xử lý phản hồi từ API
            $statusCode = $response->getStatusCode();
            $content = $response->getBody()->getContents();

            // Tiếp tục xử lý $content tại đây

        } catch (\GuzzleHttp\Exception\RequestException $e) {
            // Xử lý ngoại lệ khi gửi yêu cầu thất bại
            // Khả năng ghi log vào đây hoặc trả về phản hồi lỗi
        }

        // Trả về kết quả hoặc phản hồi lỗi
        return response()->json([
            'statusCode' => isset($statusCode) ? $statusCode : 500,
            'content' => isset($content) ? $content : 'An error occurred',
        ]);
    }
}