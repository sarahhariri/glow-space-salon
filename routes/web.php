<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GiftCardController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TeamController;
use Illuminate\Support\Facades\Route;
//General Routes
Route::get('/', [MainController::class, 'home'])->name('home');
Route::get('/gift-cards', [GiftCardController::class, 'giftCards'])->name('giftCards');
Route::post('/gift-cards', [GiftCardController::class, 'store'])->name('giftCards.store');
Route::get('/book-appointment', [AppointmentController::class, 'create'])->name('appointments.create');
Route::post('/book-appointment', [AppointmentController::class, 'store'])->name('appointments.store');
Route::get('/available-times', [AppointmentController::class, 'availableTime'])->name('appointments.availableTimes');
Route::get( '/services/{service}/team-members',  [AppointmentController::class, 'teamMembersByService'])->name('appointments.teamMembersByService');
Route::get( '/team-members/{member}/services',  [AppointmentController::class, 'servicesByTeamMember'])->name('appointments.servicesByTeamMember');


//Guest Routes
Route::middleware('guest')->group(function (){
Route::get('/register', [AuthController::class, 'registerPage'])->name('auth.register.page');
Route::post('/register', [AuthController::class, 'register'])->name('auth.register.action');
Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login.action');
});

//User Routes
Route::middleware('auth')->group(function (){
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::post('/reviews', [ReviewController::class, 'saveReview'])->name('reviews.store');


});

Route::middleware(['auth', 'admin'])->group(function (){
Route::get('/admin/dashboard', [AdminController::class, 'home'])->name('admin.home');
Route::get('/admin/users/all', [AdminController::class, 'allUsers'])->name('admin.users.all');
Route::post('/admin/users/{user}/delete', [AdminController::class, 'deleteUser'])->name('admin.users.delete')->middleware('can:delete,user');
Route::get('/admin/users/active', [AdminController::class, 'activeUsers'])->name('admin.users.active');
Route::get('/admin/users/deleted', [AdminController::class, 'deletedUsers'])->name('admin.users.deleted');
Route::post('/admin/users/{id}/forceDelete', [AdminController::class, 'forceDeleteUser'])->name('admin.users.forceDelete');
Route::post('/admin/users/{user}/makeAdmin', [AdminController::class, 'makeAdmin'])->name('admin.users.makeAdmin');
Route::post('/admin/users/{id}/restore', [AdminController::class, 'restoreUser'])->name('admin.users.restore');
Route::get('/admin/slides', [AdminController::class, 'slides'])->name('admin.slides');
Route::post('/admin/slides/add', [AdminController::class, 'addSlides'])->name('admin.slides.add');
Route::post('/admin/slides/{slide}/delete', [AdminController::class, 'deleteSlide'])->name('admin.slides.delete');

Route::get('/admin/about-images', [AdminController::class, 'aboutImages'])->name('admin.aboutImages');
Route::post('/admin/about-images/add', [AdminController::class, 'addaboutImages'])->name('admin.aboutImages.add');
Route::post('/admin/about-images/{aboutImage}/delete', [AdminController::class, 'deleteaboutImages'])->name('admin.aboutImages.delete');

Route::get('/admin/reviews', [ReviewController::class, 'reviews'])->name('admin.reviews');
Route::post('/admin/reviews/{review}/approve', [ReviewController::class, 'approveReview'])->name('admin.reviews.approve');
Route::post('/admin/reviews/{id}/delete', [ReviewController::class, 'deleteReview'])->name('admin.reviews.delete');

Route::get('/admin/services', [ServiceController::class, 'services'])->name('admin.services');
Route::post('/admin/services', [ServiceController::class, 'saveServices'])->name('admin.saveServices');
Route::get('/admin/services/{service}/edit', [ServiceController::class, 'editServices'])->name('admin.editServices');
Route::post('/admin/services/{service}/update', [ServiceController::class, 'updateServices'])->name('admin.updateServices');
Route::post('/admin/services/{service}/delete', [ServiceController::class, 'deleteServices'])->name('admin.deleteServices');

Route::get('/admin/team', [TeamController::class, 'team'])->name('admin.team');
Route::post('/admin/team', [TeamController::class, 'saveTeam'])->name('admin.saveTeam');
Route::get('/admin/team/{team}/edit', [TeamController::class, 'editTeam'])->name('admin.editTeam');
Route::post('/admin/team/{team}/update', [TeamController::class, 'updateTeam'])->name('admin.updateTeam');
Route::post('/admin/team/{team}/delete', [TeamController::class, 'deleteTeam'])->name('admin.deleteTeam');

Route::get('/admin/gift-cards', [GiftCardController::class, 'giftCardsAdmin'])->name('admin.giftCards');
Route::post('/admin/gift-cards/{giftCard}/status', [GiftCardController::class, 'updateStatus'])->name('admin.giftCards.status');
Route::post('/admin/gift-cards/{giftCard}/delete', [GiftCardController::class, 'deleteGiftCard'])->name('admin.giftCards.delete');

Route::get('/admin/team/{member}/schedule',   [TeamController::class, 'schedule'])->name('admin.team.schedule');
Route::post('/admin/team/{member}/schedule', [TeamController::class, 'updateSchedule'])->name('admin.team.schedule.update');

Route::get('/admin/appointments', [AppointmentController::class, 'appointments'])->name('admin.appointments');
Route::post('/admin/appointments/{appointment}/status', [AppointmentController::class, 'updateStatus'])->name('admin.appointments.status');

});