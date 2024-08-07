<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class DatHang extends Model
{
    use HasFactory;

    protected $table = 'dathang';
    protected $primaryKey = 'MaDH';
    public $incrementing = false; 
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'MaKH',
        'MaKM',
        'TongTien',
        'TienKM',
        'ThanhTien',
        'GhiChu',
        'DiaChi',
        'TenKH',
        'SDT',
        'NgayDatHang',
        'TinhTrang_TT',
        'TinhTrang_DH',
    ];
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->MaDH = 'DH'. Str::random(8); 
        });
    }
    public function chiTietDatHang()
    {
        return $this->hasMany(ChiTietDatHang::class, 'MaDH', 'MaDH');
    }

}