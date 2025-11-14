<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\FeedbackAnalyticsController;
use App\Http\Controllers\FeedbackFormController;
use App\Http\Controllers\FeedbackQuestionController;
use App\Http\Controllers\UserFeedbackController;
use Illuminate\Support\Facades\Route;

Route::get('/', [UserFeedbackController::class, 'showHomeForm'])->name('home.feedback');
Route::get('/form/{id}', [UserFeedbackController::class, 'showForm'])->name('home.feedback.form');


Route::get('/user/login', [UserFeedbackController::class, 'login'])->name('user.login');
Route::post('/user/login', [UserFeedbackController::class, 'loginPost'])->name('user.login.post');
Route::get('/user/register', [UserFeedbackController::class, 'register'])->name('user.register');
Route::post('/user/register', [UserFeedbackController::class, 'registerPost'])->name('user.register.post');
Route::post('/user/logout', [UserFeedbackController::class, 'logout'])->name('user.logout');

Route::post('/user/feedback/submit/{formId}', [UserFeedbackController::class, 'submit'])->name('user.feedback.submit');

Route::group(['middleware' => 'web', 'prefix' => 'systemadmin'], function () {
    Route::get('/', function () {
        return view('admin.login-form');
    })->name('admin.login.form');
    Route::post('/admin-login', [AdminController::class, 'adminLogin'])->name('admin.login');

    Route::group(['middleware' => ['auth:web']], function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::post('/logout', [AdminController::class, 'adminLogout'])->name('admin.logout');

        // Feedback Form Routes
        Route::get('/feedback-forms', [FeedbackFormController::class, 'index'])->name('feedback.forms.index');
        Route::get('/feedback-forms/create', [FeedbackFormController::class, 'create'])->name('feedback.forms.create');
        Route::post('/feedback-forms/store', [FeedbackFormController::class, 'store'])->name('feedback.forms.store');
        Route::get('/feedback-forms/edit/{id}', [FeedbackFormController::class, 'edit'])->name('feedback.forms.edit');
        Route::post('/feedback-forms/update/{id}', [FeedbackFormController::class, 'update'])->name('feedback.forms.update');
        Route::get('/feedback-forms/delete/{id}', [FeedbackFormController::class, 'destroy'])->name('feedback.forms.delete');

        // Feedback Question Routes
        Route::get('/feedback-questions/{formId}', [FeedbackQuestionController::class, 'index'])->name('feedback.questions.index');
        Route::post('/feedback-questions/store/{formId}', [FeedbackQuestionController::class, 'store'])->name('feedback.questions.store');
        Route::get('/feedback-questions/edit/{id}', [FeedbackQuestionController::class, 'edit'])->name('feedback.questions.edit');
        Route::post('/feedback-questions/update/{id}', [FeedbackQuestionController::class, 'update'])->name('feedback.questions.update');
        Route::get('/feedback-questions/delete/{id}', [FeedbackQuestionController::class, 'delete'])->name('feedback.questions.delete');

        // Feedback Submission Routes
        Route::get('/admin/feedback-form/{id}/analytics', [FeedbackAnalyticsController::class, 'index'])->name('admin.feedback.analytics');
    });
});
