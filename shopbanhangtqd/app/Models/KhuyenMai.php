<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KhuyenMai extends Model
{
    use HasFactory;
   
    
    
    protected $table = 'khuyenmai';

    protected $primaryKey = 'MaKM';
    public $incrementing = false;

    // Vô hiệu hóa tính năng timestamps nếu bảng của bạn không có các trường
    // `created_at` và `updated_at`
    public $timestamps = false;

    // Định nghĩa các trường có thể được mass assignable
    protected $fillable = [
        'MaKM',
        'TenKM',
        'GiaTri',
    ];

}
