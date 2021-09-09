<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        \App\User::create([
           'name'       =>'admin',
            'password'  =>\Illuminate\Support\Facades\Hash::make(123456789),
            'email'     => 'admin@gmail.com',
        ]);

    }
}
