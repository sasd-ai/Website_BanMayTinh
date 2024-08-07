<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SanPham extends Model
{
    protected $table = 'sanpham';
    protected $primaryKey = 'masp';
    public $timestamps = false;

    protected $fillable = [
        'tensp',
        'maloai',
        'hinhanh',
        'giadexuat',
        'giaban',
        'mota',
        'tg_baohanh',     
    ];
}
