<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('charts',[PostController::class,'chartPosts']);

Route::apiResource('categories',CategoryController::class);

Route::apiResource('posts',PostController::class);

Route::controller(PostController::class)->group(function(){
      Route::get('category/{slug}/post','CategoryPosts');
      Route::get('searchPosts/{query}','searchPosts');
});

Route::controller(UserController::class)->group(function(){
      
      Route::post('login','login');

      Route::post('register','register');

      Route::get('user','details');
});
Route::middleware('auth:api')->group(function(){

      Route::post('comment/create',[CommentController::class,'store']);
      
    


      Route::controller(UserController::class)->group(function(){

            Route::get('getUnreadNotifications','getUnreadNotifications');

            Route::get('getAllNotifications','getAllNotifications');

            Route::put('markNotificationAsRead','markNotificationAsRead');
      });   
});

Route::group(['prefix'=>'/admin','middleware'=>'auth:api'], function () {
     

      Route::get('user',[UserController::class,'details']);
      Route::delete('deleteComment/{id}',[CommentController::class,'destroy']);

      Route::post('update',[AdminController::class,'update']);
     
      Route::controller(AdminController::class)->group(function(){
          
            Route::get('posts','getPosts');

            Route::get('categories','CategoryPosts');
            
            Route::post('add','addPost');
            
            Route::put('update','update');
            
            Route::delete('delete','destroy');

            Route::delete('NormaldDelete/{id}','NormaldDelete');
      });

});