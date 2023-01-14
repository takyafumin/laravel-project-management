<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Project\Infra\Models\Project;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Project::factory(50)->create();
    }
}
