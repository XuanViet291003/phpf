<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NhanVien extends Model
{
    use HasFactory;
    protected $table = 'nhan_vien';

    protected $fillable = [
        'ho_ten',
        'ngay_sinh',
        'gioi_tinh',
        'so_dien_thoai',
        'email',
        'dia_chi',
        'avatar',
    ];

    // Nếu khóa chính không phải là 'id'
    protected $primaryKey = 'id_nhan_vien';
}