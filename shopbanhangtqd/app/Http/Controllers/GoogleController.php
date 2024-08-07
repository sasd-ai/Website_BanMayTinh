<?php
  
namespace App\Http\Controllers;
  
use App\Models\KhachHang; // Import model KhachHang
use App\Models\TaiKhoanKH; // Import model TaiKhoanKH
use Illuminate\Http\Request; // Import class Request từ Illuminate
use Laravel\Socialite\Facades\Socialite; // Import facade Socialite
use Exception; // Import class Exception
use App\Models\User; // Import model User
use Illuminate\Support\Facades\Auth; // Import facade Auth từ Illuminate
  
class GoogleController extends Controller // Khai báo class GoogleController kế thừa từ Controller
{
    /**
     * Redirect user to Google for authentication.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirectToGoogle(): \Illuminate\Http\RedirectResponse // Phương thức chuyển hướng người dùng đến Google để xác thực
    {
        return Socialite::driver('google')->redirect(); // Sử dụng Socialite để chuyển hướng người dùng đến Google
    }
        
    /**
     * Handle callback from Google.
     *
     * @return void
     */
    public function handleGoogleCallback() // Phương thức xử lý callback từ Google
    {
        try {
            $user = Socialite::driver('google')->user(); // Lấy thông tin người dùng từ Google
        
          
            $khachHang = KhachHang::where('Email', $user->email)->first(); // Kiểm tra xem khách hàng đã tồn tại qua email chưa
        
            if (!$khachHang) {
               
                $khachHang = KhachHang::create([
                    'TenKH' => $user->name,
                    'Email' => $user->email,
                ]);
            }
        
          
            $taiKhoan = TaiKhoanKH::firstOrCreate(
                ['TaiKhoan' => $user->email],
                [
                    'MaKH' => $khachHang->MaKH, 
                    'MatKhau' => encrypt('123456dummy'), 
                ]
            );

            Auth::login($taiKhoan); // Đăng nhập người dùng vào hệ thống
        
            return redirect()->intended('/'); // Chuyển hướng người dùng đến trang chính
        
        } catch (Exception $e) {
            dd($e->getMessage()); // In ra thông báo lỗi nếu có ngoại lệ xảy ra
        }
    }
}
