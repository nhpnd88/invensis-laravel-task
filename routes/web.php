<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Models\Page;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});
Auth::routes();

Route::middleware('auth')->group(function () {
    Route::resource('/admin/pages', PageController::class);
    Route::get('/admin/pages', [PageController::class, 'index'])->name('pages.index');
    Route::get('/products', [PageController::class, 'product'])->name('pages.product');
    Route::get('/admin/pages/create', [PageController::class, 'create'])->name('pages.create');
    Route::post('/admin/pages', [PageController::class, 'store'])->name('pages.store');
    Route::get('/admin/pages/{page}/edit', [PageController::class, 'edit'])->name('pages.edit');
    Route::put('/admin/pages/{page}', [PageController::class, 'update'])->name('pages.update');
    Route::delete('/admin/pages/{page}', [PageController::class, 'destroy'])->name('pages.destroy');
});

Route::get('/home', function () {
    $page = Page::where('title', 'Home')->first();
    if (!$page) {
        abort(404, 'Home page not found');
    }
    return view('frontend.home', compact('page'));
})->name('home');

Route::get('/contact', function () {
    $page = Page::where('title', 'Contact')->first();
    if (!$page) {
        abort(404, 'Contact page not found');
    }
    return view('frontend.contact', compact('page'));
})->name('contact');



Route::get('/payment', function () {
    $page = Page::where('type', 'Payment Page')->first();
    if (!$page) {
        abort(404, 'Payment page not found');
    }
    return view('frontend.payment', compact('page'));
})->name('payment');

Route::post('/create-payment-intent', [PaymentController::class, 'createPaymentIntent'])->name('payment.intent');
Route::get('/payment/success', [PaymentController::class, 'paymentSuccess'])->name('payment.success');
Route::get('/payment/failure', [PaymentController::class, 'paymentFailure'])->name('payment.failure');



