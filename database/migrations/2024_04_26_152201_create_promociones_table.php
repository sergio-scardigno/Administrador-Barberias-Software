<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\SoftDeletes;



class CreatePromocionesTable extends Migration
{
    public function up()
    {
        Schema::create('promociones', function (Blueprint $table) {
            $table->id();
            $table->integer('cantidad_cortes');
            $table->decimal('descuento', 30, 2);
            $table->timestamps();
            $table->softDeletes(); // Asegúrate de tener este método para el soft delete
        });
    }

    public function down()
    {
        Schema::dropIfExists('promociones');
    }
}
