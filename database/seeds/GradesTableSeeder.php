<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GradesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Grades')->delete();

        $Grades =  [

            [
                'en'=> 'primary sateg',
                'ar'=> 'ألمرحله الابتدائيه'
            ],
            [
                'en'=> 'middle School',
                'ar'=> 'المرحلة الاعدادية'
            ],
            [
                'en'=> 'High school',
                'ar'=> 'المرحلة الثانوية'
            ],

        ];

        foreach ($Grades as $g) {
            \App\Models\Grade::create(['Name' => $g]);
        }
    }
}
