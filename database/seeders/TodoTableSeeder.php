<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class TodoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        for($i = 0 ; $i < 5 ; $i++){
            DB::table('todos')
            ->insert([
                'title' => 'Title',
                'description' => $faker->text,
                'priority' => 'MEDIUM',
                'completed' => false,
                'user_id' => 1
            ]);
        }
    }
}
