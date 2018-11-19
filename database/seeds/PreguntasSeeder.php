<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PreguntasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
		for ($i=0; $i < 50; $i++) {
		    \DB::table('preguntas')->insert(array(
		           'clave' => $faker->randomElement(['a','e','i','o','u','ma','me','mi','mu','pa','pe']),
		           'distractor1'  => $faker->randomElement(['a','e','i','o','u','ma','me','mi','mu','pa','pe']),
		           'distractor2'  => $faker->randomElement(['a','e','i','o','u','ma','me','mi','mu','pa','pe']),
		           'nivel'  => $faker->randomElement(['1','2','3','4','5']),
		           'created_at' => date('Y-m-d H:m:s'),
		           'updated_at' => date('Y-m-d H:m:s')
		    ));
		}
    }
}
