<?php

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
        $this->call(UsersTableSeeder::class);
        $this->call(BloodTabelSeeder::class);
        $this->call(NationaliteTabelSeeder::class);
        $this->call(ReligionTabelSeeder::class);
        $this->call(GenderTableSeeder::class);
        $this->call(specializationsTableSeeder::class);
    }
}
