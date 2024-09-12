<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CompareController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Models\Category;
use App\Models\Product;
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

Route::get('/',[HomeController::class,'index' ] )->name ('home')->middleware('preload.page');
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/page/{page:slug}',[HomeController::class,'showPage' ] )->name ('page')->middleware('preload.page');

//Routes produits
Route::get('/shop',[HomeController::class,'shop' ] )->name ('shop')->middleware('preload.page');

//RoUTES SHOP
Route::get('/product/{slug}',[HomeController::class,'showProduct' ] )->name ('product')->middleware('preload.page');

 // Routes CArd
 // Routes dans web.php
Route::post('/cart/increment/{id}', [CartController::class, 'incrementQuantity'])->name('cart.increment');
Route::post('/cart/decrement/{id}', [CartController::class, 'decrementQuantity'])->name('cart.decrement');
 Route::get('/cart', [cartController::class, 'index'])->name('cart.index')->middleware('preload.page');
 Route::post('/cart/add/{productId}', [CartController::class, 'addToCart'])->name('addToCart')->middleware('preload.page');
 Route::delete('/cart/remove/{productId}/{quantity}', [CartController::class, 'removeFromCart'])->name('removeFromCart');

 Route::post('/cart/increment/{productId}', [CartController::class, 'incrementQuantity'])->name('cart.increment');
Route::post('/cart/decrement/{productId}', [CartController::class, 'decrementQuantity'])->name('cart.decrement');

//Comparaison produits
Route::get('/compare', [CompareController::class, 'compare'])->name('compare');
Route::post('/compare/add/{productId}', [CompareController::class, 'addToCompare'])->name('addToCompare')->middleware('preload.page');
Route::post('/compare/remove/{productId}', [CompareController::class, 'removeFromCompare'])->name('removeFromCompare')->middleware('preload.page');
Route::post('/compare/clear', [CompareController::class, 'clearCompare'])->name('clearCompare')->middleware('preload.page');

Route::post('/compare/submit', [CompareController::class, 'submitComparison'])->name('submitComparison')->middleware('preload.page');



//Route Dashboard Utilisateur
Route::prefix('dashboard')->name('dashboard.')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/',[DashboardController::class, 'index'])->name('index');
    Route::get('/address/add',[DashboardController::class, 'createAddress'])->name('address.add');
    Route::get('/address/edit/{id}',[DashboardController::class, 'addressEdit'])->name('address.edit');
    Route::post('/address/store',[DashboardController::class, 'store'])->name('address.store');
    Route::put('/address/update/{address}',[DashboardController::class, 'update'])->name('address.update');
    Route::delete('/address/delete/{id}',[DashboardController::class, 'delete'])->name('address.delete');
});


