<?php

use Illuminate\Database\Seeder;

class subDisciplineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('sub_disciplines')->insert([
            'name' => 'BUILD',
            'discipline_id' => 2,
            'user_id' => 1,
            'is_lock' => 1
        ]); 
        \DB::table('sub_disciplines')->insert([
            'name' => 'CIRCULATION',
            'discipline_id' => 3,
            'user_id' => 1,
            'is_lock' => 1
        ]);
        \DB::table('sub_disciplines')->insert([
            'name' => 'STRUCTURE',
            'discipline_id' => 3,
            'user_id' => 1,
            'is_lock' => 1
        ]);   
        \DB::table('sub_disciplines')->insert([
            'name' => 'FOUNDATION',
            'discipline_id' => 3,
            'user_id' => 1,
            'is_lock' => 1
        ]); 
        \DB::table('sub_disciplines')->insert([
            'name' => 'LIGHTING',
            'discipline_id' => 4,
            'user_id' => 1,
            'is_lock' => 1
        ]);   
        \DB::table('sub_disciplines')->insert([
            'name' => 'POWER',
            'discipline_id' => 4,
            'user_id' => 1,
            'is_lock' => 1
        ]);  
        \DB::table('sub_disciplines')->insert([
            'name' => 'WATERLINE',
            'discipline_id' => 5,
            'user_id' => 1,
            'is_lock' => 1
        ]);  
        \DB::table('sub_disciplines')->insert([
            'name' => 'SANITARY',
            'discipline_id' => 5,
            'user_id' => 1,
            'is_lock' => 1
        ]);  
        \DB::table('sub_disciplines')->insert([
            'name' => 'FIRE PROTECTION',
            'discipline_id' => 6,
            'user_id' => 1,
            'is_lock' => 1
        ]);  
        \DB::table('sub_disciplines')->insert([
            'name' => 'HVAC',
            'discipline_id' => 6,
            'user_id' => 1,
            'is_lock' => 1
        ]);  
        \DB::table('sub_disciplines')->insert([
            'name' => 'FIRE DETECTION AND ALARM SYSTEM',
            'discipline_id' => 7,
            'user_id' => 1,
            'is_lock' => 1
        ]);  
        \DB::table('sub_disciplines')->insert([
            'name' => 'CATV/ CCTV/ INTERNET',
            'discipline_id' => 7,
            'user_id' => 1,
            'is_lock' => 1
        ]);  
    }
}
