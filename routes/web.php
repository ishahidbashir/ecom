<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;
use App\http\Controllers\productController;
use App\Http\Controllers\cartItemsController;



Route::get('/',[userController::class,'login']);
//***************the below function for the url welcome will check if the user is logged in then will be redirected to the welcome page otherwise it will
//be redirected to the login page  */

// Route::get('welcome',function(){
//  if(session()->has('user_id')){
//     return view('welcome');
//  }
//  return redirect('/');
// });
Route::get('welcome',[userController::class,'showAllProducts']);
//**************************************************** */
Route::get('register',[userController::class,'registerPage']);

Route::post('save-user',[userController::class,'saveUser']);

Route::post('login-user',[userController::class,'loginUser']);

//when we are logged in and we click on the logout button the session will get destroyed and you will be redirected to the login page
Route::get('/logout',function(){
  if(session()->has('user_id')){
    session()->pull('user_id');
    return redirect('/');
  }
});
//*************************************************************************************************** */
Route::post('/add-product',[userController::class,'addProduct']);

Route::post('/add-to-cart', [userController::class,'addToCart']);
Route::get('/cartView',[userController::class,'usersCartItems']);

/////REMOVE FROM CART OR REMOVE FROM PRODUCT

Route::get('/remove-product/{id}', [userController::class,'removeProduct']);
Route::get('/remove-from-cart/{id}', [userController::class,'removeFromCart']);

/*************CART View Of a Loggged In User*********** */




Route::get('/orderNow',[userController::class,'orderNow']);