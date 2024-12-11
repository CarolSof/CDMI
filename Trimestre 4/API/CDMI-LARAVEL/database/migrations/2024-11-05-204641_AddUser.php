<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CdmiBd extends Migration
{
    public function up()
    {
        // Tabla carrito
        Schema::create('carrito', function (Blueprint $table) {
            $table->id('ID_Carrito');
            $table->integer('ID_Usuario')->unsigned();
            $table->integer('ID_Producto')->unsigned();
            $table->primary('ID_Carrito');
        });

        // Tabla donaciones
        Schema::create('donaciones', function (Blueprint $table) {
            $table->id('ID_Donacion');
            $table->integer('ID_Usuario')->unsigned();
            $table->integer('Valor_Monto');
            $table->string('Descripcion_Accion', 50);
            $table->primary('ID_Donacion');
        });

        // Tabla envio
        Schema::create('envio', function (Blueprint $table) {
            $table->id('ID_Envio');
            $table->string('Nombre_Envio', 50);
            $table->integer('ID_Producto')->unsigned();
            $table->integer('ID_Usuario')->unsigned();
            $table->integer('ID_Venta')->unsigned();
            $table->primary('ID_Envio');
        });

        // Tabla eventos
        Schema::create('eventos', function (Blueprint $table) {
            $table->id('ID_Evento');
            $table->integer('ID_Usuario')->unsigned();
            $table->date('Fecha');
            $table->integer('Aforo', 5);
            $table->string('Lugar', 50);
            $table->integer('Hora');
            $table->string('Descripcion', 100);
            $table->primary('ID_Evento');
        });

        // Tabla factura
        Schema::create('factura', function (Blueprint $table) {
            $table->id('ID_Factura');
            $table->integer('ID_Usuario')->unsigned();
            $table->integer('ID_Producto')->unsigned();
            $table->date('Fecha_Venta');
            $table->primary('ID_Factura');
        });

        // Tabla productos
        Schema::create('productos', function (Blueprint $table) {
            $table->id('id');
            $table->string('nombre', 255);
            $table->decimal('precio', 10, 2);
            $table->string('categoria', 100);
            $table->text('caracteristicas');
            $table->string('imagen', 255)->nullable();
            $table->primary('id');
        });

        // Tabla registroevento
        Schema::create('registroevento', function (Blueprint $table) {
            $table->id('ID_Registro_Evento');
            $table->integer('ID_Evento')->unsigned();
            $table->integer('ID_Usuario')->unsigned();
            $table->dateTime('Fecha_Registro');
            $table->primary('ID_Registro_Evento');
        });

        // Tabla solicitudes_recuperacion
        Schema::create('solicitudes_recuperacion', function (Blueprint $table) {
            $table->id('ID_Solicitud');
            $table->string('correo', 100);
            $table->string('token', 255);
            $table->date('fecha_solicitud');
            $table->primary('ID_Solicitud');
        });

        // Tabla usuarios
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id('ID_Usuario');
            $table->string('Nombre', 50);
            $table->string('Correo', 100);
            $table->string('Password', 255);
            $table->primary('ID_Usuario');
        });

        // Tabla ventas
        Schema::create('ventas', function (Blueprint $table) {
            $table->id('ID_Venta');
            $table->integer('ID_Usuario')->unsigned();
            $table->decimal('Total', 10, 2);
            $table->date('Fecha_Venta');
            $table->primary('ID_Venta');
        });
    }

    public function down()
    {
        Schema::dropIfExists('carrito');
        Schema::dropIfExists('donaciones');
        Schema::dropIfExists('envio');
        Schema::dropIfExists('eventos');
        Schema::dropIfExists('factura');
        Schema::dropIfExists('productos');
        Schema::dropIfExists('registroevento');
        Schema::dropIfExists('solicitudes_recuperacion');
        Schema::dropIfExists('usuarios');
        Schema::dropIfExists('ventas');
    }
}
