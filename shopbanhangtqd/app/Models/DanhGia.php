<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class DanhGia extends Model
{
    protected $table = 'danhgia'; 
    public $incrementing = false;
    protected $primaryKey = 'madg';
    public $timestamps = false; 
    protected $fillable = ['masp', 'makh', 'noidungdanhgia', 'ngaygiodanhgia', 'sosao','hinhanh'];

    public function sanpham()
    {
        return $this->belongsTo(SanPham::class, 'masp', 'MaSP');
    }

    public function khachhang()
    {
        return $this->belongsTo(KhachHang::class, 'makh', 'MaKH');
    }
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->madg = 'madg'. Str::random(6); 
        });
    }
}
