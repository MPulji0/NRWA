<?php

use App\Http\Controllers\GoogleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ContactController;
use App\Http\Livewire\ContactShow;
use App\Http\Livewire\CustomerShow;
use App\Http\Livewire\EmployeeShow;



use Illuminate\Support\Facades\Auth;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
  
Route::controller(GoogleController::class)->group(function(){
    Route::get('auth/google', 'redirectToGoogle')->name('auth.google');
    Route::get('auth/google/callback', 'handleGoogleCallback');
});


Route::controller(GoogleController::class)->group(function(){

    Route::get('login/google', 'redirectToGoogle')->name('login.google');

    Route::get('login/google/callback', 'handleGoogleCallback');

});


/////////////

Route::group(['middleware' => 'auth'], function () {
    //employees
    Route::get('/employees/create',[EmployeeController::class, 'create'])->name('employees.create');
    Route::get('/employees/{employee}/edit',[EmployeeController::class, 'edit'])->name('employees.edit');
    Route::post('/employees',[EmployeeController::class, 'store'])->name('employees.store');
    Route::get('/employees/{employee}',[EmployeeController::class, 'show'])->name('employees.show');
    Route::put('/employees/{employee}',[EmployeeController::class, 'update'])->name('employees.update');
    //contacts
    Route::get('/contacts/create',[ContactController::class, 'create'])->name('contacts.create');
    Route::get('/contacts/{contact}/edit',[ContactController::class, 'edit'])->name('contacts.edit');
    Route::post('/contacts',[ContactController::class, 'store'])->name('contacts.store');
    Route::get('/contacts/{contact}',[ContactController::class, 'show'])->name('contacts.show');
    Route::put('/contacts/{contact}',[ContactController::class, 'update'])->name('contacts.update');
    //customers
    Route::get('/customers/create',[CustomerController::class, 'create'])->name('customers.create');
    Route::get('/customers/{customer}/edit',[CustomerController::class, 'edit'])->name('customers.edit');
    Route::post('/customers',[CustomerController::class, 'store'])->name('customers.store');
    Route::get('/customers/{customer}',[CustomerController::class, 'show'])->name('customers.show');
    Route::put('/customers/{customer}',[CustomerController::class, 'update'])->name('customers.update');
    
    
    
    
    Route::resource('customers', CustomerController::class);
    Route::resource('employees', EmployeeController::class);
   



    
});


Route::group(['middleware' => 'auth','middleware' => 'is_admin'], function () {
    Route::delete('/employees/{employee}',[EmployeeController::class, 'destroy'])->name('employees.destroy');
    Route::delete('/customers/{customers}',[ContactController::class, 'destroy'])->name('customers.destroy');
    Route::delete('/contacts/{contact}',[CustomerController::class, 'destroy'])->name('contacts.destroy');
    
    
    
    Route::delete('/customers/{customer}', [CustomerController::class, 'destroy'])->name('customers.delete')->middleware('auth');


    Route::resource('contacts', ContactController::class);
    Route::get('employees/{employee}/edit', [EmployeeController::class, 'show'])->name('employees.show');

 

});