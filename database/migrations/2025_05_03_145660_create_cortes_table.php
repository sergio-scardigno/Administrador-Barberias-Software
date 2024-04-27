<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


class CreateCortesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cortes', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->foreignId('clientes_id')->constrained();
            $table->foreignId('tipos_id')->constrained();
            $table->date('fecha');
            $table->integer('medio_de_pago');
            $table->text('descripcion');
            $table->foreignId('barbers_id')->constrained();
            $table->integer('monto');
            $table->softDeletes();
            $table->timestamps();
            $table->foreignId('promocion_id')->nullable()->constrained('promociones')->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cortes');
    }
}
