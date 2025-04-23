<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Luong extends Model
{
    use HasFactory;

    protected $table = 'luong';

    protected $primaryKey = ['id_nhan_vien', 'thang_nhan_luong'];
    public $incrementing = false;

    protected $fillable = [
        'id_nhan_vien',
        'so_tien_luong',
        'thang_nhan_luong',
    ];

    public $timestamps = false;

    public function nhanVien()
    {
        return $this->belongsTo(NhanVien::class, 'id_nhan_vien', 'id_nhan_vien');
    }
}