<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tornaguia extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha',
        'departamento',
        'centro_minero',
        'yacimiento',
        'tranca_de_salida',
        'propietario_mineral',
        'empresa_cooperativa',
        'comprador',
        'destino',
        'tipo_de_mineral',
        'minerales',
        'peso_kg',
        'cantidad',
        'nro_lote',
        'vehicle_id',
        'driver_id',
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
}
