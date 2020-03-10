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
        // $this->call(UsersTableSeeder::class);
        \DB::table('sub_disciplines')->insert([
            'name' => 'BUILD',
            'discipline_id' => 2,
            'user_id' => 1,
            'is_lock' => 1
        ]);
    }
}
