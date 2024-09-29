<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JobsController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/', function () {
//     return view('home');
// })->name('home');

Route::get('/', [HomeController::class,'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/add-job',[JobsController::class, 'add_job_form'])->name('add_job_form');
Route::post('/add-job',[JobsController::class, 'add_job'])->name('add_job');

Route::post('/apply-job',[JobsController::class, 'apply_job_form'])->name('apply_job_form');
    Route::get('/apply-job/{id}',[JobsController::class, 'apply_job'])->name('apply_job');
});
Route::delete('/delete/job/{id}', [JobsController::class,'delete_job'])->name('delete_job');

Route::get('/applications/{id}',[JobsController::class, 'applications'])->name('applications');
Route::get('/applied-job', [JobsController::class, 'applied_job'])->name('applied_job');

Route::get('/jobseeker/profile', [RegisteredUserController::class, 'edit'])->name('profile_edit');
Route::post('/jobseeker/profile', [RegisteredUserController::class, 'submitProfile'])->name('profile_update');


Route::get('/company/register', [CompanyController::class, 'showRegistrationForm'])->name('company_registration');
Route::post('/company/register', [CompanyController::class, 'store'])->name('company_register');
Route::get('/company/update', [CompanyController::class, 'edit'])->name('company.edit');
Route::patch('/company/update', [CompanyController::class, 'update'])->name('company.update');

Route::get('/find_jobs',[JobsController::class, 'find_job'])->name('find_job');
Route::get('/jobs',[JobsController::class, 'job_list'])->name('jobs');

Route::get('/delete-expired-jobs', 'JobsController@delete_expired_jobs')->name('delete.expired.jobs');

Route::get('/job/{id}',[JobsController::class, 'single_job'])->name('job');
Route::get('/application/{id}',[JobsController::class, 'application_detail'])->name('detail');

Route::get('/edit_job/{id}', [JobsController::class, 'edit_job_form'])->name('edit_job_form');
Route::patch('/update_job/{id}', [JobsController::class, 'update_job'])->name('update_job');




require __DIR__.'/auth.php';