Route::get('/dashboard-old', function () {
})->middleware(['auth', 'verified'])->name('dashboard-old');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::prefix('admin')->name('admin.')->middleware('admin')->group(function(){

    //Get Categories datas
    Route::get('/categories', 'App\Http\Controllers\CategoryController@index')->name('category.index');

    //Show Category by Id
    Route::get('/categories/show/{id}', 'App\Http\Controllers\CategoryController@show')->name('category.show');

    //Get Categories by Id
    Route::get('/categories/create', 'App\Http\Controllers\CategoryController@create')->name('category.create');

    //Edit Category by Id
    Route::get('/categories/edit/{id}', 'App\Http\Controllers\CategoryController@edit')->name('category.edit');

    //Save new Category
    Route::post('/categories/store', 'App\Http\Controllers\CategoryController@store')->name('category.store');

    //Update One Category
    Route::put('/categories/update/{category}', 'App\Http\Controllers\CategoryController@update')->name('category.update');

    //Update One Category Speedly
    Route::put('/categories/speed/{category}', 'App\Http\Controllers\CategoryController@updateSpeed')->name('category.update.speed');

    //Delete Category
    Route::delete('/categories/delete/{category}', 'App\Http\Controllers\CategoryController@delete')->name('category.delete');


    //Get Products datas
    Route::get('/products', 'App\Http\Controllers\ProductController@index')->name('product.index');

    //Show Product by Id
    Route::get('/products/show/{id}', 'App\Http\Controllers\ProductController@show')->name('product.show');


    //Get Products by Id
    Route::get('/products/create', 'App\Http\Controllers\ProductController@create')->name('product.create');

    //Edit Product by Id
    Route::get('/products/edit/{id}', 'App\Http\Controllers\ProductController@edit')->name('product.edit');

    //Save new Product
    Route::post('/products/store', 'App\Http\Controllers\ProductController@store')->name('product.store');

    //Update One Product
    Route::put('/products/update/{product}', 'App\Http\Controllers\ProductController@update')->name('product.update');

    //Update One Product Speedly
    Route::put('/products/speed/{product}', 'App\Http\Controllers\ProductController@updateSpeed')->name('product.update.speed');

    //Delete Product
    Route::delete('/products/delete/{product}', 'App\Http\Controllers\ProductController@delete')->name('product.delete');


    //Get Users datas
    Route::get('/users', 'App\Http\Controllers\UserController@index')->name('user.index');

    //Show User by Id
    Route::get('/users/show/{id}', 'App\Http\Controllers\UserController@show')->name('user.show');

    //Get Users by Id
    Route::get('/users/create', 'App\Http\Controllers\UserController@create')->name('user.create');

    //Edit User by Id
    Route::get('/users/edit/{id}', 'App\Http\Controllers\UserController@edit')->name('user.edit');

    //Save new User
    Route::post('/users/store', 'App\Http\Controllers\UserController@store')->name('user.store');

    //Update One User
    Route::put('/users/update/{user}', 'App\Http\Controllers\UserController@update')->name('user.update');

    //Update One User Speedly
    Route::put('/users/speed/{user}', 'App\Http\Controllers\UserController@updateSpeed')->name('user.update.speed');

    //Delete User
    Route::delete('/users/delete/{user}', 'App\Http\Controllers\UserController@delete')->name('user.delete');


    //Get Banners datas
    Route::get('/banners', 'App\Http\Controllers\BannerController@index')->name('banner.index');

    //Show Banner by Id
    Route::get('/banners/show/{id}', 'App\Http\Controllers\BannerController@show')->name('banner.show');

    //Get Banners by Id
    Route::get('/banners/create', 'App\Http\Controllers\BannerController@create')->name('banner.create');

    //Edit Banner by Id
    Route::get('/banners/edit/{id}', 'App\Http\Controllers\BannerController@edit')->name('banner.edit');

    //Save new Banner
    Route::post('/banners/store', 'App\Http\Controllers\BannerController@store')->name('banner.store');

    //Update One Banner
    Route::put('/banners/update/{banner}', 'App\Http\Controllers\BannerController@update')->name('banner.update');

    //Update One Banner Speedly
    Route::put('/banners/speed/{banner}', 'App\Http\Controllers\BannerController@updateSpeed')->name('banner.update.speed');

    //Delete Banner
    Route::delete('/banners/delete/{banner}', 'App\Http\Controllers\BannerController@delete')->name('banner.delete');


    //Get Shopcollections datas
    Route::get('/shopcollections', 'App\Http\Controllers\ShopcollectionController@index')->name('shopcollection.index');

    //Show Shopcollection by Id
    Route::get('/shopcollections/show/{id}', 'App\Http\Controllers\ShopcollectionController@show')->name('shopcollection.show');

    //Get Shopcollections by Id
    Route::get('/shopcollections/create', 'App\Http\Controllers\ShopcollectionController@create')->name('shopcollection.create');

    //Edit Shopcollection by Id
    Route::get('/shopcollections/edit/{id}', 'App\Http\Controllers\ShopcollectionController@edit')->name('shopcollection.edit');

    //Save new Shopcollection
    Route::post('/shopcollections/store', 'App\Http\Controllers\ShopcollectionController@store')->name('shopcollection.store');

    //Update One Shopcollection
    Route::put('/shopcollections/update/{shopcollection}', 'App\Http\Controllers\ShopcollectionController@update')->name('shopcollection.update');

    //Update One Shopcollection Speedly
    Route::put('/shopcollections/speed/{shopcollection}', 'App\Http\Controllers\ShopcollectionController@updateSpeed')->name('shopcollection.update.speed');

    //Delete Shopcollection
    Route::delete('/shopcollections/delete/{shopcollection}', 'App\Http\Controllers\ShopcollectionController@delete')->name('shopcollection.delete');



    //Get Pages datas
    Route::get('/pages', 'App\Http\Controllers\PageController@index')->name('page.index');

    //Show Page by Id
    Route::get('/pages/show/{id}', 'App\Http\Controllers\PageController@show')->name('page.show');

    //Get Pages by Id
    Route::get('/pages/create', 'App\Http\Controllers\PageController@create')->name('page.create');

    //Edit Page by Id
    Route::get('/pages/edit/{id}', 'App\Http\Controllers\PageController@edit')->name('page.edit');

    //Save new Page
    Route::post('/pages/store', 'App\Http\Controllers\PageController@store')->name('page.store');

    //Update One Page
    Route::put('/pages/update/{page}', 'App\Http\Controllers\PageController@update')->name('page.update');

    //Update One Page Speedly
    Route::put('/pages/speed/{page}', 'App\Http\Controllers\PageController@updateSpeed')->name('page.update.speed');

    //Delete Page
    Route::delete('/pages/delete/{page}', 'App\Http\Controllers\PageController@delete')->name('page.delete');


    //Get Roles datas
    Route::get('/roles', 'App\Http\Controllers\RoleController@index')->name('role.index');

    //Show Role by Id
    Route::get('/roles/show/{id}', 'App\Http\Controllers\RoleController@show')->name('role.show');

    //Get Roles by Id
    Route::get('/roles/create', 'App\Http\Controllers\RoleController@create')->name('role.create');

    //Edit Role by Id
    Route::get('/roles/edit/{id}', 'App\Http\Controllers\RoleController@edit')->name('role.edit');

    //Save new Role
    Route::post('/roles/store', 'App\Http\Controllers\RoleController@store')->name('role.store');

    //Update One Role
    Route::put('/roles/update/{role}', 'App\Http\Controllers\RoleController@update')->name('role.update');

    //Update One Role Speedly
    Route::put('/roles/speed/{role}', 'App\Http\Controllers\RoleController@updateSpeed')->name('role.update.speed');

    //Delete Role
    Route::delete('/roles/delete/{role}', 'App\Http\Controllers\RoleController@delete')->name('role.delete');

});

