<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vehicle;

class VehicleSeeder extends Seeder
{
    public function run()
    {
        Vehicle::create(['placa'=>'5222VUB','marca'=>'Hyun', 'color'=>'Amarillo']);
    }
}
