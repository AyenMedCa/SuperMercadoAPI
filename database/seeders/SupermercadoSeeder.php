<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Supermercado;

class SupermercadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Supermercado::create([
            'nombre' => 'Supermercado A',
            'NIT' => '1234567890',
            'direccion' => 'Calle 123, Ciudad A',
            'logo' => 'supermercado_a.png',
            'latitud' => '123.456',
            'longitud' => '456.789',
            'ciudad_id' => 1,
        ]);

        Supermercado::create([
            'nombre' => 'Supermercado B',
            'NIT' => '0987654321',
            'direccion' => 'Avenida XYZ, Ciudad B',
            'logo' => 'supermercado_b.png',
            'latitud' => '789.123',
            'longitud' => '321.654',
            'ciudad_id' => 2,
        ]);

        Supermercado::create([
            'nombre' => 'Supermercado C',
            'NIT' => '5432167890',
            'direccion' => 'Av. Principal, Ciudad C',
            'logo' => 'supermercado_c.png',
            'latitud' => '111.222',
            'longitud' => '333.444',
            'ciudad_id' => 1,
        ]);

        Supermercado::create([
            'nombre' => 'Supermercado D',
            'NIT' => '9876543210',
            'direccion' => 'Carrera 456, Ciudad A',
            'logo' => 'supermercado_d.png',
            'latitud' => '555.666',
            'longitud' => '777.888',
            'ciudad_id' => 3,
        ]);

        Supermercado::create([
            'nombre' => 'Supermercado E',
            'NIT' => '1357924680',
            'direccion' => 'Calle 789, Ciudad B',
            'logo' => 'supermercado_e.png',
            'latitud' => '999.000',
            'longitud' => '000.111',
            'ciudad_id' => 2,
        ]);
    }
}
