<?php

// App\Http\Controllers\PaymentController.php

namespace App\Http\Controllers;

use App\Services\PayosService;
use Illuminate\Http\Request;
use Payos\Payos;
class PaymentController extends Controller
{
    protected $payosService;

    public function __construct(PayosService $payosService)
    {
        $this->payosService = $payosService;
    }

    public function storeonline(Request $request)
    {
        $paymentData = $this->payosService->createPayment($request->amount, $request->description);

        $qrCodeUrl = $paymentData['qr_code_url'];

        // Chuyển 'qrCodeUrl' tới view để hiển thị QR Code
        return view('ThanhToan.ThanhToan', compact('qrCodeUrl'));
    }
}