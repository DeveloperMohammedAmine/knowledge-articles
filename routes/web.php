<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticlesController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){ //...
        
        Route::controller(ArticlesController::class)->name('articles.')->group(function () {
            Route::get('/categories/{category}', 'ArticlesController@getArticlesByCategory') -> name('by_category');
        });
        Route::resource('articles', ArticlesController::class);



        Route::group(['prefix' =>  'dashboard'], function() {
            Route::get('/', 'UserDashboardController@index') -> name('user-dashboard.index');
        });

        Route::group(['prefix' => 'profile'], function() {

            Route::get('/show/{name}', 'ProfilesController@index') -> name('profile.index');
            Route::get('/edit', 'ProfilesController@edit') -> name('profile.edit');
            Route::get('/edit-password', 'ProfilesController@editPassword') -> name('profile.edit.password');
            Route::post('/update', 'ProfilesController@update') -> name('profile.update');
            Route::post('/update-password', 'ProfilesController@updatePassword') -> name('profile.update.password');
            
        });



        

        
        Auth::routes();
        Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        Route::get('/contact', [App\Http\Controllers\HomeController::class, 'contact'])->name('contact');

    });
    

