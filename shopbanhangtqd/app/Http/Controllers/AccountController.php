<?php

namespace App\Http\Controllers;

use App\Models\KhachHang;
use App\Models\TaiKhoanKH;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Auth\Authenticatable;
class AccountController extends Controller
{
    
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|unique:KhachHang,Email',
        ]);

        $khachhang = new KhachHang();
        $khachhang->TenKH = $request->name;
        $khachhang->Email = $request->email;
        $khachhang->save();
        
        $taikhoankh = new TaiKhoanKH();
        $taikhoankh->TaiKhoan = $khachhang->Email;
        $taikhoankh->MatKhau = Hash::make($request->password);
        $taikhoankh->MaKH = $khachhang->MaKH;
        $taikhoankh->save();

        return redirect()->route('DangNhap');
    }

    public function checkLogin(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $user = TaiKhoanKH::where('TaiKhoan', $email)->first();

        if ($user && Hash::check($password, $user->MatKhau)) {
            auth()->login($user); 
            return redirect()->route('welcome');
        }
    }
    public function logout()
    {
        auth()->logout();
        return redirect()->route('welcome');
    }
}
