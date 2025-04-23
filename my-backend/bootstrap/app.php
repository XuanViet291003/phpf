<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
//cấu hình middleware (lọc request).
use Illuminate\Foundation\Configuration\Middleware;

//basePath: chỉ định thư mục gốc của dự án
return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php', //nơi định nghĩa route cho trình duyệt (HTTP GET/POST...)
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up', //là endpoint kiểm tra
    )

    // noi 
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
