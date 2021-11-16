<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\QrcodeController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ReplyController;
use Illuminate\Support\Facades\Route;

Route::apiResource('/questions', QuestionController::class);
Route::apiResource('/categories', CategoryController::class);
Route::apiResource('/questions/{question}/replies', ReplyController::class);

Route::post('likes/{reply}', [LikeController::class, 'likeIt']);
Route::delete('likes/{reply}', [LikeController::class, 'unLikeIt']);

Route::middleware('JWT')->group(function () {
    Route::get('notifications', [NotificationsController::class, 'index']);
    Route::get('notifications/{notification}', [NotificationsController::class, 'markAsRead']);
});



Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('signup', [AuthController::class, 'signup']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
});


Route::get('qrcode', [QrcodeController::class, 'get']);
