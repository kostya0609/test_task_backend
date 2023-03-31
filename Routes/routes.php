<?php
use Illuminate\Support\Facades\Route;
use App\Modules\TestTask\Controllers;

Route::prefix('test-task')
    ->group(function(){
        Route::post('create',Controllers\UserController::class.'@create');
        Route::post('list',Controllers\UserController::class.'@list');
    });

