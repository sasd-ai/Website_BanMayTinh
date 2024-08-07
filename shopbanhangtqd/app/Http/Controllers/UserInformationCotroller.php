<?php

namespace App\Http\Controllers;

use App\Models\KhachHang;
use Auth;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;

class UserInformationCotroller extends Controller
{
    
    public function getUserInformation()
    {
        $user = Auth::user();
        return view('UserInformation.UserInformation', ['user' => $user]);
    }

    public function updateInformation(Request $request)
    {
        $request->validate([
            'TenKH' => 'required|string|max:255',
            'SDT' => 'required|string|max:255',
        ]);

        // Lấy thông tin khách hàng từ user đang đăng nhập
        $khachHang = auth()->user()->khachhang;

        // Lấy MaKH của người dùng đang đăng nhập
        $maKH = auth()->user()->MaKH;

        // Cập nhật thông tin khách hàng
        $khachHang = KhachHang::where('MaKH',$maKH)->update([        
            'TenKH' => $request->TenKH,
            'SDT'=>$request->SDT,
          
        ]);
        return redirect()->back()->with('success', 'Thông tin khách hàng đã được cập nhật.');
        
    }
}