<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Driver;

class DriverSeeder extends Seeder
{
    public function run()
    {
        Driver::create(['licencia'=>'5721133','nombre'=>'Andres Cruz', 'ci'=>'5721133']);
    }
}
