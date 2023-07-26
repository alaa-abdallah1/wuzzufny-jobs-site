<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SkillsTableSeeder::class);
        $this->call(CountriesTableSeeder::class);
        \App\Models\User::factory(50)->create();
        \App\Models\Job::factory(150)->create();
    }
}
