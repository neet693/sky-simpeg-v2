<?php

namespace Database\Seeders;

use App\Models\unit as ModelsUnit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use SebastianBergmann\CodeCoverage\Report\Xml\Unit;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ModelsUnit::create(['name' => 'TK']);
        ModelsUnit::create(['name' => 'SD']);
        ModelsUnit::create(['name' => 'SMP']);
        ModelsUnit::create(['name' => 'SMA']);
        ModelsUnit::create(['name' => 'IT Department']);
        ModelsUnit::create(['name' => 'Proyek Sarpras']);
        ModelsUnit::create(['name' => 'TU Pusat']);
        // ModelsUnit::create(['name' => 'Uncatagorized Unit']);
    }
}
