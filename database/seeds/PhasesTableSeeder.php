<?php

use Illuminate\Database\Seeder;

class PhasesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	App\Phase::create(
    		['name' => 'Fase de Grupos', 'slug' => 'fase-de-grupos'],
    		['name' => 'Semifinal', 'slug' => 'semifinal'],
    		['name' => 'Final', 'slug' => 'final']
    	);
    }
}
