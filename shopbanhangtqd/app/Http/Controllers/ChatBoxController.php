<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
class ChatBoxController extends Controller
{
    public function ChatBox(Request $request)
    {
        $question = $request->input('question');

        // Send request to Flask API
        $client = new Client();
        $response = $client->post('http://localhost:5000/api/products', [
            'json' => [
                'question' => $question
            ]
        ]);

        // Parse JSON from Flask response
        $products = json_decode($response->getBody()->getContents(), true);
        \Log::info('Response from API:', $products); // Thêm log để kiểm tra

        // Return JSON response to JavaScript
        return response()->json(['products' => $products]);
    }

    public function sendMessage(Request $request)
    {
        $accessToken = 'pat_HdIRdzyOvonlBFRJ0gPFliB5mPNuYsB6INzvqGHRjbYyjSLH18z7h9PROD2DVZed'; // Thay bằng mã thông báo truy cập của bạn
        $chatId = '7352496714307256327'; // Thay bằng ID cuộc trò chuyện của bạn

        $response = Http::withToken($accessToken)
            ->post('https://api.coze.com/v3/chat/message/send', [
                'chat_id' => $chatId,
                'content' => [
                    'type' => 'text',
                    'text' => $request->input('message')
                ]
            ]);

        if ($response->successful()) {
            return response()->json($response->json());
        } else {
            return response()->json(['error' => $response->json()], $response->status());
        }
    }
}