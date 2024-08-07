<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KhuyenMai;
class KhuyenMaiController extends Controller
{
    
    public function getKhuyenMai()
    {
        $khuyenMais = KhuyenMai::all();
        // Truyền biến $khuyenMais vào view 'ThanhToan.ThanhToan'.
        return view('ThanhToan.ThanhToan', compact('khuyenMais'));
    }
}
