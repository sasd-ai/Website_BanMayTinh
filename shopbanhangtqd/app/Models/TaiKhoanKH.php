<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class TaiKhoanKH extends Authenticatable
{
    use Notifiable;
    protected $table = 'taikhoankh';
    protected $fillable = ['google_id', 'TaiKhoan', 'MaKH', 'MatKhau'];
    

    protected $hidden = [
        'MatKhau', 'remember_token',
    ];

    public function getAuthPassword()
    {
        return $this->MatKhau; 
    }
    public function getAuthIdentifierName()
    {
        return 'TaiKhoan'; 
    }
    public function khachhang() 
{
    return $this->hasOne(KhachHang::class, 'MaKH', 'MaKH');
}

}
