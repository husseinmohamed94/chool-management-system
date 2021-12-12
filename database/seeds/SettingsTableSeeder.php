<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->delete();

        $data = [
          ['key' => 'school_name','value' =>'ElHussein Interational Shools'],
          ['key' => 'current_session','value' =>'2021-2022'],
          ['key' => 'school_title','value' =>'HM'],
          ['key' => 'end_first_term' , 'value' =>'01-12-2021'],
          ['key' => 'end_second_term' , 'value' =>'01-03-2022'],
          ['key' => 'phone' , 'value' =>'01142805765'],
          ['key' => 'address' , 'value' =>'cairo'],
          ['key' => 'school_email' , 'value' =>'info@hussein.com'],
          ['key' => 'logo' , 'value' =>'1.jpg'],
        ];
        DB::table('settings')->insert($data);
    }
}
