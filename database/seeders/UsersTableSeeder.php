<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $usersPsw = array(
            "demodemo",
            "12345600",
            "testtest"
        );

        foreach($usersPsw as $userPsw){

            User::create([
                'name' => $faker->firstNAme .' '.$faker->lastNAme,
                'email' => $content = $faker->email,
                'password' => $userPsw
            ]);
        }
    }
}
