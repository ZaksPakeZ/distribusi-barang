<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Branch;
class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run()
{
    $branches = ['Cabang 1', 'Cabang 2', 'Cabang 3', 'Cabang 4', 'Cabang 5',];
    foreach ($branches as $name) {
        Branch::create(['name' => $name]);
    }
}   
}
