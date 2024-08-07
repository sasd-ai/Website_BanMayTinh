<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoaiSanPham extends Model
{
    protected $table = 'loaisp';
    protected $primaryKey = 'maloai';
    public $timestamps = false;

    protected $fillable = [
        'tenloai',
        

        
    ];
}
