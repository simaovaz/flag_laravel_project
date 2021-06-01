<?php

namespace Database\Seeders;

use Database\Factories\MedicoFactory;
use App\Models\Medico;
use Illuminate\Database\Seeder;

class MedicoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Medico::factory()->times(10)->create();
    }
}
