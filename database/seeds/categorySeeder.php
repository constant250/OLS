<?php

use Illuminate\Database\Seeder;

class categorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('categories')->insert([
            'name'=> 'DOOR',
            'sub_discipline_id' => 0,
            'user_id' => 1,
            'is_lock' => 1

        ]);

        \DB::table('categories')->insert([
            'name'=> 'WINDOW',
            'sub_discipline_id' => 0,
            'user_id' => 1,
            'is_lock' => 1

        ]);

        \DB::table('categories')->insert([
            'name'=> 'COMPONENT',
            'sub_discipline_id' => 0,
            'user_id' => 1,
            'is_lock' => 1

        ]);


        \DB::table('categories')->insert([
            'name'=> 'RAMP',
            'sub_discipline_id' => 0,
            'user_id' => 1,
            'is_lock' => 1

        ]);

        \DB::table('categories')->insert([
            'name'=> 'STRUCTURE',
            'sub_discipline_id' => 0,
            'user_id' => 1,
            'is_lock' => 1

        ]);

        \DB::table('categories')->insert([
            'name'=> 'FOUNDATION',
            'sub_discipline_id' => 0,
            'user_id' => 1,
            'is_lock' => 1

        ]);

        \DB::table('categories')->insert([
            'name'=> 'DEVICE',
            'sub_discipline_id' => 0,
            'user_id' => 1,
            'is_lock' => 1

        ]);

        \DB::table('categories')->insert([
            'name'=> 'FIXTURE',
            'sub_discipline_id' => 0,
            'user_id' => 1,
            'is_lock' => 1

        ]);

        \DB::table('categories')->insert([
            'name'=> 'ELECTRICAL EQUIPMENT',
            'sub_discipline_id' => 0,
            'user_id' => 1,
            'is_lock' => 1

        ]);

        \DB::table('categories')->insert([
            'name'=> 'CABLE TRAY',
            'sub_discipline_id' => 0,
            'user_id' => 1,
            'is_lock' => 1

        ]);

        \DB::table('categories')->insert([
            'name'=> 'CONDUIT',
            'sub_discipline_id' => 0,
            'user_id' => 1,
            'is_lock' => 1

        ]);

        \DB::table('categories')->insert([
            'name'=> 'FITTING',
            'sub_discipline_id' => 0,
            'user_id' => 1,
            'is_lock' => 1

        ]);

        \DB::table('categories')->insert([
            'name'=> 'PIPE',
            'sub_discipline_id' => 0,
            'user_id' => 1,
            'is_lock' => 1

        ]);

        \DB::table('categories')->insert([
            'name'=> 'PIPE FITTING',
            'sub_discipline_id' => 0,
            'user_id' => 1,
            'is_lock' => 1

        ]);

        \DB::table('categories')->insert([
            'name'=> 'PIPE ACCESORY',
            'sub_discipline_id' => 0,
            'user_id' => 1,
            'is_lock' => 1

        ]);

        \DB::table('categories')->insert([
            'name'=> 'FIXTURE',
            'sub_discipline_id' => 0,
            'user_id' => 1,
            'is_lock' => 1

        ]);

        \DB::table('categories')->insert([
            'name'=> 'FIXTURE',
            'sub_discipline_id' => 0,
            'user_id' => 1,
            'is_lock' => 1

        ]);

        \DB::table('categories')->insert([
            'name'=> 'DUCT',
            'sub_discipline_id' => 0,
            'user_id' => 1,
            'is_lock' => 1

        ]);

        \DB::table('categories')->insert([
            'name'=> 'AIR TERMINAL',
            'sub_discipline_id' => 0,
            'user_id' => 1,
            'is_lock' => 1

        ]);

        \DB::table('categories')->insert([
            'name'=> 'FIRE DETECTION AND ALARM SYSTEM',
            'sub_discipline_id' => 0,
            'user_id' => 1,
            'is_lock' => 1

        ]);

        \DB::table('categories')->insert([
            'name'=> 'CATV/CCTV/INTERNET',
            'sub_discipline_id' => 0,
            'user_id' => 1,
            'is_lock' => 1

        ]);
    }
}
