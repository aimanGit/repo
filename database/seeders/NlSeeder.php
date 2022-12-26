<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class NlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker=Faker::create();

        for($i=0; $i<10; $i++){
            DB::table('nl')->insert([
                'title' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                'article' => $faker->text($maxNbChars = 200),
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => now()->addMinutes(2),
            ]);
        }
    }
}
