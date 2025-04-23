<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;


//do thời gian thực thi ứng dụng
define('LARAVEL_START', microtime(true));


//Nếu có file maintenance.php, thì dừng xử lý ứng dụng và hiển thị trang bảo trì
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// tự động nạp các class, thư viện mà bạn đã cài bằng Composer
require __DIR__.'/../vendor/autoload.php';


// Tạo instance của Laravel Application
//Đăng ký các service provider, alias, cấu hình...
/** @var Application $app */
$app = require_once __DIR__.'/../bootstrap/app.php';


//Nhận và xử lý request từ trình duyệt
//Trả về kết quả (HTML hoặc JSON)
$app->handleRequest(Request::capture());
