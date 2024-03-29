<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(1)->create([
            'name'  => 'テスト管理者',
            'email' => 'admin@example.com',
        ]);

        User::factory(9)->create();
    }
}
