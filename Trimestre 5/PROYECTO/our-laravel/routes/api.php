<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\carritoController;
use App\Http\Controllers\usuariosController;
use App\Http\Controllers\Api\UsuarioController;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\FrontController;

Route::prefix('v1')->group(function () {
    Route::post('/user-login', ['as' => 'login', 'uses' => 'api\v1\UserController@user_login']);
});
    ////////PUBLIC

    ///::public
    Route::get('/public/{slug}',[FrontController::class,'usuarios']);
//::auth
Route::get('/auth/login',[FrontController::class,'register']);
Route::get('/auth/login',[FrontController::class,'login']);


    //////PRIVATE
    Route::group(['middleware' => 'auth:sanctum'], function (){
        //::auth
        Route::post('/auth/logout', [AuthController::class, 'logout']);

        //::rol usuario
        Route::apiResource('/usuario/registro', usuariosController::class);
        Route::apiResource('/usuario/login', usuariosController::class);
        //::rol admin

        Route::apiResource('/admin/registro', AdminController::class);
        Route::apiResource('/admin/registro', AdminController::class);
    });

/*Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');*/

Route::get('/carrito', [carritoController::class, 'index']);

Route::get('/carrito/{id}', [carritoController::class, 'show']);

Route::post('/carrito', [carritoController::class, 'store']);

Route::put('/carrito/{id}', [carritoController::class, 'update']);

Route::patch('/carrito/{id}', [carritoController::class, 'updatePartial']);

Route::delete('/carrito/{id}', [carritoController::class, 'destroy']);

Route::get('/usuarios', [usuariosController::class, 'index']);

Route::middleware("auth:sanctum")->get('/authUser', [usuariosController::class, 'index']);

Route::get('/usuarios/{id}', [usuariosController::class, 'show']);

Route::post('/usuarios', [usuariosController::class, 'store']);

Route::put('/usuarios/{id}', [usuariosController::class, 'update']);

Route::patch('/usuarios/{id}', [usuariosController::class, 'updatePartial']);

Route::delete('/usuarios/{id}', [usuariosController::class, 'destroy']);

Route::post('/login', [AuthController::class, 'login']);