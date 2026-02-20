<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('tornaguias', function (Blueprint $table) {
            $table->id();
            $table->date('fecha')->nullable();
            $table->string('departamento')->nullable();
            $table->string('centro_minero')->nullable();
            $table->string('yacimiento')->nullable();
            $table->string('tranca_de_salida')->nullable();
            $table->string('propietario_mineral')->nullable();
            $table->string('empresa_cooperativa')->nullable();
            $table->string('comprador')->nullable();
            $table->string('destino')->nullable();
            $table->string('tipo_de_mineral')->nullable();
            $table->string('minerales')->nullable();
            $table->decimal('peso_kg', 10, 2)->nullable();
            $table->unsignedInteger('cantidad')->nullable();
            $table->string('nro_lote')->nullable();
            $table->foreignId('vehicle_id')->nullable()->constrained('vehicles');
            $table->foreignId('driver_id')->nullable()->constrained('drivers');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tornaguias');
    }
};
