<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComprasPromocionesTable extends Migration
{
    public function up()
    {
        Schema::create('compras_promociones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained('clientes')->onDelete('cascade');
            $table->foreignId('promocion_id')->constrained('promociones')->onDelete('cascade');
            $table->decimal('value');
            $table->dateTime('fecha_compra');
            $table->dateTime('fecha_expiracion');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('compras_promociones');
    }
}
