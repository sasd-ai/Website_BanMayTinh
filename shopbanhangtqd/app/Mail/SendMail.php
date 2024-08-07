<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    public $maDH;
    public $orderDetails;
    public $datHang;

    public function __construct($maDH, $orderDetails, $datHang)
    {
        $this->maDH = $maDH;
        $this->orderDetails = $orderDetails;
        $this->datHang = $datHang;
    }

    public function build()
    {
        return $this->view('sendmail')
            ->with([
                'maDH' => $this->maDH,
                'orderDetails' => $this->orderDetails,
                'datHang' => $this->datHang, // Truyền dữ liệu đơn hàng vào view
            ])
            ->subject('Xác nhận đơn hàng đã thanh toán của bạn');
    }

}
