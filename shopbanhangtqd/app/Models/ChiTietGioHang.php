<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChiTietGioHang extends Model
{
    protected $table = 'chitietgiohang';
    public $timestamps = false;

    protected $fillable = [
        'MaGH',
        'MaSP',
        'SoLuong',
        'ThanhTien'
    ];

    protected $primaryKey = ['MaGH', 'MaSP']; //Lưu ý: Laravel không hỗ trợ composite keys một cách tự động.
    public $incrementing = false; // Chúng ta đang sử dụng chuỗi (VARCHAR) cho khóa chính, không tự tăng.

    public function gioHang()
    {
        return $this->belongsTo(GioHang::class, 'MaGH', 'MaGH');
    }

    // Nếu bạn có một Model cho Sản phẩm, bạn cũng nên thêm một mối quan hệ tới nó
    public function sanPham()
    {
        return $this->belongsTo(SanPham::class, 'MaSP', 'MaSP');
    }
}
