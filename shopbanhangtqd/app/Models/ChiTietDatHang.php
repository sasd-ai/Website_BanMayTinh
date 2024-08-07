<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChiTietDatHang extends Model
{
    use HasFactory;

    protected $table = 'chitietdathang';
    protected $primaryKey = ['MaDH', 'MaSP']; 
    public $incrementing = false; 
    public $timestamps = false;

    protected $fillable = [
        'MaDH',
        'MaSP',
        'SoLuong',
        'ThanhTien',
        'TinhTrang_BH',
    ];

    public function datHang()
    {
        return $this->belongsTo(DatHang::class, 'MaDH', 'MaDH');
    }

    public function sanPham()
    {
        return $this->belongsTo(SanPham::class, 'MaSP');
    }
    public function getSanPhamAttribute()
{
    return SanPham::find($this->MaSP);
}
}