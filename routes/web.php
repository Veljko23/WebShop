<?php

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

Route::get('/', 'IndexController@index')->name('front.index.index');


Route::get('/about-us', 'PagesController@aboutUs')->name('front.pages.about_us');

Route::get('/frequently-asked-questions', 'PagesController@faq')->name('front.pages.faq');

Route::get('/products', 'ProductsController@index')->name('front.products.index');
Route::get('/products/{product}/{seoSlug?}', 'ProductsController@single')->name('front.products.single');

Route::get('/contact', 'ContactController@index')->name('front.contact.index');
Route::post('/contact/send-message', 'ContactController@sendMessage')->name('front.contact.send_message');

Route::get('/shopping-cart', 'ShoppingCartController@index')->name('front.shopping_cart.index');
Route::get('/shopping-cart/content', 'ShoppingCartController@content')->name('front.shopping_cart.content');
Route::get('/shopping-cart/table', 'ShoppingCartController@table')->name('front.shopping_cart.table');
Route::post('/shopping-cart/add-product', 'ShoppingCartController@addProduct')->name('front.shopping_cart.add_product');
Route::post('/shopping-cart/change-quantity', 'ShoppingCartController@changeQuantity')->name('front.shopping_cart.change_quantity');
Route::post('/shopping-cart/remove-product', 'ShoppingCartController@removeProduct')->name('front.shopping_cart.remove_product');

Route::prefix('/checkout')->group(function(){
    Route::get('/', 'CheckoutController@index')->name('front.checkout.index');
    Route::post('/confirm-order', 'CheckoutController@confirmOrder')->name('front.checkout.confirm_order');
});

Route::prefix('/orders')->group(function(){
    Route::get('/details/{uuid}', 'OrdersController@details')->name('front.orders.details');
});

Auth::routes(); //ove su rute /login /password/reset



Route::middleware('auth')->prefix('/admin')->namespace('Admin')->group(function() {

    Route::get('/', 'IndexController@index')->name('admin.index.index');

    //rute za SizeController
    Route::prefix('/sizes')->group(function() {
        Route::get('/', 'SizesController@index')->name('admin.sizes.index');
        Route::get('/add', 'SizesController@add')->name('admin.sizes.add');

        //RUTE ZA SIZES
        Route::post('/insert', 'SizesController@insert')->name('admin.sizes.insert');
        Route::get('/edit/{size}', 'SizesController@edit')->name('admin.sizes.edit');
        Route::post('/update/{size}', 'SizesController@update')->name('admin.sizes.update');
        Route::post('/delete', 'SizesController@delete')->name('admin.sizes.delete');
    });

    //RUTE ZA PRODUCT_CATEGORIES
    Route::prefix('/product-categories')->group(function() {
        Route::get('/', 'ProductCategoriesController@index')->name('admin.product_categories.index');
        Route::get('/add', 'ProductCategoriesController@add')->name('admin.product_categories.add');

        Route::post('/insert', 'ProductCategoriesController@insert')->name('admin.product_categories.insert');
        Route::get('/edit/{productCategory}', 'ProductCategoriesController@edit')->name('admin.product_categories.edit');
        Route::post('/update/{productCategory}', 'ProductCategoriesController@update')->name('admin.product_categories.update');
        Route::post('/delete', 'ProductCategoriesController@delete')->name('admin.product_categories.delete');
        //SA SORTIRANJE
        Route::post('/change-priorities', 'ProductCategoriesController@changePriorities')->name('admin.product_categories.change_priorities');
    });


    Route::prefix('/brands')->group(function() {
        Route::get('/', 'BrandsController@index')->name('admin.brands.index');
        Route::get('/add', 'BrandsController@add')->name('admin.brands.add');

        Route::post('/insert', 'BrandsController@insert')->name('admin.brands.insert');
        Route::get('/edit/{brand}', 'BrandsController@edit')->name('admin.brands.edit');
        Route::post('/update/{brand}', 'BrandsController@update')->name('admin.brands.update');
        Route::post('/delete', 'BrandsController@delete')->name('admin.brands.delete');

        Route::post('/delete-photo/{brand}', 'BrandsController@deletePhoto')->name('admin.brands.delete_photo');
    });

    Route::prefix('/products')->group(function() {
        Route::get('/', 'ProductsController@index')->name('admin.products.index');
        Route::get('/add', 'ProductsController@add')->name('admin.products.add');

        //RUTE ZA PRODUCT
        Route::post('/insert', 'ProductsController@insert')->name('admin.products.insert');
        Route::get('/edit/{product}', 'ProductsController@edit')->name('admin.products.edit');
        Route::post('/update/{product}', 'ProductsController@update')->name('admin.products.update');
        Route::post('/delete', 'ProductsController@delete')->name('admin.products.delete');

        Route::post('/delete-photo/{product}', 'ProductsController@deletePhoto')->name('admin.products.delete_photo');

        Route::post('/datatable', 'ProductsController@datatable')->name('admin.products.datatable');
    });

    Route::prefix('/users')->group(function() {
        Route::get('/', 'UsersController@index')->name('admin.users.index');
        Route::get('/add', 'UsersController@add')->name('admin.users.add');

        //RUTE ZA USER
        Route::post('/insert', 'UsersController@insert')->name('admin.users.insert');
        Route::get('/edit/{user}', 'UsersController@edit')->name('admin.users.edit');
        Route::post('/update/{user}', 'UsersController@update')->name('admin.users.update');
        Route::post('/delete', 'UsersController@delete')->name('admin.users.delete');

        Route::post('/enable', 'UsersController@enable')->name('admin.users.enable');
        Route::post('/disable', 'UsersController@disable')->name('admin.users.disable');

        Route::post('/delete-photo/{user}', 'UsersController@deletePhoto')->name('admin.users.delete_photo');

        Route::post('/datatable', 'UsersController@datatable')->name('admin.users.datatable');
    });

    Route::prefix('/profile')->group(function() {

        Route::get('/edit', 'ProfileController@edit')->name('admin.profile.edit');
        Route::post('/update', 'ProfileController@update')->name('admin.profile.update');

        Route::post('/delete-photo', 'ProfileController@deletePhoto')->name('admin.profile.delete_photo');

        Route::get('/change-password', 'ProfileController@changePassword')->name('admin.profile.change_password');
        Route::post('/change-password', 'ProfileController@changePasswordConfirm')->name('admin.profile.change_password_confirm');
    });
});

