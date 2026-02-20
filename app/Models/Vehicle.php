<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = ['placa', 'medio_transporte', 'marca', 'color', 'modelo'];

    public function tornaguias()
    {
        return $this->hasMany(Tornaguia::class);
    }
}
