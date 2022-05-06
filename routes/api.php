<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;


Route::post('register',[UserController::class,'register']);

Route::post('login',[UserController::class,'login']);


Route::post('group',['middleware'=> ["auth:sanctum"]], function(){

     //rutas para perfil y logaut//

     Route::get('user-profile',[UserController::class,'userProfile']);
     Route::get('logaut',[UserController::class,'logaut']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
