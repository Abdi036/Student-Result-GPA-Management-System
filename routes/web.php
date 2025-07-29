<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ScoreController;



Route::post('/signout', [AuthController::class, 'signout'])->name('signout');
Route::middleware("guest")->controller(AuthController::class)->group(function () {
    Route::get('/signup',  'showSignup')->name('show.signup');
    Route::post('/signup',  'signup')->name('signup');
    Route::get('/login',  'showlogin')->name('show.login');
    Route::post('/login',  'login')->name('login');
});

Route::middleware("auth")->controller(StudentController::class)->group(function () {
    Route::get('/',  'index')->name('students.index');
    Route::get('/students/create', 'create')->name('students.create');
    Route::post('/students',  'store')->name('students.store');
    Route::get('/students/{student}',  'show')->name('students.show');
});

Route::middleware("auth")->controller(CourseController::class)->group(function () {
    Route::get('/courses/create',  'create')->name('courses.create');
    Route::post('/courses',  'store')->name('courses.store');
    Route::get("/courses","index")->name("courses.index");
    Route::patch("/courses/{course}", "update")->name("courses.update");
    Route::delete("/courses/{course}", "destroy")->name("courses.destroy");
});

Route::middleware("auth")->controller(ScoreController::class)->group(function () {

    Route::get('/scores/create', 'create')->name('scores.create');
    Route::post('/scores', 'store')->name('scores.store');
});
