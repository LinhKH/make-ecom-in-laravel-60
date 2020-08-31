<?php

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/** Admin Route */
Route::prefix('/admin')->namespace('Admin')->group(function () {
    // All the admin routes will be defined here :-
    Route::get('/', 'AdminController@login');
    Route::match(['get', 'post'], '/login', 'AdminController@login');
    Route::group(['middleware' => ['admin']], function () {
        Route::get('dashboard', 'AdminController@dashboard');
        Route::get('settings', 'AdminController@settings');
        Route::get('logout', 'AdminController@logout');
        Route::post('check-current-password', 'AdminController@checkCurrentPassword');
        Route::post('update-current-password', 'AdminController@updateCurrentPassword');
        Route::match(['get','post'],'update-admin-detail', 'AdminController@updateAdminDetail');
        Route::get('delete-admin-image/{id}', 'AdminController@deleteAdminDetailImage');

        // Sections 
        Route::match(['get', 'post'], '/sections', 'SectionController@sections');
        Route::match(['get', 'post'], 'add-edit-section/{id?}', 'SectionController@addEditSection');
        Route::post('update-section-status', 'SectionController@updateSectionStatus');
        Route::get('delete-section/{id}', 'SectionController@deleteSection');

        // Banner
        Route::match(['get', 'post'], '/banners', 'BannerController@banners');
        Route::match(['get', 'post'], 'add-edit-banner/{id?}', 'BannerController@addEditBanner');
        Route::post('update-banner-status', 'BannerController@updateBannerStatus');
        Route::get('delete-banner/{id}', 'BannerController@deleteBanner');
        Route::get('delete-banner-image/{id}', 'BannerController@deleteBannerImage');

        // Brand
        Route::match(['get', 'post'], '/brands', 'BrandController@brands');
        Route::match(['get', 'post'], 'add-edit-brand/{id?}', 'BrandController@addEditBrand');
        Route::post('update-brand-status', 'BrandController@updateBrandStatus');
        Route::get('delete-brand/{id}', 'BrandController@deleteBrand');
        
        // Categories
        Route::get('categories', 'CategoryController@categories');
        Route::post('update-category-status', 'CategoryController@updateCategoryStatus');
        Route::match(['get', 'post'], 'add-edit-category/{id?}', 'CategoryController@addEditCategpry');
        Route::post('append-categories-level', 'CategoryController@appendCategoriesLevel');
        Route::get('delete-category-image/{id}', 'CategoryController@deleteCategoryImage');
        Route::get('delete-category/{id}', 'CategoryController@deleteCategory');

        // Product
        Route::get('products', 'ProductsController@products');
        Route::post('update-product-status', 'ProductsController@updateProductStatus');
        Route::match(['get', 'post'], 'add-edit-product/{id?}', 'ProductsController@addEditProduct');
        Route::get('delete-product-image/{id}', 'ProductsController@deleteProductImage');
        Route::get('delete-product-video/{id}', 'ProductsController@deleteProductVideo');
        Route::get('delete-product/{id}', 'ProductsController@deleteProduct');

        // Attribute
        Route::match(['get', 'post'], 'add-attributes/{id?}', 'ProductsController@addAttributes');
        Route::get('delete-product-attributes/{id}', 'ProductsController@deleteProductAttributes');

        Route::post('show-product-attributes', 'ProductsController@showProductAttributes');
        Route::get('delete-product-images/{id}', 'ProductsController@deleteProductImages');

        // Images
        Route::match(['get', 'post'], 'add-images/{id?}', 'ProductsController@addImages');
        Route::post('update-product-image-status', 'ProductsController@updateProductImageStatus');
        
    });
});
/** Front Route */
Route::namespace('Front')->group(function() {
    Route::get('/','IndexController@index');
    Route::get('/{url}','ProductsController@listing');
});

