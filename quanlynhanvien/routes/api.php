<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\NhanVienApiController;
use App\Http\Controllers\Api\PhongBanApiController;


Route::get('/nhanviens', [NhanVienApiController::class, 'index']);
Route::get('/nhanviens/{id}', [NhanVienApiController::class, 'show']);
Route::post('/nhanviens', [NhanVienApiController::class, 'store']);


Route::get('/tong-luong-thang/{year}/{month}', [NhanVienApiController::class, 'getTotalSalaryByMonth']);
Route::get('/phong-ban/{phongbanId}/nhan-vien', [PhongBanApiController::class, 'getNhanVienByPhongBan']);