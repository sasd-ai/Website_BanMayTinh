<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class KhachHang extends Model
{
    protected $table = 'khachhang';
    protected $primaryKey = 'makh';
    public $timestamps = false;

    protected $fillable = [
        'TenKH',
        'SDT',
        'Email',
        

        
    ];
    public $incrementing = false;
    //tự động tạo MaKH
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->MaKH = 'KH'. Str::random(8); 
        });
    }
    public function datHang() {
        return $this->hasMany(DatHang::class, 'MaKH');
    }
}
