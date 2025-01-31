<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Locadora;

class LocadoraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Locadora::insert([
            [
                'nome' => 'GLOBAL RENTCAR LTDA',
                'cnpj' => '02.780.779/0001-30',
                'url_api' => 'http://json-server:3001/veiculos',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome' => 'RENTCARS LTDA',
                'cnpj' => '10.998.234/0001-23',
                'url_api' => 'http://json-server:3002/veiculos',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome' => 'Curitiba Rent A Car LTDA',
                'cnpj' => '09.402.151/0001-40',
                'url_api' => 'http://json-server:3003/veiculos',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
