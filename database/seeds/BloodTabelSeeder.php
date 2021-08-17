<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BloodTabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('type__bloods')->delete();
       $bgs = ['o-','A+','A-','B+','B-','AB+','AB-'];
       foreach ($bgs as $bg){
           \App\Models\Type_Blood::create(['Name' => $bg]);
       }
    }
}
