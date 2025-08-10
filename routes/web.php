<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WebController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ReservationController;
use App\Http\Middleware\Subscribed;
use App\Http\Middleware\NotSubscribed;


// ✅ ← 認証不要の「会社概要ページ」はここに置く
Route::get('/company', [CompanyController::class, 'index'])->name('company.index');

// トップページ
Route::get('/', [WebController::class, 'index'])->name('top');

// 公開用：店舗一覧・詳細
Route::get('/shops', [ShopController::class, 'index'])->name('shops.index');
Route::get('/shops/{shop}', [ShopController::class, 'show'])->name('shops.show');
Route::get('/shops/{shop}/reviews', [ReviewController::class, 'index'])->name('shops.reviews.index');

// 認証関連ルート
require __DIR__.'/auth.php';


// 認証ユーザー用ルート
Route::middleware(['auth', 'verified'])->group(function () {

    // 店舗登録・編集等（index, showは除外）
    Route::resource('shops', ShopController::class)->except(['index', 'show']);

    // レビュー登録
    Route::post('reviews', [ReviewController::class, 'store'])->name('reviews.store');

    // お気に入り登録・削除
    Route::post('favorites/{shop_id}', [FavoriteController::class, 'store'])->name('favorites.store');
    Route::delete('favorites/{shop_id}', [FavoriteController::class, 'destroy'])->name('favorites.destroy');

    // ユーザーマイページ関連
    Route::controller(UserController::class)->group(function () {
        Route::get('users/mypage', 'mypage')->name('mypage');
        Route::get('users/mypage/edit', 'edit')->name('mypage.edit');
        Route::put('users/mypage', 'update')->name('mypage.update');
        Route::get('users/mypage/password/edit', 'edit_password')->name('mypage.edit_password');
        Route::get('users/mypage/favorite', 'favorite')->name('mypage.favorite');
        Route::delete('users/mypage/delete', 'destroy')->name('mypage.destroy');
    });

    // 予約一覧・キャンセル
    Route::resource('reservations', ReservationController::class)->only(['index', 'destroy']);

    // 店舗ごとの予約作成・登録
    Route::resource('shops.reservations', ReservationController::class)->only(['create', 'store']);

    // サブスクリプション自動振り分け
    Route::get('subscription', function (Request $request) {
        if ($request->user()?->subscribed('premium_plan')) {
            return redirect()->route('subscription.edit');
        } else {
            return redirect()->route('subscription.create');
        }
    })->name('subscription');

    // サブスク退会ページ移行ルート
    Route::middleware(Subscribed::class)->group(function () {
        Route::get('subscription/edit', [SubscriptionController::class, 'edit'])->name('subscription.edit');
        Route::patch('subscription', [SubscriptionController::class, 'update'])->name('subscription.update');
        Route::get('subscription/cancel', [SubscriptionController::class, 'cancel'])->name('subscription.cancel');
        Route::delete('subscription', [SubscriptionController::class, 'destroy'])->name('subscription.destroy');
    });

    // サブスク未加入ユーザー向けルート（登録）
    Route::middleware(NotSubscribed::class)->group(function () {
        Route::get('subscription/create', [SubscriptionController::class, 'create'])->name('subscription.create');
        Route::post('subscription', [SubscriptionController::class, 'store'])->name('subscription.store');
    });
    });
