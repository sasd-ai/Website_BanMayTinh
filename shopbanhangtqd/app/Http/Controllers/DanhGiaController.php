<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DanhGia;
use App\Models\DatHang;
use App\Models\ChiTietDatHang;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DanhGiaController extends Controller
{
    public function store(Request $request)
    {
        $maKH = auth()->user()->khachhang->MaKH;

       
        $request->validate([
            'masp' => 'required',
            'sosao' => 'required|integer|min:1|max:5',
            'noidungdanhgia' => 'required|string',
            'hinhanh' => 'sometimes|image|mimes:jpg,jpeg,png,gif|max:5000', 
        ]);

        $masp = $request->input('masp');

       
        $orderedProduct = ChiTietDatHang::whereHas('dathang', function($query) use ($maKH) {
            $query->where('MaKH', $maKH);
        })->where('MaSP', $masp)->exists();

        if (!$orderedProduct) {
            return back()->withErrors(['Bạn chưa mua sản phẩm này nên không thể đánh giá.'])->withInput();
        }

       
        $hinhanhPath = null;
        if ($request->hasFile('hinhanh')) {
            $hinhanhPath = $request->file('hinhanh')->store('danhgia', 'public');
        }

      
        DanhGia::create([
            'masp' => $masp,
            'makh' => $maKH,
            'noidungdanhgia' => $request->input('noidungdanhgia'),
            'ngaygiodanhgia' => Carbon::now('Asia/Ho_Chi_Minh'),
            'sosao' => $request->input('sosao'),
            'hinhanh' => $hinhanhPath, 
        ]);

        return back()->with('success', 'Cảm ơn bạn đã gửi đánh giá.');
    }
}
?>