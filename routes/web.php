<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\StaffController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\ContactController;

// alias Admin controller to avoid collision with public controller
use App\Http\Controllers\Admin\ReservationController as AdminReservationController;
use App\Http\Controllers\ReservationController; // public controller



// =====================================
// PUBLIC PAGES
// =====================================
Route::controller(PageController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/welcome', 'welcome')->name('welcome');
    Route::get('/about', 'about')->name('about');
    Route::get('/contact', [ContactController::class, 'show'])->name('contact');
    Route::get('/menu', 'menu')->name('menu');
    Route::get('/service', 'service')->name('service');
Route::get('/reservation', [ReservationController::class, 'index'])
    ->name('reservation');
    Route::get('/testimonial', 'testimonial')->name('testimonial');

    // USER SUBMIT TESTIMONI (harus di luar admin!)
    Route::post('/testimonial/store', 'storeTestimonial')->name('testimonial.store');
});

// TAMBAHKAN ROUTE POST UNTUK MENANGANI FORM RESERVASI (tidak mengubah fungsi lain)
Route::post('/reservation/store', [ReservationController::class, 'store'])
    ->name('reservation.store');

// =====================================
// ADMIN AREA
// =====================================
Route::prefix('admin')->name('admin.')->group(function () {

    // Admin Auth
    Route::get('login', [\App\Http\Controllers\Admin\AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [\App\Http\Controllers\Admin\AuthController::class, 'login'])->name('login.post');
    Route::post('logout', [\App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('logout');

    // Protected admin routes
    Route::middleware('auth')->group(function () {

        Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

        Route::resource('staff', StaffController::class);
        // CAROUSEL ADMIN
        Route::resource('carousel', \App\Http\Controllers\CarouselController::class)
            ->names('carousel');
        // MENU CATEGORY ADMIN
        Route::resource('category', \App\Http\Controllers\Admin\CategoryController::class)
            ->names('category');

        Route::resource('menu', \App\Http\Controllers\Admin\MenuController::class);
        Route::resource('service', \App\Http\Controllers\Admin\ServiceController::class);
        // removed generic page resource; add per-page edit routes
        Route::get('about', [\App\Http\Controllers\Admin\AboutController::class, 'edit'])->name('about.edit');
        Route::put('about', [\App\Http\Controllers\Admin\AboutController::class, 'update'])->name('about.update');

        Route::get('contact', [\App\Http\Controllers\Admin\ContactController::class, 'edit'])->name('contact.edit');
        Route::put('contact', [\App\Http\Controllers\Admin\ContactController::class, 'update'])->name('contact.update');

        // ===== REPLACE ADMIN RESERVATION ROUTES =====
        // admin list (safe path) and actions
        Route::get('reservation/list', [AdminReservationController::class, 'index'])->name('reservation.index');
        Route::get('reservation/{reservation}', [AdminReservationController::class, 'show'])->name('reservation.show');

        Route::post('reservation/{reservation}/approve', [AdminReservationController::class, 'approve'])->name('reservation.approve');
        Route::post('reservation/{reservation}/cancel', [AdminReservationController::class, 'cancel'])->name('reservation.cancel');
        Route::delete('reservation/{reservation}', [AdminReservationController::class, 'destroy'])->name('reservation.destroy');

        // remove admin edit/update routes if you want edit removed from admin
        // (do not define Route::get('reservation') or Route::put('reservation') here)

        // add a safe GET redirect so visiting /admin/reservation goes to list
        Route::get('reservation', function () {
            return redirect()->route('admin.reservation.index');
        })->name('reservation.redirect');
        // ===== END ADMIN RESERVATION ROUTES =====

        // =====================================
        // TESTIMONIAL (RESOURCE)
        // =====================================
        Route::resource('testimonial', TestimonialController::class);

        // =====================================
        // TESTIMONIAL EXTRA ROUTES
        // =====================================
        Route::post('/testimonial/{id}/approve', [TestimonialController::class, 'approve'])
            ->name('testimonial.approve');

        Route::post('/testimonial/{id}/reject', [TestimonialController::class, 'reject'])
            ->name('testimonial.reject');

        Route::delete('/testimonial/{id}/delete', [TestimonialController::class, 'destroy'])
            ->name('testimonial.delete');
    });
});
