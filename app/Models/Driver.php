<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;

    protected $fillable = ['licencia', 'nombre', 'ci'];

    public function tornaguias()
    {
        return $this->hasMany(Tornaguia::class);
    }
}
