<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForgotPasswordController;

use App\Models\Product;

Route::get('/', function () {
    $showcaseProducts = Product::whereIn('slug', ['capcut', 'chatgpt', 'gemini', 'canva'])->get();
    if ($showcaseProducts->isEmpty()) {
        $showcaseProducts = Product::take(4)->get();
    }

    $products = Product::whereIn('slug', ['capcut', 'chatgpt', 'canva'])->get();
    if ($products->isEmpty()) {
        $products = Product::take(3)->get();
    }

    return view('welcome', compact('showcaseProducts', 'products'));
});

Route::get('/products', function () {
    $products = Product::all();
    return view('products', compact('products'));
})->name('products.index');

Route::get('/product/{slug}', function ($slug) {
    $product = Product::where('slug', $slug)->first();
    if (!$product) {
        $product = Product::first();
        if (!$product) {
            return redirect('/');
        }
        return redirect()->route('product.show', $product->slug);
    }
    $related = Product::where('slug', '!=', $product->slug)->take(3)->get();
    return view('product-detail', compact('product', 'related', 'slug'));
})->name('product.show');

// Posts routes
Route::get('/posts', [\App\Http\Controllers\PostController::class, 'index'])->name('posts.index');
Route::get('/post/{slug}', [\App\Http\Controllers\PostController::class, 'show'])->name('posts.show');

// Auth routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Google OAuth
Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('google.callback');

// Password Reset Routes
Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ForgotPasswordController::class, 'reset'])->name('password.update');

// Admin Protected Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin-dashboard');
    })->name('dashboard');

    Route::resource('products', \App\Http\Controllers\AdminProductController::class);
    Route::resource('posts', \App\Http\Controllers\AdminPostController::class);
    
    // Admin orders management routes
    Route::get('/orders', [\App\Http\Controllers\AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [\App\Http\Controllers\AdminOrderController::class, 'show'])->name('orders.show');
    Route::put('/orders/{id}/status', [\App\Http\Controllers\AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');

    // Admin settings routes
    Route::get('/settings', [\App\Http\Controllers\AdminSettingsController::class, 'show'])->name('settings.show');
    Route::put('/settings', [\App\Http\Controllers\AdminSettingsController::class, 'update'])->name('settings.update');
});

// User Protected Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/orders', [\App\Http\Controllers\UserController::class, 'orders'])->name('orders.index');
    Route::get('/profile', [\App\Http\Controllers\UserController::class, 'profile'])->name('profile.edit');
    Route::post('/profile', [\App\Http\Controllers\UserController::class, 'updateProfile'])->name('profile.update');
    
    // Client Checkout routes
    Route::get('/checkout', [\App\Http\Controllers\OrderController::class, 'showCheckout'])->name('checkout');
    Route::post('/checkout', [\App\Http\Controllers\OrderController::class, 'placeOrder']);
    Route::get('/checkout/thankyou/{id}', [\App\Http\Controllers\OrderController::class, 'thankYou'])->name('checkout.thankyou');
    Route::get('/checkout/success/{id}', [\App\Http\Controllers\OrderController::class, 'success'])->name('checkout.success');
    Route::get('/api/orders/{id}/status', [\App\Http\Controllers\OrderController::class, 'getStatus']);
    Route::post('/api/orders/{id}/cancel', [\App\Http\Controllers\OrderController::class, 'cancel']);

    // Review store route
    Route::post('/product/{id}/review', function (\Illuminate\Http\Request $request, $id) {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:5',
        ]);
        
        $product = \App\Models\Product::findOrFail($id);
        
        \App\Models\Review::create([
            'product_id' => $product->id,
            'user_id' => auth()->id(),
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);
        
        // Recalculate average rating & review count using a base of 50 reviews of 5.0 stars
        $reviews = $product->reviews();
        $dbCount = $reviews->count();
        $dbSum = $reviews->sum('rating');
        
        $baseCount = 50; // base reviews of 5 stars by default
        $baseSum = 50 * 5.0;
        
        $totalCount = $dbCount + $baseCount;
        $totalSum = $dbSum + $baseSum;
        
        $newRating = round($totalSum / $totalCount, 1);
        
        $product->update([
            'rating' => $newRating,
            'review_count' => $totalCount
        ]);
        
        return redirect()->back()->with('success_review', 'Cảm ơn bạn đã gửi đánh giá sản phẩm!');
    })->name('product.review.store');
});

// SePay webhook callback endpoint (public API)
Route::post('/webhook/sepay', [\App\Http\Controllers\SePayWebhookController::class, 'handle']);