Route::prefix('admin')->name('admin.')->group(function(){

    //Get Carriers datas
    Route::get('/carriers', 'App\Http\Controllers\CarrierController@index')->name('carrier.index');

    //Show Carrier by Id
    Route::get('/carriers/show/{id}', 'App\Http\Controllers\CarrierController@show')->name('carrier.show');

    //Get Carriers by Id
    Route::get('/carriers/create', 'App\Http\Controllers\CarrierController@create')->name('carrier.create');

    //Edit Carrier by Id
    Route::get('/carriers/edit/{id}', 'App\Http\Controllers\CarrierController@edit')->name('carrier.edit');

    //Save new Carrier
    Route::post('/carriers/store', 'App\Http\Controllers\CarrierController@store')->name('carrier.store');

    //Update One Carrier
    Route::put('/carriers/update/{carrier}', 'App\Http\Controllers\CarrierController@update')->name('carrier.update');

    //Update One Carrier Speedly
    Route::put('/carriers/speed/{carrier}', 'App\Http\Controllers\CarrierController@updateSpeed')->name('carrier.update.speed');


 //Delete Carrier
    Route::delete('/carriers/delete/{carrier}', 'App\Http\Controllers\CarrierController@delete')->name('carrier.delete');

});

Route::prefix('admin')->name('admin.')->group(function(){

    //Get Addresses datas
    Route::get('/addresses', 'App\Http\Controllers\AddressController@index')->name('address.index');

    //Show Address by Id
    Route::get('/addresses/show/{id}', 'App\Http\Controllers\AddressController@show')->name('address.show');

    //Get Addresses by Id
    Route::get('/addresses/create', 'App\Http\Controllers\AddressController@create')->name('address.create');

    //Edit Address by Id
    Route::get('/addresses/edit/{id}', 'App\Http\Controllers\AddressController@edit')->name('address.edit');

    //Save new Address
    Route::post('/addresses/store', 'App\Http\Controllers\AddressController@store')->name('address.store');

    //Update One Address
    Route::put('/addresses/update/{address}', 'App\Http\Controllers\AddressController@update')->name('address.update');

    //Update One Address Speedly
    Route::put('/addresses/speed/{address}', 'App\Http\Controllers\AddressController@updateSpeed')->name('address.update.speed');

    //Delete Address
    Route::delete('/addresses/delete/{address}', 'App\Http\Controllers\AddressController@delete')->name('address.delete');

});
