<?php

use App\Http\Controllers\CoursesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\Traning_CoursesController;
use App\Http\Controllers\RegisterController;

//Home page
Route::get('/',[HomeController::class, 'index'])->name('home');
// start courses
Route::get('courses',[CoursesController::class,'index'])->name('courses.index');
Route::get('create_courses',[CoursesController::class,'create'])->name('courses.create');
Route::post('store_courses',[CoursesController::class,'store'])->name('courses.store');
Route::get('edit_courses/{id}',[CoursesController::class,'edit'])->name('courses.edit');
Route::post('update_courses/{id}',[CoursesController::class, 'update'])->name('courses.update');
Route::get('destroy_courses/{id}',[CoursesController::class, 'destroy'])->name('courses.destroy');

// srart students
Route::get('student',[StudentController::class,'index'])->name('student.index');
Route::get('create_student',[StudentController::class,'create'])->name('student.create');
Route::post('store_student',[StudentController::class,'store'])->name('student.store');
Route::get('edit_student/{id}',[StudentController::class,'edit'])->name('student.edit');
Route::post('update_student/{id}',[StudentController::class, 'update'])->name('student.update');
Route::get('destroy_student/{id}',[StudentController::class, 'destroy'])->name('student.destroy');
Route::post('ajax_search_student',[StudentController::class, 'ajax_search_student'])->name('student.ajax_search_student');

// Traning Courses
Route::get('traning_courses',[Traning_CoursesController::class,'index'])->name('traning_course.index');
Route::get('create_traning_course',[Traning_CoursesController::class,'create'])->name('traning_course.create');
Route::post('store_traning_course',[Traning_CoursesController::class,'store'])->name('traning_course.store');
Route::get('edit_traning_course/{id}',[Traning_CoursesController::class,'edit'])->name('traning_course.edit');
Route::post('update_traning_course/{id}',[Traning_CoursesController::class, 'update'])->name('traning_course.update');
Route::get('destroy_traning_course/{id}',[Traning_CoursesController::class, 'destroy'])->name('traning_course.destroy');
Route::get('details/{id}',[Traning_CoursesController::class, 'details'])->name('traning_course.details');
Route::get('Addstudenttotraningcourse/{id}',[Traning_CoursesController::class, 'AddStudent'])->name('traning_course.addstudent');
Route::post('DoAddstudenttotraningcourse/{id}',[Traning_CoursesController::class, 'DoAddStudent'])->name('traning_course.doaddstudent');
Route::get('Deletestudentfromtraningcourse/{id}',[Traning_CoursesController::class, 'DeleteStudent'])->name('traning_course.deletestudent');

// Register
Route::get('register',[RegisterController::class,'show'])->name('register.show');
Route::post('register',[RegisterController::class,'register'])->name('register.perform');
Route::post('logout',[RegisterController::class,'logout'])->name('logout');
