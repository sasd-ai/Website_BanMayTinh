<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class GioHang extends Model
{
    protected $table = 'giohang';
    protected $primaryKey = 'MaGH';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'MaGH',
        'MaKH',
        'TongTien'
    ];

    public function chiTietGioHang()
    {
        return $this->hasMany(ChiTietGioHang::class, 'MaGH', 'MaGH');
    }

    public function khachHang()
    {
        return $this->belongsTo(KhachHang::class, 'MaKH', 'MaKH');
    }
  

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->MaGH = 'MAGH'. Str::random(6); 
        });
    }
}
