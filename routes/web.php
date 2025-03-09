<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OldAdminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index'])->name('properties.index');
Route::get('/about', [HomeController::class, 'about']);
Route::get('/contact', [HomeController::class, 'contact']);
Route::post('/contact_us', [HomeController::class, 'contact_us'])->name('contact_us');
Route::get('/testimonial', [HomeController::class, 'testimonial']);
Route::get('/services', [HomeController::class, 'services']);
Route::get('/property_list', [HomeController::class, 'propertyList'])->name('properties.list');
Route::get('/property_details/{id}', [HomeController::class, 'propertyDetails']);
Route::get('/property_type', [HomeController::class, 'propertyType'])->name('properties.type');
Route::get('/property_agent', [HomeController::class, 'propertyAgent']);
Route::get('/buy_property/{id}', [HomeController::class, 'buy_property']);
Route::post('/save_payment', [HomeController::class, 'save_payment']);
Route::post('/book_properties', [HomeController::class, 'bookProperties']);
Route::get('/error', [HomeController::class, 'error']);

// Route::match(['GET', 'POST'], '/login', [OldAdminController::class, 'login'])->name('login');
// Route::match(['GET', 'POST'], '/logout', [OldAdminController::class, 'logout']);

// Route::group(['prefix' => 'admin', 'middleware' => ["auth", "admin"]], function () {
//     Route::get('/dashboard', [OldAdminController::class, 'dashboard']);
//     Route::get('/loctions', [OldAdminController::class, 'locations']);
//     Route::post('/loctions/create', [OldAdminController::class, 'createLocations']);
//     Route::put('/loctions/update/{id}', [OldAdminController::class, 'updateLocations']);
//     Route::delete('/loctions/delete/{id}', [OldAdminController::class, 'deleteLocations']);
// });


Route::controller(AuthController::class)->group(function () {
    Route::match(['GET', 'POST'], '/user/login', 'login')->name('login');
    Route::match(['GET', 'POST'], '/logout', 'logout')->name('logout');
    Route::match(['GET', 'POST'], '/register', 'register')->name('register');
});

Route::match(['GET', 'POST'], '/user/register', [AuthController::class, 'admin_create'])->name('admin_create');

Route::group(['prefix' => 'admin', 'middleware' => ["auth", "admin"]], function () {
    Route::match(['GET', 'POST'], '/allow_reg', [AdminController::class, 'allow_reg'])->name('allow_reg');
    Route::match(['GET', 'POST'], '/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    Route::match(['GET', 'POST'], '/locations', [AdminController::class, 'locations']);
    Route::match(['GET', 'POST'], '/edit_location', [AdminController::class, 'editLocation']);
    Route::match(['GET', 'POST'], '/delete_location', [AdminController::class, 'deleteLocation']);

    Route::match(['GET', 'POST'], '/categories', [AdminController::class, 'categories']);
    Route::match(['GET', 'POST'], '/edit_categories', [AdminController::class, 'editCategories']);
    Route::match(['GET', 'POST'], '/delete_categories', [AdminController::class, 'deleteCategories']);

    Route::match(['GET', 'POST'], '/property/types', [AdminController::class, 'propertyTypes']);
    Route::match(['GET', 'POST'], '/edit/property/type', [AdminController::class, 'editPropertyType']);
    Route::match(['GET', 'POST'], '/delete/property/type', [AdminController::class, 'deletePropertyType']);

    Route::match(['GET', 'POST'], '/properties', [AdminController::class, 'properties']);
    Route::match(['GET', 'POST'], '/edit/property', [AdminController::class, 'editProperty']);
    Route::match(['GET', 'POST'], '/delete/property', [AdminController::class, 'deleteProperty']);

    Route::match(['GET', 'POST'], '/property/agents', [AdminController::class, 'propertAgents']);
    Route::match(['GET', 'POST'], '/edit/property/agent', [AdminController::class, 'editPropertyAgent']);
    Route::match(['GET', 'POST'], '/delete/property/agent', [AdminController::class, 'deletePropertyAgent']);

    Route::match(['GET', 'POST'], '/testimonials', [AdminController::class, 'testimonials']);
    Route::match(['GET', 'POST'], '/edit_testimonial', [AdminController::class, 'editTestimonail']);
    Route::match(['GET', 'POST'], '/delete_testimonial', [AdminController::class, 'deleteTestimonial']);

    Route::match(['GET', 'POST'], '/transactions', [AdminController::class, 'transactions']);

    Route::match(['GET', 'POST'], '/contacts', [AdminController::class, 'contacts']);

    Route::match(['GET', 'POST'], '/faqs', [AdminController::class, 'faqs']);
    Route::match(['GET', 'POST'], '/edit_faq', [AdminController::class, 'editFaqs']);
    Route::match(['GET', 'POST'], '/delete_faq', [AdminController::class, 'deletefaqs']);


    Route::match(['GET', 'POST'], '/gallery', [AdminController::class, 'gallery'])->name('gallery');
    Route::match(['GET', 'POST'], '/galleries', [AdminController::class, 'galleries'])->name('galleries');
    Route::match(['GET', 'POST'], '/delete_photo', [AdminController::class, 'delete_photo'])->name('delete_photo');

    Route::match(['GET', 'POST'], '/services', [AdminController::class, 'services'])->name('services');
    Route::match(['GET', 'POST'], '/services', [AdminController::class, 'services'])->name('services');
    Route::match(['GET', 'POST'], '/edit_service', [AdminController::class, 'edit_service'])->name('edit_service');

});
