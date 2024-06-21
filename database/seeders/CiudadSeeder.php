<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CiudadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ciudades')->insert([
            ['nombre' => 'Bogota'],
            ['nombre' => 'Cali'],
            ['nombre' => 'Bucaramanga'],
            ['nombre' => 'Medellin'],
        ]);
    }
}
