<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhongBan extends Model
{
    use HasFactory;

    protected $table = 'phong_ban';
    protected $primaryKey = 'id_phong_ban';

    protected $fillable = [
        'ten_phong_ban',
    ];
    protected $guarded = ['id_phong_ban'];



    public function nhanVien()
    {
        return $this->belongsToMany(NhanVien::class, 'nhan_vien_phong_ban', 'id_phong_ban', 'id_nhan_vien')
                    ->withPivot('chuc_vu'); 
    }
}