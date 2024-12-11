<?php

use App\Http\Controllers\Api\UsuarioController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\Route;

Route::apiResource('usuarios', UsuarioController::class);
Route::apiResource('products', ProductController::class);

/*<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'GET') {
    // Simulando datos
    $data = [
        ["id" => 1, "nombre" => "Producto 1"],
        ["id" => 2, "nombre" => "Producto 2"]
    ];
    echo json_encode($data);
} elseif ($method == 'POST') {
    // Aquí puedes manejar la creación de nuevos recursos
    $input = json_decode(file_get_contents('php://input'), true);
    // Procesar $input y guardar en la base de datos
    echo json_encode(["message" => "Producto creado", "data" => $input]);
}
?>*/